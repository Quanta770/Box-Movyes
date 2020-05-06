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
<title>Language check</title>
<script>
  function same_value(){
	  document.getElementById("samevalue").submit();
	  
  }
  
  function updateInvenCan(){
	   document.getElementById("successInven").submit();
  }
  function errorUpdateIn(){
	   document.getElementById("errorUpdate").submit();
  }
  
  function updateInvenCan2(){
	  
	  document.getElementById("successInvenupdate2").submit();
  }
  function updateInvenCanCan(){
	  
	  document.getElementById("successInvenCanCan").submit();
  }
   function updateInvenCanCan2(){
	  
	  document.getElementById("successInvenCanCan2").submit();
  }
  
  function updateInvenCan3(){
	   document.getElementById("successInvenupdate3").submit();
	  
  }
  function errorUpdateIn2(){
	  document.getElementById("errorUpdate2").submit();
  }
</script>
</head>
<body>
<br /><br /><br />

<?php
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
			
   
  
	$temp_check = True;
	$upfilmID = '';
	$upstoreID = '';
	$upStatusID = '';
	$getInventoryID = '';
	if(isset($_POST['filmUP']) && isset($_POST['storeUP']) && isset($_POST['status_in']) && isset($_POST['invenID']))
	{		
		$getStaffEmaill = $_SESSION['email'];
		$sql = "SELECT * from `staff` where email = '$getStaffEmaill'";
		$run_Staff = mysqli_query($links,$sql);
		$result2 = mysqli_fetch_assoc($run_Staff);
		$staffIDD = $result2['staff_id'];            
			$upfilmID =$_POST['filmUP'];
			$upstoreID = $_POST['storeUP'];
			$upStatusID = $_POST['status_in'];
	    	$getInventoryID = $_POST['invenID'];
			$sqlCheck = "SELECT * FROM `inventory` WHERE inventory_id = '$getInventoryID'";     
			$resultss = mysqli_query($links,$sqlCheck);
			$rowICheck = mysqli_fetch_assoc($resultss);
			$testFilmID = $rowICheck['film_id'];
			$testStoreID = $rowICheck['store_id'];
			$testStatusID = $rowICheck['inventory_status_id'];
			if($upfilmID == $testFilmID && $upstoreID == $testStoreID && $upStatusID == $testStatusID){
				 $temp_check = False;
				 echo("<script type='text/javascript'>
				 alert('Did not update: Same value found');
				 
			    </script>");
				 echo ("<form id = 'samevalue' name = 'samevalue' method = 'POST' action = 'inventory_update.php'><input type = 'text' value = '1' name = 'inside_InvenUp'/> <input type = 'text' value = '$getInventoryID' name = 'update_inventory'/>  
			   </form>");
		        echo ("<script>same_value();</script>");
			}
			
			if($temp_check == True){
				if($upStatusID == 1){
				 $checkIfIsCusMissing = "SELECT rental_id,inventory_id,return_date,customer_id FROM `rental` WHERE inventory_id = '$getInventoryID' AND ISNULL(return_date) AND rental_date IS NOT NULL";
				 $run_Cus = mysqli_query($links,$checkIfIsCusMissing);
				 $run_check = mysqli_fetch_assoc($run_Cus);
				 if(!empty($run_check)){
				 $getCusFromrun = $run_check['customer_id'];
				 $getRenFromrun = $run_check['rental_id'];
			     $actualUpdate = "UPDATE `inventory` SET `inventory_status_id`='$upStatusID',`last_update`= current_timestamp() WHERE inventory_id = '$getInventoryID'";
				 $run_inventory_update = mysqli_query($links,$actualUpdate);
				 $up_rentals = "UPDATE `rental` SET `staff_id`= '$staffIDD',`status_id`= '4',`last_update`=current_timestamp() WHERE rental_id = '$getRenFromrun'";
				 $run_update = mysqli_query($links,$up_rentals);
				 
				 $sqlFilmInfo = "SELECT film.replacement_cost FROM `inventory` INNER JOIN `film` ON inventory.film_id = film.film_id WHERE inventory.inventory_id ='$getInventoryID'";
				 $run_filmInfor = mysqli_query($links,$sqlFilmInfo);
				 $rows = mysqli_fetch_assoc($run_filmInfor);
				 $getFilmRC = $rows['replacement_cost'];
				 $insertPaymentforCus = "INSERT INTO `payment`(`payment_id`, `customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `payment_status`, `payment_type_id`, `last_update`) VALUES (NULL,' $getCusFromrun','$staffIDD','$getRenFromrun',$getFilmRC,NULL,'0','2',current_timestamp())";
				 $run_PaymentforCus = mysqli_query($links,$insertPaymentforCus);
				 if($run_inventory_update && $run_PaymentforCus){
					echo("<script type='text/javascript'>
					alert('Successfully updated and Customer need to pay for the particular film replacement cost');
					</script>");
					echo ("<form id = 'successInven' name = 'successInven' method = 'POST' action = 'inventory_update.php'><input type = 'text' value = '$getInventoryID' name = 'update_inventory'/>  
					</form>");
					echo ("<script>updateInvenCan();</script>");
				  }else{
					  
					  echo("<script type='text/javascript'>
						alert('Unable to insert the Payment for customer lost');
						window.location = 'tables_category.php';
						</script>");		 
				 }	
			   }else{
				   $checkIfIsCusMissings = "SELECT rental_id,inventory_id,return_date,customer_id FROM `rental` WHERE inventory_id = '$getInventoryID' AND ISNULL(return_date) AND ISNULL(rental_date)";
				   $query = mysqli_query($links,$checkIfIsCusMissings);
				   $rowss = mysqli_fetch_assoc($query);
				    if(!empty($rowss['rental_id'])){
						$getRentalIDD = $rowss['rental_id'];
						$select_payment= "SELECT * FROM `payment` WHERE rental_id = '$getRentalIDD'";
						$run_query = mysqli_query($links,$select_payment);
						$rowll = mysqli_fetch_assoc($run_query);
						$payStatus = $rowll['payment_status'];
						if($payStatus == 1){  //refund
							 $actualUpdates = "UPDATE `inventory` SET `inventory_status_id`='$upStatusID',`last_update`= current_timestamp() WHERE inventory_id = '$getInventoryID'";
							 $run_inventory_update2 = mysqli_query($links,$actualUpdates);
							 $up_rentals2 = "UPDATE `rental` SET `staff_id`= '$staffIDD',`status_id`= '4',`last_update`=current_timestamp() WHERE rental_id = '$getRentalIDD'";
							 $run_update2 = mysqli_query($links,$up_rentals2);
							 $updatePayment = "UPDATE `payment` SET `payment_status`='2',`last_update`= current_timestamp() WHERE rental_id = '$getRentalIDD'";
							 $updatedPayment = mysqli_query($links,$updatePayment);
							 echo("<script type='text/javascript'>
							 alert('Successfully updated and Rental ID: $getRentalIDD has been cancelled and the payment will be refunded');
							</script>");
							echo ("<form id = 'successInvenCanCan' name = 'successInvenCanCan' method = 'POST' action = 'inventory_update.php'><input type = 'text' value = '$getInventoryID' name = 'update_inventory'/>  
							</form>");
							echo ("<script>updateInvenCanCan();</script>");
							  
						}else{  //void
							
							 $actualUpdating2 = "UPDATE `inventory` SET `inventory_status_id`='$upStatusID',`last_update`= current_timestamp() WHERE inventory_id = '$getInventoryID'";
							 $run_inventory_update2 = mysqli_query($links,$actualUpdating2);
							 $up_rentingss = "UPDATE `rental` SET `staff_id`= '$staffIDD',`status_id`= '4',`last_update`=current_timestamp() WHERE rental_id = '$getRentalIDD'";
							 $run_update22 = mysqli_query($links,$up_rentingss);
							 $updatePaymenting = "UPDATE `payment` SET `payment_status`='3',`last_update`= current_timestamp() WHERE rental_id = '$getRentalIDD'";
							 $updatedPayment22 = mysqli_query($links,$updatePaymenting);
							 echo("<script type='text/javascript'>
							 alert('Successfully updated and Rental ID: $getRentalIDD has been cancelled and the payment will be voided');
							</script>");
							echo ("<form id = 'successInvenCanCan2' name = 'successInvenCanCan' method = 'POST' action = 'inventory_update.php'><input type = 'text' value = '$getInventoryID' name = 'update_inventory'/>  
							</form>");
							echo ("<script>updateInvenCanCan2();</script>");
						}
						
						
					}else{
				   $justUpdate = "UPDATE `inventory` SET `film_id`='$upfilmID',`store_id`='$upstoreID',`inventory_status_id`='$upStatusID',`last_update`= current_timestamp() WHERE inventory_id = '$getInventoryID'";
				   $run_inventory_updates = mysqli_query($links,$justUpdate);
				   if($run_inventory_updates){
					echo("<script type='text/javascript'>
					alert('Successfully updated');
					</script>");
					echo ("<form id = 'successInvenupdate2' name = 'successInvenupdate2' method = 'POST' action = 'inventory_update.php'><input type = 'text' value = '$getInventoryID' name = 'update_inventory'/>  
					</form>");
					echo ("<script>updateInvenCan2();</script>");
					   
				   }
				 } 
			   }
			   
				}else{
				  $justUpdatess = "UPDATE `inventory` SET `film_id`='$upfilmID',`store_id`='$upstoreID',`inventory_status_id`='$upStatusID',`last_update`= current_timestamp() WHERE inventory_id = '$getInventoryID'";
				   $run_inventory_updatesss = mysqli_query($links,$justUpdatess);
				   if($run_inventory_updatesss){
					echo("<script type='text/javascript'>
					alert('Successfully updated');
					</script>");
					echo ("<form id = 'successInvenupdate3' name = 'successInvenupdate3' method = 'POST' action = 'inventory_update.php'><input type = 'text' value = '$getInventoryID' name = 'update_inventory'/>  
					</form>");
					echo ("<script>updateInvenCan3();</script>");
				   }else{
					    echo("<script type='text/javascript'>
						alert('Error in updating the data to database!');
				 
						</script>");
						echo ("<form id = 'errorUpdate2' name = 'errorUpdate2' method = 'POST' action = 'inventory_update.php'><input type = 'text' value = '1' name = 'errorupdate'/> <input type = 'text' value = '$getInventoryID' name = 'update_inventory'/>  
						</form>");
						echo ("<script>errorUpdateIn2();</script>");
					   
				   }
			  }
			}else{
				
				 echo("<script type='text/javascript'>
				 alert('Error in updating the data to database!');
				 
			    </script>");
				 echo ("<form id = 'errorUpdate' name = 'errorUpdate' method = 'POST' action = 'inventory_update.php'><input type = 'text' value = '1' name = 'errorupdate'/> <input type = 'text' value = '$getInventoryID' name = 'update_inventory'/>  
			   </form>");
		        echo ("<script>errorUpdateIn();</script>");
			}
            
	   
		
	}else{
		 echo("<script type='text/javascript'>
				alert('Error in fetching the data');
				window.location = 'tables_category.php';
			</script>");
				  
		
	}				
		
		
	  
  ?>
  
	
</body>
</html>