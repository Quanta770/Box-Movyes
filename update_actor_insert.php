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
  function same_actorN(){
	  document.getElementById("sameActor").submit();
	  
  }
  
  function dupli_actorName(){
	   document.getElementById("dupli_actor_Name").submit();
  }

  function updateActorCan(){
	   document.getElementById("successActor").submit();
  }
  
  function error_ActorCant(){
	   document.getElementById("error_Actor").submit();
  }
</script>
</head>
<body>
<br /><br /><br />

<?php
	
	$actorName = '';
	
	if(isset($_POST['actorID']) && isset($_POST['fAName']) &&  isset($_POST['lAName']))
	{		
		$actorFName = $_POST['fAName'];
		$actorLName = $_POST['lAName'];
		$check_temp = True;
		$actorUID = $_POST['actorID'];
		$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
				
		
  
	    $sqlUpCheck = "SELECT first_name,last_name FROM actor WHERE actor_id = '$actorUID'";
		$resultss = mysqli_query($links,$sqlUpCheck);
		$rowCheck = mysqli_fetch_assoc($resultss);
		$checkActorFName = $rowCheck['first_name'];
		$checkActorLName = $rowCheck['last_name'];
		
		if(($actorFName == $checkActorFName) && ($actorLName == $checkActorLName)){
			$check_temp = False;
			 echo("<script type='text/javascript'>
				alert('Invalid update : same value found');	
			 </script>");
			 echo ("<form id = 'sameActor' name = 'sameActor' method = 'POST' action = 'update_actor.php'> <input type = 'text' value = '1' name = 'inside_actorUP'/> <input type = 'text' value = '$actorUID' name = 'update_actor'/>  
			   </form>");
		     echo ("<script>same_actorN();</script>");
			  
			
		}
		$check_dupli_Fname = '';
		$check_dupli_Lname = '';
		$sqlCheck = "SELECT actor.first_name,actor.last_name FROM actor WHERE actor.first_name <> '$checkActorFName' AND actor.last_name <> '$checkActorLName'";
		$resultCheck = mysqli_query ($links,$sqlCheck);
		while($row2 = mysqli_fetch_assoc($resultCheck)){
		    $check_dupli_Fname = $row2['first_name'];
			 $check_dupli_Lname = $row2['last_name'];

			if((strtoupper($actorFName) == strtoupper($check_dupli_Fname)) && (strtoupper($actorLName) == strtoupper($check_dupli_Lname))){
				$check_temp = False;
				 echo("<script type='text/javascript'>
				alert('Invalid update : Duplicate value found');	
			     </script>");
			   echo ("<form id = 'dupli_actor_Name' name = 'dupli_actor_Name' method = 'POST' action = 'update_actor.php'> <input type = 'text' value = '1' name = 'dupli_actorUP'/> <input type = 'text' value = '$actorUID' name = 'update_actor'/>  
			   </form>");
		       echo ("<script>dupli_actorName();</script>");
				
			}	
		}
		
	  if($check_temp == True){
		  $sqlUp = "UPDATE `actor` SET `first_name`='$actorFName',`last_name`='$actorLName',`last_update`= current_timestamp() WHERE actor_id ='$actorUID' ";
		  $run_ActorName_update = mysqli_query($links,$sqlUp);
		  if($run_ActorName_update){
			   echo("<script type='text/javascript'>
				alert('Actor name successfully updated');
			</script>");
	      echo ("<form id = 'successActor' name = 'successActor' method = 'POST' action = 'update_actor.php'><input type = 'text' value = '$actorUID' name = 'update_actor'/>  
			   </form>");
	      echo ("<script>updateActorCan();</script>");
		  }
		  
		  
	  }else{
		   echo("<script type='text/javascript'>
				alert('Invalid Update : Cannot be updated to database');
			</script>");
	      echo ("<form id = 'error_Actor' name = 'error_Actor' method = 'POST' action = 'update_actor.php'><input type = 'text' value = '1' name = 'errorActorN'/><input type = 'text' value = '$actorUID' name = 'update_actor'/>  
			   </form>");
	      echo ("<script>error_ActorCant();</script>");
		  
		  
	  }
		
	}else{
		 echo("<script type='text/javascript'>
				alert('Error in fetching the data');
				window.location = 'tables_actor.php';
			</script>");
				  
		
	}				
		
		
	  
  ?>
  
	
</body>
</html>