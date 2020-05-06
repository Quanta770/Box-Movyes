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
<title>Update Country Insert</title>
<script>
  function sameCountrys(){
	  document.getElementById("sameCountry").submit();
	  
  }
  
  function dupli_countryN(){
	   document.getElementById("dupliCountry").submit();
  }
  function canUpdate(){
	    document.getElementById("successUpdateC").submit();
  }
  function errorUpdate(){
	   document.getElementById("errorUpdateC").submit();
  }
</script>
</head>
<body>
<br /><br /><br />

<?php
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$countryName = '';
	$countryID = '';
	$tempCheck = True;
	if(isset($_POST['countryHID']) && isset($_POST['countryNameUp']))
	{		
		$countryID = $_POST['countryHID'];
		$countryName = $_POST['countryNameUp'];
		
		$checkSame = "SELECT * FROM `country` WHERE country_id = '$countryID'";
		$result = mysqli_query($links,$checkSame);
		$row = mysqli_fetch_assoc($result);
		
		if(!empty($row['country_id'])){
			//mean did not update
			if($countryName == $row['country']){
				$tempCheck = False;
				echo("<script type='text/javascript'>
				alert('Invalid update: The value same as before');
				</script>");
				echo ("<form id = 'sameCountry' name = 'sameCountry' method = 'POST' action = 'update_country.php'> <input type = 'text' value = '1' name = 'dupli_countryUP'/> <input type = 'text' value = '$countryID' name = 'update_country'/>  
			   </form>");
				echo ("<script>sameCountrys();</script>");
			}
		}
		
		$check_dupli_name = '';
		$checkDupli = "SELECT * FROM `country` WHERE country_id <> '$countryID'";
		$results = mysqli_query($links,$checkDupli);
		while($fetch = mysqli_fetch_assoc($results)){
			$check_dupli_name = $fetch['country'];
			if($countryName == $check_dupli_name){
				$tempCheck = False;
				echo("<script type='text/javascript'>
				alert('Invalid update: Duplicate value found');
				</script>");
				echo ("<form id = 'dupliCountry' name = 'dupliCountry' method = 'POST' action = 'update_country.php'> <input type = 'text' value = '1' name = 'dupli_countryName'/> <input type = 'text' value = '$countryID' name = 'update_country'/>  
			   </form>");
				echo ("<script>dupli_countryN();</script>");
			}
			
		}
		
	   if($tempCheck == True){
		   $updateCountry = "UPDATE `country` SET `country`='$countryName',`last_update`=current_timestamp() WHERE country_id = '$countryID'";
		   $run_update_country = mysqli_query($links,$updateCountry);
		   if($run_update_country){
			   echo("<script type='text/javascript'>
				alert('Successfully update the country name');
				</script>");
				echo ("<form id = 'successUpdateC' name = 'successUpdateC' method = 'POST' action = 'update_country.php'><input type = 'text' value = '$countryID' name = 'update_country'/>  
			   </form>");
				echo ("<script>canUpdate();</script>");
		   }else{
			    echo("<script type='text/javascript'>
				alert('Invalid update: unable to update the country name');
				</script>");
				echo ("<form id = 'errorUpdateC' name = 'errorUpdateC' method = 'POST' action = 'update_country.php'> <input type = 'text' value = '1' name = 'errorUpdateCountry'/>  <input type = 'text' value = '$countryID' name = 'update_country'/>  
			   </form>");
				echo ("<script>errorUpdate();</script>");
			   
		   }
		   
		   
		   
	   }
		
	   
		
		
	}else{
		 echo("<script type='text/javascript'>
				alert('Error in fetching the data');
				window.location = 'update_country.php';
			</script>");
				  
		
	}				
		
		
	  
  ?>
  
	
</body>
</html>