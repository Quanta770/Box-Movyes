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
  function dupli_City(){
	  document.getElementById("dupliCity").submit();
	  
  }
 function error_City(){
	  document.getElementById("errorCity").submit();
	  
  }

</script>
</head>
<body>
<br /><br /><br />

<?php
	
	$tempCheck = True;
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	
	$getCityName = '';
	$getCountryID = '';
	if(isset($_POST['cityName']) && isset($_POST['countrySelected']))
	{		
		$getCityName = $_POST['cityName'];
		$getCountryID = $_POST['countrySelected'];
		
		//check if it is duplicate
		$storeTempName ='';
		$storeTempID = '';
		$sqlSelect = "SELECT * FROM `city` WHERE 1";
		$result = mysqli_query($links,$sqlSelect);
		while($row = mysqli_fetch_assoc($result)){
			$storeTempName = $row['city'];
			$storeTempID = $row['country_id'];
			if((strtoupper($getCityName) == strtoupper($storeTempName)) && ($getCountryID == $storeTempID)){	
		       $check_temp = False;
			   echo("<script type='text/javascript'>
				alert('Insertion Error: Duplicate value found');	
			   </script>");
			
			   echo ("<form id = 'dupliCity' name = 'dupliCity' method = 'POST' action = 'city.php'> <input type = 'text' value = '1' name = 'duplicateCity'/><input type = 'text' value = '$getCityName' name = 'backCityname' /><input type = 'text' value = '$getCountryID' name = 'backCountryID' /></form>");
			   echo ("<script>dupli_City();</script>");
				
			}	
		}
		
		if($tempCheck == True){
			$addCity = "INSERT INTO `city`(`city_id`, `city`, `country_id`, `last_update`) VALUES (NULL,'$getCityName','$getCountryID',current_timestamp())";
			$run_insert = mysqli_query($links,$addCity);
			if($run_insert){
				 echo("<script type='text/javascript'>
				alert('Successfully added the new city');
				window.location = 'city.php';
			</script>");
			}else{
				
				 echo("<script type='text/javascript'>
				alert('Insertion Error: Unable to add the new city');	
			   </script>");
			
			   echo ("<form id = 'errorCity' name = 'errorCity' method = 'POST' action = 'city.php'> <input type = 'text' value = '1' name = 'errorCity'/><input type = 'text' value = '$getCityName' name = 'backCityname' /><input type = 'text' value = '$getCountryID' name = 'backCountryID' /></form>");
			   echo ("<script>error_City();</script>");
				
				
			}
			
			
		}
		
		
		
		
	}else{
				 echo("<script type='text/javascript'>
				alert('Value is not set');
				window.location = 'city.php';
			</script>");
	 }		 
	  
	  
  ?>
  
	
</body>
</html>