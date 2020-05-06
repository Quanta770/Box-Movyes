<?php
	session_start();
	if(!isset($_SESSION['email']))//restrict access if not login
	{
		header('location:staff_login.php');
	}
	else if (isset($_SESSION['customer_check']))
	{
		header('location:customer_page.php');
	}
	
?>
<! DOCTYPE html >
<html lang = "en">
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<title>Handle_customer_return</title>

</head>
<body>
<br /><br /><br />

<?php
    $changeStore = 0;
	$checkIfNewPay = 0;
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$getRenIDForReturn = '';
	if(isset($_POST['returnButton'])){
		$getRenIDForReturn = $_POST['returnButton'];
		
		$staffEmail = $_SESSION['email'];
		$sqliSE = "SELECT * from `staff` where email = '$staffEmail'";
		$runs = mysqli_query($links,$sqliSE);
		$resultgetStaff = mysqli_fetch_assoc($runs);
		$staffIDWork = $resultgetStaff['staff_id'];   
		$staffStoreWork = $resultgetStaff['store_id'];
		
		//check if customer make payment first before they can return it 
		$sqlCheckPay = "SELECT * FROM `payment` WHERE rental_id = '$getRenIDForReturn'";
		$run_Payment = mysqli_query($links,$sqlCheckPay);
		$resultFromRun = mysqli_fetch_assoc($run_Payment);
		$getPaymentStatus = $resultFromRun['payment_status'];
		if($getPaymentStatus == 0){
			 echo("<script type='text/javascript'>
			    alert('Cannot be returned, The payment for this particular rental is not paid');
				window.location = 'customer_rental_return.php';
			   </script>");
			
		}else{
			//$getRentInven = "SELECT inventory_id,store_id FROM `rental` INNER JOIN `` WHERE rental_id = '$getRenIDForReturn'";  //to get the actual inventory id
			//$run_getRentInven = mysqli_query($links,$getRentInven);
			//$runner = mysqli_fetch_assoc($run_getRentInven);
			//$fetch_inven = $runner['inventory_id'];
			//$fetch_store = $runner['store_id'];
			$sql_check_if_empty = "SELECT inventory_id FROM `rental` WHERE rental_id = '$getRenIDForReturn'";
			$getValue = mysqli_query($links,$sql_check_if_empty);
			$rows = mysqli_fetch_assoc($getValue);
			if(empty($rows['inventory_id'])){
					$updateReturns = "UPDATE `rental` SET `return_date`= current_timestamp(),`staff_id`='$staffIDWork',`last_update`=current_timestamp() WHERE rental_id = '$getRenIDForReturn'";
					$run_updateReturns = mysqli_query($links,$updateReturns);
					if($run_updateReturns){
						 $_SESSION['cusReturn_message'] = "Record has been updated To Customer Returned";
						 $_SESSION['msg_typeReturn'] = "success";
				
						echo("<script type='text/javascript'>
						alert('Successfully updated the selected record to Customer Returned AND no late payment as staff delete the inventory');
						window.location = 'customer_rental_return.php';
						</script>");
						
					}else{
						echo("<script type='text/javascript'>
						alert('Unsuccessfully update the returned record');
						window.location = 'customer_rental_return.php';
						</script>");
						
					}
				    
			}else{
				
			$sqlCheckStore = "SELECT inventory.store_id,rental.inventory_id,rental.customer_id FROM `rental` INNER JOIN `inventory` ON rental.inventory_id = inventory.inventory_id WHERE rental_id = '$getRenIDForReturn'"; //get the inventory store id
			$run_sql = mysqli_query($links,$sqlCheckStore);
			$results = mysqli_fetch_assoc($run_sql);
			$getActualStore = $results['store_id'];
			$getActualinvenID = $results['inventory_id'];
			$getCustomerID = $results['customer_id'];
			if($getActualStore != $staffStoreWork){  //compare with staff store id with the store
				$sqlUpdateinvenStore = "UPDATE `inventory` SET `store_id`='$staffStoreWork',`last_update`=current_timestamp() WHERE inventory_id = '$getActualinvenID'";
				$runUpdate = mysqli_query($links,$sqlUpdateinvenStore);
				$changeStore = 1;
			}
			
			
			
			$updateReturn = "UPDATE `rental` SET `return_date`= current_timestamp(),`staff_id`='$staffIDWork',`last_update`=current_timestamp() WHERE rental_id = '$getRenIDForReturn'";
			$run_updateReturn = mysqli_query($links,$updateReturn);
			if($run_updateReturn){
				 $total_between_return_and_start = "SELECT (TIMEDIFF(rental.return_date,(DATE_ADD(rental.rental_date, INTERVAL film.rental_duration*24 HOUR)))/24/10000) as diff,film.rental_rate FROM `rental` INNER JOIN `inventory` ON rental.inventory_id = inventory.inventory_id INNER JOIN `film` ON inventory.film_id = film.film_id WHERE rental_id = '$getRenIDForReturn'";
				 $getTotalDate = mysqli_query($links,$total_between_return_and_start);
				 $row = mysqli_fetch_assoc($getTotalDate);
				 if(!empty($row['diff'])){
					 $getD = $row['diff'];
					 $price = $row['rental_rate'];
					 $percentage = 5;
					 $dayss = ceil($getD);
					 if($dayss > 0){
						 $total_late_fees = (($percentage / 100) * $price) * $dayss;
						 $createPay = "INSERT INTO `payment`(`payment_id`, `customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `payment_status`, `payment_type_id`, `last_update`) VALUES (NULL,'$getCustomerID','$staffIDWork','$getRenIDForReturn','$total_late_fees',NULL,'0','3',current_timestamp())";
						 $runn = mysqli_query($links,$createPay);
						 $checkIfNewPay = 1;
					 }	 
			 }
				 
				
				 if($checkIfNewPay == 1){
				 $_SESSION['cusReturn_message'] = "Record has been updated To Customer Returned";
				 $_SESSION['msg_typeReturn'] = "success";
				 if($changeStore == 1){
			     echo("<script type='text/javascript'>
			     alert('Successfully updated the selected record to Customer Returned and the inventory: $getActualinvenID change to store: $staffStoreWork AND customer: $getCustomerID got late payment fees');
				 window.location = 'customer_rental_return.php';
			   </script>");
				 }else{
					 echo("<script type='text/javascript'>
			     alert('Successfully updated the selected record to Customer Returned AND customer: $getCustomerID got late payment fees');
				 window.location = 'customer_rental_return.php';
			   </script>");
					 
				 }
				}else{
					 $_SESSION['cusReturn_message'] = "Record has been updated To Customer Returned";
				 $_SESSION['msg_typeReturn'] = "success";
				 if($changeStore == 1){
			     echo("<script type='text/javascript'>
			     alert('Successfully updated the selected record to Customer Returned and the inventory: $getActualinvenID change to store: $staffStoreWork');
				 window.location = 'customer_rental_return.php';
			   </script>");
				 }else{
					 echo("<script type='text/javascript'>
			     alert('Successfully updated the selected record to Customer Returned');
				 window.location = 'customer_rental_return.php';
			   </script>");
					 
				 }
					
					
					
				}
				
			}else{
				 echo("<script type='text/javascript'>
			    alert('Unable to update selected record for Customer Returned');
				window.location = 'customer_rental_return.php';
			   </script>");
				
			}
			
		}
		
	 }
	}else{
		 echo("<script type='text/javascript'>
			    alert('Error in fetching the value');
				window.location = 'customer_rental_return.php';
			   </script>");
		
	}
		
		
	  
  ?>
  
	
</body>
</html>