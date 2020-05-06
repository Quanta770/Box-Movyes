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
<title>Delete Country</title>
<script>
  

</script>
</head>
<body>
<br /><br /><br />

<?php
    $countryIDD = '';
  if(isset($_POST['deleteCountry'])){
	$countryIDD = $_POST['deleteCountry'];
	$delCountry = "DELETE FROM `country` WHERE country_id = '$countryIDD'";
	$run_del_country = mysqli_query($links,$delCountry);
	if($run_del_country){
				$_SESSION['messageCountry'] = "Record has been deleted";
	           $_SESSION['msg_typeCountry'] = "danger";
	      echo("<script type='text/javascript'>
				alert('Successfully deleted');
				window.location = 'tables_country.php';
			</script>");
	}else{
		 echo("<script type='text/javascript'>
				alert('Uanble to delete');
				window.location = 'tables_country.php';
			</script>");
	}
	  
  }else{
	  echo("<script type='text/javascript'>
				alert('Error in Fetching Data');
				window.location = 'tables_country.php';
			</script>");
	  
	  
  }

	
	
	
	
	
  
?>
</body>
</html>