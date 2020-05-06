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
<title>Handle_rental_payment</title>

</head>
<body>
<br /><br /><br />

<?php
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$getPaymentID = '';
	if(isset($_POST['paidButton'])){
		$staffEmail = $_SESSION['email'];
		$sqlirun = "SELECT * from `staff` where email = '$staffEmail'";
		$runSS = mysqli_query($links,$sqlirun);
		$resultSS = mysqli_fetch_assoc($runSS);
		$staffPaid = $resultSS['staff_id'];   
		$getPaymentID = $_POST['paidButton'];
		$update_Payment = "UPDATE `payment` SET `staff_id`='$staffPaid',`payment_date`=current_timestamp(),`payment_status`='1',`last_update`=current_timestamp() WHERE payment_id = '$getPaymentID'";
		$sqlrun = mysqli_query($links,$update_Payment);
		if($sqlrun){
			 $_SESSION['payment_message'] = "Payment has been made for the selected record customer";
	         $_SESSION['msg_typeP'] = "success";
			  echo("<script type='text/javascript'>
			    alert('Payment has been made by the selected record customer');
				window.location = 'rental_payment.php';
			   </script>");
		}else{
			 echo("<script type='text/javascript'>
			    alert('Error in updating the payment made by the customer');
				window.location = 'rental_payment.php';
			   </script>");
			
		}
		
	}else{
		 echo("<script type='text/javascript'>
			    alert('Error in fetching the value');
				window.location = 'rental_payment.php';
			   </script>");
		
	}
		
		
	  
  ?>
  
	
</body>
</html>