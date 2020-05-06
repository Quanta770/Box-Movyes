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
<title>Actor check</title>
<script>
  function inside_Country(){
	  document.getElementById("errorCountry").submit();
	  
  }


</script>
</head>
<body>
<br /><br /><br />

<?php
	
	$getCountryN = '';
	
	if(isset($_POST['countryName']))
	{		
		$getCountryN = $_POST['countryName'];
		
		
					
			$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
		
		
		$checkDupli = "SELECT country FROM `country` WHERE 1";
		$results = mysqli_query ($links,$checkDupli);
		
		
	
		$check_dupli_Cname = '';		
	    $check_temp = True;
		while($row = mysqli_fetch_assoc($results)){
			$check_dupli_Cname = $row['country'];
			if(strtoupper($getCountryN) == strtoupper($check_dupli_Cname)){		
		    $check_temp = False;
			
			echo("<script type='text/javascript'>
				alert('Insertion Error: Duplicate value found');	
			</script>");
			
			echo ("<form id = 'errorCountry' name = 'errorCountry' method = 'POST' action = 'country.php'> <input type = 'text' value = '1' name = 'inside_Country'/><input type = 'text' value = '$getCountryN' name = 'backCountryname' /></form>");
			echo ("<script>inside_Country();</script>");
			}
		}
		
			
					
		if($check_temp == True)
		{	
		  $sqlInsertCountry = "INSERT INTO `country`(`country_id`, `country`, `last_update`) VALUES (NULL,'$getCountryN',current_timestamp())";
		  $run_country_tb = mysqli_query($links,$sqlInsertCountry);
	      if($run_country_tb){
	      echo("<script type='text/javascript'>
				alert('Country successfully added');
				window.location = 'country.php';
			</script>");
			
		  }
		  else{
			   echo("<script type='text/javascript'>
				alert('Error in inserting the data');
				window.location = 'country.php';
			</script>");
			
			  
			  
		  }		  
		
        	   
		}
				
	  
	} 
	 else
	 {
				 echo("<script type='text/javascript'>
				alert('Value is not set');
				window.location = 'country.php';
			</script>");
	 }		 
	  
	  
  ?>
  
	
</body>
</html>