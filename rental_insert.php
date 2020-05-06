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
<title>Category check</title>
<script>
  function error_getSelectedFilm(){
	   document.getElementById("errorSFilm").submit();
	  
  }
  function error_p1(){
	   document.getElementById("errorP1").submit();
  }
   function error_r1(){
	   document.getElementById("errorR1").submit();
  }
  function error_p2(){
	   document.getElementById("errorP2").submit();
  }
   function error_r2(){
	   document.getElementById("errorR2").submit();
  }
   function error_p3(){
	   document.getElementById("errorP3").submit();
  }
  function error_r3(){
	   document.getElementById("errorR3").submit();
  }
  function error_p4(){
	   document.getElementById("errorP4").submit();
  }
  function error_r4(){
	   document.getElementById("errorR4").submit();
  }
   function error_p5(){
	   document.getElementById("errorP5").submit();
  }
  function error_r5(){
	   document.getElementById("errorR5").submit();
  }
  function error_Address(){
	  
	   document.getElementById("errorAddress").submit();
  }
  function error_Address2(){
	  
	   document.getElementById("errorAddress2").submit();
  }
</script>
</head>
<body>
<br /><br /><br />

<?php
    $rent_statuss = 0;
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$film_idRen = '';
	$cus_idRen = '';
	$film_amount = '';
	$arrNotN = [];
	$arrIsN = [];
	$check = True;
	$storeSame = 0;
	if(isset($_POST['ren_Film']) && isset($_POST['ren_Email']) && isset($_POST['ren_Status'])){
		$film_idRen = $_POST['ren_Film'];
		$cus_idRen = $_POST['ren_Email'];

		
		 $getRentStatus = $_POST['ren_Status'];
		$getStaffEmail = $_SESSION['email'];
		$sql = "SELECT * from `staff` where email = '$getStaffEmail'";
		$runG = mysqli_query($links,$sql);
		$result = mysqli_fetch_assoc($runG);
		$staffID = $result['staff_id'];               							 //getting the staff ID
		$getStoreID = "SELECT store_id FROM `staff` WHERE staff_id = '$staffID'";
		$runSID = mysqli_query($links,$getStoreID);
		$resultss = mysqli_fetch_assoc($runSID);         
		$staffStoreIDD = $resultss['store_id'];        							 //getting which store the staff works at
		echo $film_idRen;
	    if(isset($staffStoreIDD)){
			$storeIDD = '';
			$filmQuery = "SELECT inventory.inventory_id,rental.rental_id,rental.return_date FROM `rental` INNER JOIN `inventory` ON rental.inventory_id = inventory.inventory_id WHERE inventory.film_id = '$film_idRen' AND rental.return_date IS NOT NULL AND inventory.store_id = '$staffStoreIDD' AND inventory.inventory_status_id = '3'";
			$run_filmQuery = mysqli_query($links,$filmQuery);
			//$resultFilm = mysqli_fetch_assoc($run_filmQuery);
			
			
			while($row = mysqli_fetch_array($run_filmQuery)){
				$arrNotN[] = $row['inventory_id'];
			}
			
			$filmQuery2 = "SELECT inventory.inventory_id,rental.rental_id,rental.return_date FROM `rental` INNER JOIN `inventory` ON rental.inventory_id = inventory.inventory_id WHERE inventory.film_id = '$film_idRen' AND rental.return_date IS NULL AND inventory.store_id = '$staffStoreIDD' AND inventory.inventory_status_id = '3'";
			$run_query2 = mysqli_query($links,$filmQuery2);
			while($row2 = mysqli_fetch_array($run_query2)){
				$arrIsN[] = $row2['inventory_id'];
			}
			
			$actualEmptyR = array_diff($arrNotN,$arrIsN);
			
			array_walk($actualEmptyR , 'intval');
			$ids = implode(',', $actualEmptyR);
			
			$testQuery = "SELECT inventory.inventory_id,film.rental_rate,inventory.store_id FROM `inventory` INNER JOIN `film` ON inventory.film_id = film.film_id LEFT JOIN `rental` ON inventory.inventory_id = rental.inventory_id WHERE inventory.film_id = '$film_idRen' AND rental.inventory_id IS NULL AND inventory.inventory_status_id = '3' LIMIT 1";
			$runQuery = mysqli_query($links,$testQuery);
			$runner = mysqli_fetch_assoc($runQuery);
			//$storer = $runner['inventory_id'];
			
			
			if(!empty($ids)){
			$sql = "SELECT inventory.inventory_id,film.rental_rate,inventory.store_id FROM `inventory` INNER JOIN `film` ON inventory.film_id = film.film_id  WHERE inventory.inventory_id IN ($ids) AND inventory.inventory_status_id = '3' LIMIT 1";
			$run_sql = mysqli_query($links,$sql);
			$results = mysqli_fetch_assoc($run_sql);
			$getTheID = $results['inventory_id'];
			$storeIDD = $results['store_id'];
			$film_amount = $results['rental_rate'];
			$rent_statuss = 3;
			}else if(!empty($runner['inventory_id'])){
				$getTheID = $runner['inventory_id'];
				$storeIDD = $runner['store_id'];
				$film_amount = $runner['rental_rate'];
				$rent_statuss = 2;
				if($storeIDD == $staffStoreIDD){
					$storeSame = 1;
				}
			}else{                                        //if else then need to find in another store, no again will say no stock
				
				$findFilm2 = [];
				$getFilm2 = [];
				$findFilmQuery = "SELECT inventory.inventory_id,rental.rental_id,rental.return_date FROM `rental` INNER JOIN `inventory` ON rental.inventory_id = inventory.inventory_id WHERE inventory.film_id = '$film_idRen' AND rental.return_date IS NOT NULL AND inventory.store_id <> '$staffStoreIDD' AND inventory.inventory_status_id = '3'";
				$run_findFilm2 = mysqli_query($links,$findFilmQuery);
				while($rows = mysqli_fetch_array($run_findFilm2)){
					$findFilm2[] = $rows['inventory_id'];
				}
				$filmFQuery2 = "SELECT inventory.inventory_id,rental.rental_id,rental.return_date FROM `rental` INNER JOIN `inventory` ON rental.inventory_id = inventory.inventory_id WHERE inventory.film_id = '$film_idRen' AND rental.return_date IS NULL AND inventory.store_id <> '$staffStoreIDD' AND inventory.inventory_status_id = '3'";
				$run_Fquery2 = mysqli_query($links,$filmFQuery2);
				while($row3 = mysqli_fetch_array($run_Fquery2)){
					$getFilm2[] = $row3['inventory_id'];
				}
				$actualEmptyR2 = array_diff($findFilm2,$getFilm2);
				array_walk($actualEmptyR2, 'intval');
				$idd = implode(',',$actualEmptyR2);
				
				if(!empty($idd)){
					$sql2 = "SELECT inventory.inventory_id,film.rental_rate,inventory.store_id FROM `inventory` INNER JOIN `film` ON inventory.film_id = film.film_id  WHERE inventory.inventory_id IN ($idd) AND inventory.inventory_status_id = '3' LIMIT 1";
					$run_sqlii = mysqli_query($links,$sql2);
					$resultss = mysqli_fetch_assoc($run_sqlii);
					$storeIDD = $resultss['store_id'];
					$getTheID = $resultss['inventory_id'];
					$film_amount = $resultss['rental_rate'];
					$rent_statuss = 1;
				}else{
					 echo("<script type='text/javascript'>
					 alert('The selected film cant be rent because all store also do not have stock');
					</script>");
					echo ("<form id = 'errorSFilm' name = 'errorSFilm' method = 'POST' action = 'Add_rental.php'> <input type = 'text' value = '1' name = 'errorSeleFilm'/><input type = 'text' value = '$film_idRen' name = 'back_film_id' /><input type = 'text' value = '$getRentStatus' name = 'back_rent_id' /><input type = 'text' value = '$cus_idRen' name = 'back_cust_id' /></form>");
					echo ("<script>error_getSelectedFilm();</script>");
					$check = False;
					
				}
				
			}
			echo $rent_statuss;
	   
			
			if($check == True){    //1. will picked up in store, 2. will be delivered to customer
				if($getRentStatus == 1 && $rent_statuss == 1){   //This is collect at store but movie is in another store
					 $sql_Insert = "INSERT INTO `rental`(`rental_id`, `rental_date`, `inventory_id`, `customer_id`, `return_date`, `staff_id`, `status_id`, `collect_store_id`, `last_update`) VALUES (NULL,NULL,$getTheID,$cus_idRen,NULL,$staffID,$getRentStatus,$storeIDD,current_timestamp())";
					 $in_run = mysqli_query($links,$sql_Insert);
					  $latest_id =  mysqli_insert_id($links);
					 if($in_run){
						 $payment_insert = "INSERT INTO `payment`(`payment_id`, `customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `payment_status`, `payment_type_id`, `last_update`) VALUES (NULL,$cus_idRen,$staffID,$latest_id,$film_amount,NULL,0,1,current_timestamp())";
						 $run_Payment = mysqli_query($links,$payment_insert);
						 if($run_Payment){
							  echo("<script type='text/javascript'>
							  alert('Rental_successfully added, Please collect in store $storeIDD ');
							  window.location = 'Add_rental.php';
							  </script>");
						 }else{
							    $sql_delPay = "DELETE FROM `rental` WHERE rental_id = '$latest_id'";
								$run_Del = mysqli_query($links,$sql_delPay);
							    echo("<script type='text/javascript'>
								alert('Insertion Error: Payment cannot be created');
								</script>");
			
								echo ("<form id = 'errorP1' name = 'errorP1' method = 'POST' action = 'Add_rental.php'> <input type = 'text' value = '1' name = 'inside_p1'/><input type = 'text' value = '$film_idRen' name = 'back_film_id' /><input type = 'text' value = '$getRentStatus' name = 'back_rent_id' /><input type = 'text' value = '$cus_idRen' name = 'back_cust_id' /></form>");
								echo ("<script>error_p1();</script>");
						 }
					 }else{
						        echo("<script type='text/javascript'>
								alert('Insertion Error: Rental record cannot be added');
								</script>");
			
								echo ("<form id = 'errorR1' name = 'errorR1' method = 'POST' action = 'Add_rental.php'> <input type = 'text' value = '1' name = 'inside_r1'/><input type = 'text' value = '$film_idRen' name = 'back_film_id' /><input type = 'text' value = '$getRentStatus' name = 'back_rent_id' /><input type = 'text' value = '$cus_idRen' name = 'back_cust_id' /></form>");
								echo ("<script>error_r1();</script>");
					 }
					
				}else if($getRentStatus == 1 && $rent_statuss == 2){ //This is the selected film is not yet rent before and see which store own it and call customer to collect it
				    if($storeSame == 1){
					 $sql_Insert = "INSERT INTO `rental`(`rental_id`, `rental_date`, `inventory_id`, `customer_id`, `return_date`, `staff_id`, `status_id`, `collect_store_id`, `last_update`) VALUES (NULL,current_timestamp(),$getTheID,$cus_idRen,NULL,$staffID,3,NULL,current_timestamp())";
					 $in_run = mysqli_query($links,$sql_Insert);
					  $latest_id =  mysqli_insert_id($links);
					 if($in_run){
						 $payment_insert = "INSERT INTO `payment`(`payment_id`, `customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `payment_status`,  `payment_type_id`, `last_update`) VALUES (NULL,$cus_idRen,$staffID,$latest_id,$film_amount,NULL,0,1,current_timestamp())";
						 $run_Payment = mysqli_query($links,$payment_insert);
						 if($run_Payment){
							  echo("<script type='text/javascript'>
							  alert('Rental_successfully added, Film is in this store, rental date will be start immediately');
							  window.location = 'Add_rental.php';
							  </script>");
						 }else{
							    $sql_delPay = "DELETE FROM `rental` WHERE rental_id = '$latest_id'";
								$run_Del = mysqli_query($links,$sql_delPay);
							    echo("<script type='text/javascript'>
								alert('Insertion Error: Payment cannot be created');
								</script>");
			
								echo ("<form id = 'errorP2' name = 'errorP2' method = 'POST' action = 'Add_rental.php'> <input type = 'text' value = '1' name = 'inside_p2'/><input type = 'text' value = '$film_idRen' name = 'back_film_id' /><input type = 'text' value = '$getRentStatus' name = 'back_rent_id' /><input type = 'text' value = '$cus_idRen' name = 'back_cust_id' /></form>");
								echo ("<script>error_p2();</script>");
						 }
					 }else{
						 echo("<script type='text/javascript'>
								alert('Insertion Error: Rental record cannot be added');
								</script>");
			
								echo ("<form id = 'errorR2' name = 'errorR2' method = 'POST' action = 'Add_rental.php'> <input type = 'text' value = '1' name = 'inside_r2'/><input type = 'text' value = '$film_idRen' name = 'back_film_id' /><input type = 'text' value = '$getRentStatus' name = 'back_rent_id' /><input type = 'text' value = '$cus_idRen' name = 'back_cust_id' /></form>");
								echo ("<script>error_r2();</script>");
					 }
					}else{
						$sql_Insert = "INSERT INTO `rental`(`rental_id`, `rental_date`, `inventory_id`, `customer_id`, `return_date`, `staff_id`, `status_id`, `collect_store_id`, `last_update`) VALUES (NULL,NULL,$getTheID,$cus_idRen,NULL,$staffID,$getRentStatus,$storeIDD,current_timestamp())";
					 $in_run = mysqli_query($links,$sql_Insert);
					  $latest_id =  mysqli_insert_id($links);
					 if($in_run){
						 $payment_insert = "INSERT INTO `payment`(`payment_id`, `customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `payment_status`,  `payment_type_id`, `last_update`) VALUES (NULL,$cus_idRen,$staffID,$latest_id,$film_amount,NULL,0,1,current_timestamp())";
						 $run_Payment = mysqli_query($links,$payment_insert);
						 if($run_Payment){
							  echo("<script type='text/javascript'>
							  alert('Rental_successfully added, Please collect in store $storeIDD');
							  window.location = 'Add_rental.php';
							  </script>");
						 }else{
							    $sql_delPay = "DELETE FROM `rental` WHERE rental_id = '$latest_id'";
								$run_Del = mysqli_query($links,$sql_delPay);
							    echo("<script type='text/javascript'>
								alert('Insertion Error: Payment cannot be created');
								</script>");
			
								echo ("<form id = 'errorP3' name = 'errorP3' method = 'POST' action = 'Add_rental.php'> <input type = 'text' value = '1' name = 'inside_p3'/><input type = 'text' value = '$film_idRen' name = 'back_film_id' /><input type = 'text' value = '$getRentStatus' name = 'back_rent_id' /><input type = 'text' value = '$cus_idRen' name = 'back_cust_id' /></form>");
								echo ("<script>error_p3();</script>");
						 }
					 }else{
						 echo("<script type='text/javascript'>
								alert('Insertion Error: Rental record cannot be added');
								</script>");
			
								echo ("<form id = 'errorR3' name = 'errorR3' method = 'POST' action = 'Add_rental.php'> <input type = 'text' value = '1' name = 'inside_r3'/><input type = 'text' value = '$film_idRen' name = 'back_film_id' /><input type = 'text' value = '$getRentStatus' name = 'back_rent_id' /><input type = 'text' value = '$cus_idRen' name = 'back_cust_id' /></form>");
								echo ("<script>error_r3();</script>");
					 }
					
					}
				}else if($getRentStatus == 1 && $rent_statuss == 3){
					 $sql_Insert = "INSERT INTO `rental`(`rental_id`, `rental_date`, `inventory_id`, `customer_id`, `return_date`, `staff_id`, `status_id`, `collect_store_id`, `last_update`) VALUES (NULL,current_timestamp,$getTheID,$cus_idRen,NULL,$staffID,3,NULL,current_timestamp())";
					 $in_run = mysqli_query($links,$sql_Insert);
					  $latest_id =  mysqli_insert_id($links);
					 if($in_run){
						 $payment_insert = "INSERT INTO `payment`(`payment_id`, `customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `payment_status`,  `payment_type_id`, `last_update`) VALUES (NULL,$cus_idRen,$staffID,$latest_id,$film_amount,NULL,0,1,current_timestamp())";
						 $run_Payment = mysqli_query($links,$payment_insert);
						 if($run_Payment){
							  echo("<script type='text/javascript'>
							  alert('Rental_successfully added, Selected film is in stock rental date will be start immediately');
							  window.location = 'Add_rental.php';
							  </script>");
						 }else{
							 $sql_delPay = "DELETE FROM `rental` WHERE rental_id = '$latest_id'";
								$run_Del = mysqli_query($links,$sql_delPay);
							    echo("<script type='text/javascript'>
								alert('Insertion Error: Payment cannot be created');
								</script>");
			
								echo ("<form id = 'errorP4' name = 'errorP4' method = 'POST' action = 'Add_rental.php'> <input type = 'text' value = '1' name = 'inside_p4'/><input type = 'text' value = '$film_idRen' name = 'back_film_id' /><input type = 'text' value = '$getRentStatus' name = 'back_rent_id' /><input type = 'text' value = '$cus_idRen' name = 'back_cust_id' /></form>");
								echo ("<script>error_p4();</script>");
						 }
					 }else{
						 echo("<script type='text/javascript'>
								alert('Insertion Error: Rental record cannot be added');
								</script>");
			
								echo ("<form id = 'errorR4' name = 'errorR4' method = 'POST' action = 'Add_rental.php'> <input type = 'text' value = '1' name = 'inside_r4'/><input type = 'text' value = '$film_idRen' name = 'back_film_id' /><input type = 'text' value = '$getRentStatus' name = 'back_rent_id' /><input type = 'text' value = '$cus_idRen' name = 'back_cust_id' /></form>");
								echo ("<script>error_r4();</script>");
					 }
					
				}else{  //mean for online delivery
						if(!empty($_POST['confirmSelection'])){
							$confirmStatus = $_POST['confirmSelection'];
						}
						
						$checkAddress = 1;
						//select the address first
						$sqlSelectAddress = "SELECT address_id FROM `customer` WHERE customer_id = '$cus_idRen'";
						$query = mysqli_query($links,$sqlSelectAddress);
						$fetch = mysqli_fetch_assoc($query);
						
						$addressIDD = $fetch['address_id'];
					    		
						if($confirmStatus == 1){	
						if(!empty($_POST['address1']) && !empty($_POST['district']) && !empty($_POST['cityList'])){ //mean is the perfect one
							$address_up1 = $_POST['address1'];
							$address_up2 = $_POST['address2'];
							$district_up = $_POST['district'];
							$city_up = $_POST['cityList'];
							$postalCode_up = $_POST['postalCode'];
							
							$updateAddress = "UPDATE `address` SET `address`='$address_up1',`address2`=NULLIF('$address_up2',''),`district`='$district_up',`city_id`='$city_up',`postal_code`=NULLIF('$postalCode_up',''),`last_update`= current_timestamp() WHERE address_id = '$addressIDD'";
							$run_update = mysqli_query($links,$updateAddress);
							if($run_update){
								$checkAddress = 1;
							}else{
								$checkAddress = 0;
								 echo("<script type='text/javascript'>
								alert('Insertion Error: The address cannot be updated');
								</script>");
			
								echo ("<form id = 'errorAddress' name = 'errorR5' method = 'POST' action = 'Add_rental.php'> <input type = 'text' value = '1' name = 'errorAddress_in'/><input type = 'text' value = '$film_idRen' name = 'back_film_id' /><input type = 'text' value = '$getRentStatus' name = 'back_rent_id' /><input type = 'text' value = '$cus_idRen' name = 'back_cust_id' /></form>");
								echo ("<script>error_Address();</script>");
							}
						
						}else{
							$checkAddress = 0;
							echo("<script type='text/javascript'>
								alert('Insertion Error: The address data is not complete');
								</script>");
			
								echo ("<form id = 'errorAddress2' name = 'errorR5' method = 'POST' action = 'Add_rental.php'> <input type = 'text' value = '1' name = 'errorAddress_in2'/><input type = 'text' value = '$film_idRen' name = 'back_film_id' /><input type = 'text' value = '$getRentStatus' name = 'back_rent_id' /><input type = 'text' value = '$cus_idRen' name = 'back_cust_id' /></form>");
								echo ("<script>error_Address2();</script>");
							
						}
					}else{
						$checkAddress = 0;
					}
				
				
					 $sql_Insert = "INSERT INTO `rental`(`rental_id`, `rental_date`, `inventory_id`, `customer_id`, `return_date`, `staff_id`, `status_id`, `collect_store_id`, `last_update`) VALUES (NULL,NULL,$getTheID,$cus_idRen,NULL,$staffID,$getRentStatus,NULL,current_timestamp())";
					 $in_run = mysqli_query($links,$sql_Insert);
					  $latest_id =  mysqli_insert_id($links);
					 if($in_run){
						 
						 $shipping = $film_amount * 0.05;
						 $film_amount = $film_amount + $shipping;
						 
						 $payment_insert = "INSERT INTO `payment`(`payment_id`, `customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `payment_status`,  `payment_type_id`, `last_update`) VALUES (NULL,$cus_idRen,$staffID,$latest_id,$film_amount,NULL,0,1,current_timestamp())";
						 $run_Payment = mysqli_query($links,$payment_insert);
						 if($run_Payment){
							 if($checkAddress == 1){
							  echo("<script type='text/javascript'>
							  alert('Rental_successfully added, Will be sent out by staff shortly and additional shipping cost is charge and address is updated');
							  window.location = 'Add_rental.php';
							  </script>");
							 }else{
								  echo("<script type='text/javascript'>
							  alert('Rental_successfully added, Will be sent out by staff shortly and additional shipping cost is charge AND no address changes is make, if any changes wanted to be made to customer please update customer detail again');
							  window.location = 'Add_rental.php';
							  </script>");
								 
							 }
						 }else{
							  $sql_delPay = "DELETE FROM `rental` WHERE rental_id = '$latest_id'";
								$run_Del = mysqli_query($links,$sql_delPay);
							    echo("<script type='text/javascript'>
								alert('Insertion Error: Payment cannot be created');
								</script>");
			
								echo ("<form id = 'errorP5' name = 'errorP5' method = 'POST' action = 'Add_rental.php'> <input type = 'text' value = '1' name = 'inside_p5'/><input type = 'text' value = '$film_idRen' name = 'back_film_id' /><input type = 'text' value = '$getRentStatus' name = 'back_rent_id' /><input type = 'text' value = '$cus_idRen' name = 'back_cust_id' /></form>");
								echo ("<script>error_p5();</script>");
						 }
					 }else{
						       echo("<script type='text/javascript'>
								alert('Insertion Error: Rental record cannot be added');
								</script>");
			
								echo ("<form id = 'errorR5' name = 'errorR5' method = 'POST' action = 'Add_rental.php'> <input type = 'text' value = '1' name = 'inside_r5'/><input type = 'text' value = '$film_idRen' name = 'back_film_id' /><input type = 'text' value = '$getRentStatus' name = 'back_rent_id' /><input type = 'text' value = '$cus_idRen' name = 'back_cust_id' /></form>");
								echo ("<script>error_r5();</script>");
					 }
					
				}
			}else{
				 echo("<script type='text/javascript'>
				alert('Error in getting the data');
				window.location = 'Add_rental.php';
			</script>");
				
			}
		
				
			
		}else{
			 echo("<script type='text/javascript'>
				alert('Error in fetching the value');
				window.location = 'Add_rental.php';
			</script>");
			
			
		}
		
	 }		 
	 else
	 {
				 echo("<script type='text/javascript'>
				alert('Error in fetching the value');
				window.location = 'Add_rental.php';
			</script>");
	 }		 
	  
	  
  ?>
  
	
</body>
</html>