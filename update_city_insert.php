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
  function same_City(){
	  document.getElementById("sameCity").submit();
	  
  }
  
  function duplicate_City(){
	   document.getElementById("dupliCity").submit();
  }
  function canUpdateCity(){
	    document.getElementById("successCity").submit();
  }
  function errorUp_City(){
	   document.getElementById("errorCity").submit();
  }
</script>
</head>
<body>
<br /><br /><br />

<?php
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$cityName = '';
	$countryIDD = '';
	$cityID = '';
	$tempCheck = True;
	if(isset($_POST['cityNameUp']) && isset($_POST['upCountryID']) &&  isset($_POST['cityIDD']))
	{		
		$cityName = $_POST['cityNameUp'];
		$countryIDD = $_POST['upCountryID'];
		$cityID = $_POST['cityIDD'];
		
		//check if user did really update
		$updateCheck = "SELECT * FROM `city` WHERE city_id = '$cityID'";
		$result = mysqli_query($links,$updateCheck);
		$fetchC = mysqli_fetch_assoc($result);
		
		if(!empty($fetchC['city_id'])){
			if(($cityName == $fetchC['city']) && ($countryIDD == $fetchC['country_id'])){
				$tempCheck = False;
				echo("<script type='text/javascript'>
				alert('Invalid update: The value same as before');
				</script>");
				echo ("<form id = 'sameCity' name = 'sameCity' method = 'POST' action = 'update_city.php'> <input type = 'text' value = '1' name = 'same_city'/> <input type = 'text' value = '$cityID' name = 'update_city'/>  
			   </form>");
				echo ("<script>same_City();</script>");
				
			}
			
		}
		
	   //check if same with the one in the database
	   $check_dupli_cityName = '';
	   $check_dupli_countryID = '';
	   $updateCheck2 = "SELECT * FROM `city` WHERE city_id <> '$cityID'";
	   $results = mysqli_query($links,$updateCheck2);
	   while($row = mysqli_fetch_assoc($results)){
		   $check_dupli_cityName = $row['city'];
		   $check_dupli_countryID = $row['country_id'];
		   if((strtoupper($cityName) == strtoupper($check_dupli_cityName)) && ($countryIDD == $check_dupli_countryID)){
			   $tempCheck = False;
			   echo("<script type='text/javascript'>
				alert('Invalid update: Duplicate value found');
				</script>");
				echo ("<form id = 'dupliCity' name = 'dupliCity' method = 'POST' action = 'update_city.php'> <input type = 'text' value = '1' name = 'dupli_city'/> <input type = 'text' value = '$cityID' name = 'update_city'/>  
			   </form>");
				echo ("<script>duplicate_City();</script>");
			   
		   }
		   
	   }
	   
	   if($tempCheck == True){
		   $sqlUpdateCity = "UPDATE `city` SET `city`='$cityName',`country_id`='$countryIDD',`last_update`= current_timestamp() WHERE city_id = '$cityID'";
		   $run_update = mysqli_query($links,$sqlUpdateCity);
		   if($run_update){
			    echo("<script type='text/javascript'>
				alert('Successfully updated the city');
				</script>");
				echo ("<form id = 'successCity' name = 'successCity' method = 'POST' action = 'update_city.php'><input type = 'text' value = '$cityID' name = 'update_city'/>  
			   </form>");
				echo ("<script>canUpdateCity();</script>");
			   
			   
		   }else{
			     echo("<script type='text/javascript'>
				alert('Invalid update: Unable to update the city');
				</script>");
				echo ("<form id = 'errorCity' name = 'errorCity' method = 'POST' action = 'update_city.php'> <input type = 'text' value = '1' name = 'error_city'/> <input type = 'text' value = '$cityID' name = 'update_city'/>  
			   </form>");
				echo ("<script>errorUp_City();</script>");
			   
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