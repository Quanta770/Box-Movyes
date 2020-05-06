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
<title>Language check</title>
<script>
  function inside_Language(){
	  document.getElementById("errorLang").submit();
	  
  }


</script>
</head>
<body>
<br /><br /><br />

<?php
	
	$lanName = '';
	
	if(isset($_POST['languName']))
	{		
		$lanName=$_POST['languName']; 
		
				
				
		$sql = "SELECT language.name FROM language WHERE 1";
		
					
		$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
		
		
		$results = mysqli_query ($links,$sql);

				
					
		
		$check_dupli_name = '';		
	    $check_temp = True;
		while($row = mysqli_fetch_assoc($results)){
			$check_dupli_name = $row['name'];
			if((strtoupper($lanName) == strtoupper($check_dupli_name)) || (strtolower($lanName)== strtolower($check_dupli_name))){	
			
		    $check_temp = False;
			echo("<script type='text/javascript'>
				alert('Insertion Error: Duplicate value found');
				
			</script>");
			echo ("<form id = 'errorLang' name = 'errorLang' method = 'POST' action = 'film_detail.php'> <input type = 'text' value = '1' name = 'inside_Lan'/> 
			   <input type = 'text' value = '$lanName' name = 'backLanName' />
			   </form>");
			echo ("<script>inside_Language();</script>");
			 
			}
		}
		
			
					
		if($check_temp == True)
		{	
	     $sqlLan = "INSERT INTO `language` (`language_id`, `name`, `last_update`) VALUES (NULL, '$lanName', current_timestamp())";
		 $run_language_tb = mysqli_query($links,$sqlLan);
	      if( $run_language_tb){
	      echo("<script type='text/javascript'>
				alert('Language Name successfully added');
				window.location = 'film_detail.php';
			</script>");
			
		  }
		  else{
			   echo("<script type='text/javascript'>
				alert('Error in inserting the data');
				window.location = 'film_detail.php';
			</script>");
			  
			  
		  }		  
		
        	   
		}	
	  
	} 
	 else
	 {
				 echo("<script type='text/javascript'>
				alert('Value is not set');
				window.location = 'film_detail.php';
			</script>");
	 }		 
	  
	  
  ?>
  
	
</body>
</html>