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
<title>Handle_online_received</title>

</head>
<body>
<br /><br /><br />

<?php
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$getRenID = '';
	if(isset($_POST['custReceivedButton'])){
		$getRenID = $_POST['custReceivedButton'];
		$staffEmail = $_SESSION['email'];
		$sqli = "SELECT * from `staff` where email = '$staffEmail'";
		$runS = mysqli_query($links,$sqli);
		$result = mysqli_fetch_assoc($runS);
		$staffIDG = $result['staff_id'];   
		$updateToReturn = "UPDATE `rental` SET `rental_date`=current_timestamp(),`staff_id`='$staffIDG',`status_id`='3',`last_update`=current_timestamp() WHERE rental_id = '$getRenID'";
		$run_update = mysqli_query($links,$updateToReturn);
		if($run_update){
			  $_SESSION['su_message'] = "Record has been updated To Customer Received";
	          $_SESSION['msg_type1'] = "success";
			  echo("<script type='text/javascript'>
			    alert('Successfully updated the selected record to Customer Received');
				window.location = 'online_rental_process.php';
			   </script>");
			
		}else{
			 echo("<script type='text/javascript'>
			    alert('Error in updating the record to Customer Received');
				window.location = 'online_rental_process.php';
			   </script>");
			
		}
		
	}else{
		 echo("<script type='text/javascript'>
			    alert('Error in fetching the value');
				window.location = 'online_rental_process.php';
			   </script>");
		
	}
		
		
	  
  ?>
  
	
</body>
</html>