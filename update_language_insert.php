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
  function same_languageN(){
	  document.getElementById("sameLan").submit();
	  
  }
  
  function dupli_name(){
	   document.getElementById("dupli_Lan_Name").submit();
  }

  function updateLanCan(){
	   document.getElementById("successLan").submit();
  }
  
  function error_LanCant(){
	   document.getElementById("error_Lan").submit();
  }
</script>
</head>
<body>
<br /><br /><br />

<?php
	
	$lanUpName = '';
	
	if(isset($_POST['lanID']) && isset($_POST['langUpName']))
	{		
		$check_temp = True;
		$lanUpName = $_POST['langUpName']; 
		$lanUID = $_POST['lanID'];
		$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
				
		
  
	    $sqlUpCheck = "SELECT name FROM language WHERE language_id = '$lanUID'";
		$resultss = mysqli_query($links,$sqlUpCheck);
		$rowCheck = mysqli_fetch_assoc($resultss);
		$checkName = $rowCheck['name'];
		
		if($lanUpName == $checkName){
			$check_temp = False;
			 echo("<script type='text/javascript'>
				alert('Invalid update : same value found');	
			 </script>");
			 echo ("<form id = 'sameLan' name = 'sameLan' method = 'POST' action = 'update_language.php'> <input type = 'text' value = '1' name = 'inside_languageUP'/> <input type = 'text' value = '$lanUID' name = 'update_language'/>  
			   </form>");
		     echo ("<script>same_languageN();</script>");
			  
			
		}
		$check_dupli_Lname = '';
		$sqlCheck = "SELECT language.name FROM language WHERE language.name <> '$checkName'";
		$resultCheck = mysqli_query ($links,$sqlCheck);
		while($row2 = mysqli_fetch_assoc($resultCheck)){
		    $check_dupli_Lname = $row2['name'];

			if(strtoupper($lanUpName) == strtoupper($check_dupli_Lname)){
				$check_temp = False;
				 echo("<script type='text/javascript'>
				alert('Invalid update : Duplicate value found');	
			     </script>");
			   echo ("<form id = 'dupli_Lan_Name' name = 'dupli_Lan_Name' method = 'POST' action = 'update_language.php'> <input type = 'text' value = '1' name = 'dupli_languageUP'/> <input type = 'text' value = '$lanUID' name = 'update_language'/>  
			   </form>");
		       echo ("<script>dupli_name();</script>");
				
			}	
		}
	  $checkForValue = "SELECT language_id,name FROM `language` WHERE name = 'english'";
	  $result = mysqli_query($links,$checkForValue);
	  $ressult = mysqli_fetch_assoc($result);
	  $checkLanIDD = $ressult['language_id'];
	  $checkLanName = $ressult['name'];
	  if($lanUID == $checkLanIDD && strtoupper($lanUpName) == strtoupper($checkLanName)){
		   $check_temp = False;
		   echo("<script type='text/javascript'>
				alert('Default language cannot be updated');
				window.location = 'tables_language.php';
			</script>");
		  
		  
	  }
		
	  if($check_temp == True){
		  $sqlUp = "UPDATE `language` SET `name`='$lanUpName',`last_update`= current_timestamp() WHERE language_id = '$lanUID'";
		  $run_LanName_update = mysqli_query($links,$sqlUp);
		  if($run_LanName_update){
			   echo("<script type='text/javascript'>
				alert('Language name successfully updated');
			</script>");
	      echo ("<form id = 'successLan' name = 'successLan' method = 'POST' action = 'update_language.php'><input type = 'text' value = '$lanUID' name = 'update_language'/>  
			   </form>");
	      echo ("<script>updateLanCan();</script>");
		  }
		  
		  
	  }else{
		   echo("<script type='text/javascript'>
				alert('Invalid Update : Cannot be updated to database');
			</script>");
	      echo ("<form id = 'error_Lan' name = 'error_Lan' method = 'POST' action = 'update_language.php'><input type = 'text' value = '1' name = 'errorLanN'/><input type = 'text' value = '$lanUID' name = 'update_language'/>  
			   </form>");
	      echo ("<script>error_LanCant();</script>");
		  
		  
	  }
		
	}else{
		 echo("<script type='text/javascript'>
				alert('Error in fetching the data');
				window.location = 'tables_language.php';
			</script>");
				  
		
	}				
		
		
	  
  ?>
  
	
</body>
</html>