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
<title>Insert film</title>
<script>
  function same_valueP(){
	  document.getElementById("sameVaP").submit();
	  
  }
  function success_update_payment(){
	   document.getElementById("successPayment").submit();
  }
  
 function error_update_payment(){
	   document.getElementById("errorPayment").submit();
 }
</script>
</head>
<body>
<br /><br /><br />

<?php
	
   $checker_payment = True;
   $get_upPaymentStatus = '';
   $getPaymentID = '';
   if(isset($_POST['up_paymentStatus'])&& isset($_POST['up_paymentId'])){
	    $get_upPaymentStatus = $_POST['up_paymentStatus'];
		$getPaymentID = $_POST['up_paymentId'];
	   
	    $getStaffEmail = $_SESSION['email'];
		$sql = "SELECT * from `staff` where email = '$getStaffEmail'";
		$runG = mysqli_query($links,$sql);
		$result = mysqli_fetch_assoc($runG);
		$staffIDDD = $result['staff_id'];   
	   
	    $selectExisting = "SELECT payment_status FROM `payment` WHERE payment_id = '$getPaymentID'";
		$run_Exist = mysqli_query($links,$selectExisting);
		$resultExist = mysqli_fetch_assoc($run_Exist);
		$fromDB_PaymentStatus = $resultExist['payment_status'];
		
		if($get_upPaymentStatus == $fromDB_PaymentStatus){
			  $checker_payment = False;
			   echo("<script type='text/javascript'>
				alert('Invalid update : Same value as before');	
			   </script>");
			   echo ("<form id = 'sameVaP' name = 'sameVaP' method = 'POST' action = 'update_payment.php'> <input type = 'text' value = '1' name = 'same_value_payment'/> <input type = 'text' value = '$getPaymentID' name = 'update_payment'/>  
			   </form>");
		       echo ("<script>same_valueP();</script>");
			
			
			
		}
	  
	  if($checker_payment == True){
		  $update_payment_latest = "UPDATE `payment` SET `staff_id`='$staffIDDD',`payment_date`= NULL,`payment_status`='$get_upPaymentStatus',`last_update`= current_timestamp() WHERE payment_id = '$getPaymentID'";
		  $run_latest_payment = mysqli_query($links,$update_payment_latest);
		  if($run_latest_payment){
			    echo("<script type='text/javascript'>
				alert('Successfully updated');	
				window.location = 'tables_payment.php';
			   </script>");
			  
			  
		  }else{
			   echo("<script type='text/javascript'>
				alert('Selected record is unable to update');	
			   </script>");
			   echo ("<form id = 'errorPayment' name = 'errorPayment' method = 'POST' action = 'update_payment.php'><input type = 'text' value = '1' name = 'errorUpdateP'/>  <input type = 'text' value = '$getPaymentID' name = 'update_payment'/>  
			   </form>");
		       echo ("<script>error_update_payment();</script>");
			  
			  
		  }
		  
	  }
	  
	  
	  
      	  
   }else{
	   
	    echo("<script type='text/javascript'>
				alert('Error in Fetching Data');
				window.location = 'tables_payment.php';
			</script>");
	   
	   
   }
	   



	
	
	
	
	
  
?>
</body>
</html>