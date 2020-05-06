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
<title>Handle_store_received</title>

</head>
<body>
<br /><br /><br />

<?php
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$getRenIDS = '';
	if(isset($_POST['receivedButton'])){
		$getRenIDS = $_POST['receivedButton'];
		$staffEmail = $_SESSION['email'];
		$sqlirun = "SELECT * from `staff` where email = '$staffEmail'";
		$runSS = mysqli_query($links,$sqlirun);
		$resultSS = mysqli_fetch_assoc($runSS);
		$staffIDWork = $resultSS['staff_id'];   
		$updateToReturns = "UPDATE `rental` SET `rental_date`=current_timestamp(),`staff_id`='$staffIDWork',`status_id`='3',`last_update`=current_timestamp() WHERE rental_id = '$getRenIDS'";
		$run_updates = mysqli_query($links,$updateToReturns);
		if($run_updates){
			 $_SESSION['store_message'] = "Record has been updated To Customer Received";
	         $_SESSION['msg_typeS'] = "success";
			  echo("<script type='text/javascript'>
			    alert('Successfully updated the selected record to Customer Received');
				window.location = 'store_collect_rental.php';
			   </script>");
		}else{
			 echo("<script type='text/javascript'>
			    alert('Error in updating the record for customer received');
				window.location = 'store_collect_rental.php';
			   </script>");
		}
	}else{
		 echo("<script type='text/javascript'>
			    alert('Error in fetching the value');
				window.location = 'store_collect_rental.php';
			   </script>");
		
	}
		
		
	  
  ?>
  
	
</body>
</html>