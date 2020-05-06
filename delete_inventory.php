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
 <?php 


	
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
		
   
  
  
  ?>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />

<title>Delete Category</title>
<script>
  

</script>
</head>
<body>
<br /><br /><br />

<?php
   $up_checker = 0;
   $invenID = '';
  if(isset($_POST['deleteInven'])){
	  $getStaffEmail = $_SESSION['email'];
		$sql = "SELECT * from `staff` where email = '$getStaffEmail'";
		$runG = mysqli_query($links,$sql);
		$result = mysqli_fetch_assoc($runG);
		$staffID = $result['staff_id'];            
	 $invenID = $_POST['deleteInven'];
	 
	 $sqlToCheck = "SELECT rental_id FROM `rental` WHERE inventory_id = '$invenID' AND ISNULL(rental_date)";
	 $check = mysqli_query($links,$sqlToCheck);
	 $runCheck = mysqli_fetch_assoc($check);
	 
	 if(!empty($runCheck)){
		 $getRen = $runCheck['rental_id'];
		 $up_rental = "UPDATE `rental` SET `staff_id`= '$staffID',`status_id`= '4',`last_update`=current_timestamp() WHERE rental_id = '$getRen'";
		 $run_update = mysqli_query($links,$up_rental);
		 $selectPay = "SELECT payment_id,payment_status FROM `payment` WHERE rental_id = '$getRen'";
		 $query = mysqli_query($links,$selectPay);
		 $rows = mysqli_fetch_assoc($query);
		 $getPaymentId = $rows['payment_id'];
		 $getPaymentStatus = $rows['payment_status'];
		 if($getPaymentStatus == 1){
			 $updatePayment = "UPDATE `payment` SET `payment_status`='2',`last_update`= current_timestamp() WHERE payment_id = '$getPaymentId'";
			 $updatedPayment = mysqli_query($links,$updatePayment);
			 $up_checker = 1;
		 }else{
			  $updatePayments = "UPDATE `payment` SET `payment_status`='3',`last_update`= current_timestamp() WHERE payment_id = '$getPaymentId'";
			  $updatedPayments = mysqli_query($links,$updatePayments);
			  $up_checker = 1;
		 }
		 
	 }
	 
	 
	 $sqlDel = "DELETE FROM `inventory` WHERE inventory_id = '$invenID'";
	 $run_del = mysqli_query($links,$sqlDel);
	 if($run_del){
		     if($up_checker == 1){
				  $_SESSION['messageI'] = "Record has been deleted";
	           $_SESSION['msg_typeI'] = "danger";
	      echo("<script type='text/javascript'>
				alert('Successfully deleted and rental $getRen is cancelled');
				window.location = 'tables_inventory.php';
			</script>");
			 }else{
		      $_SESSION['messageI'] = "Record has been deleted";
	           $_SESSION['msg_typeI'] = "danger";
	      echo("<script type='text/javascript'>
				alert('Successfully deleted');
				window.location = 'tables_inventory.php';
			</script>");
			 }
		 
	 }else{
		  echo("<script type='text/javascript'>
				alert('Error : Selected inventory is not deleted');
				window.location = 'tables_inventory.php';
			</script>");
		 
	 }
	 
	  
  }else{
	  echo("<script type='text/javascript'>
				alert('Error in Fetching Data');
				window.location = 'tables_inventory.php';
			</script>");
	  
	  
  }

	
	
	
	
	
  
?>
</body>
</html>