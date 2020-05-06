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
<title>Delete language</title>
<script>
  

</script>
</head>
<body>
<br /><br /><br />

<?php
 
  if(isset($_POST['deleteLangu'])){
	 $langID = $_POST['deleteLangu'];
	 
	 $sqlDel = "DELETE FROM `language` WHERE language_id = '$langID'";
	 $run_del = mysqli_query($links,$sqlDel);
	 
	 
	 
	 if($run_del){
		    $updateFL = "UPDATE `film` SET `language_id`='1',`last_update`= current_timestamp() WHERE ISNULL(language_id)";
			$run_up = mysqli_query($links,$updateFL);
		       $_SESSION['messageL'] = "Record has been deleted";
	           $_SESSION['msg_typeL'] = "danger";
	      echo("<script type='text/javascript'>
				alert('Successfully deleted');
				window.location = 'tables_language.php';
			</script>");
		 
		 
	 }else{
		  echo("<script type='text/javascript'>
				alert('Error : Selected language is not deleted');
				window.location = 'tables_language.php';
			</script>");
		 
	 }
	 
	  
  }else{
	  echo("<script type='text/javascript'>
				alert('Error in Fetching Data');
				window.location = 'tables_language.php';
			</script>");
	  
	  
  }

	
	
	
	
	
  
?>
</body>
</html>