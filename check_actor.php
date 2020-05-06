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
  function inside_Actor(){
	  document.getElementById("errorActor").submit();
	  
  }


</script>
</head>
<body>
<br /><br /><br />

<?php
	
	$actor_Fname = '';
	$actor_Lname = '';
	
	if(isset($_POST['fName']) && isset($_POST['lName']))
	{		
		$actor_Fname = $_POST['fName'];
		$actor_Lname = $_POST['lName'];
		
				
				
		$sql = "SELECT actor.first_name, actor.last_name FROM actor WHERE 1";
		
					
		$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
		
		$results = mysqli_query ($links,$sql);

				
					
		
		$check_dupli_fName = '';
		$check_dupli_lName = '';		
	    $check_temp = True;
		while($row = mysqli_fetch_assoc($results)){
			$check_dupli_fName = $row['first_name'];
			$check_dupli_lName = $row['last_name'];
			if(((strtoupper($actor_Fname) == strtoupper($check_dupli_fName)) || (strtolower($actor_Fname)== strtolower($check_dupli_fName))) && ((strtoupper($actor_Lname) == strtoupper($check_dupli_lName)) || (strtolower($actor_Lname)== strtolower($check_dupli_lName)))){		
		    $check_temp = False;
			
			echo("<script type='text/javascript'>
				alert('Insertion Error: Duplicate value found');
				
			</script>");
			
			echo ("<form id = 'errorActor' name = 'errorActor' method = 'POST' action = 'film_detail.php'> <input type = 'text' value = '1' name = 'inside_Actor'/><input type = 'text' value = '$actor_Fname' name = 'backActorFname' /><input type = 'text' value = '$actor_Lname' name = 'backActorLname' /></form>");
			echo ("<script>inside_Actor();</script>");
			}
		}
		
			
					
		if($check_temp == True)
		{	
	     $sqlAct = "INSERT INTO `actor` (`actor_id`, `first_name`, `last_name`, `last_update`) VALUES (NULL, '$actor_Fname', '$actor_Lname', current_timestamp());";
		 $run_actor_tb = mysqli_query($links,$sqlAct);
	      if( $run_actor_tb){
	      echo("<script type='text/javascript'>
				alert('Actor successfully added');
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