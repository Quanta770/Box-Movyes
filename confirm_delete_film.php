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
<title>Insert film</title>
<script>
  

</script>
</head>
<body>
<br /><br /><br />

<?php
 
  if(isset($_POST['deleteButton'])){
	 $temp_store = [];
	 $filmID = $_POST['deleteButton'];

	
		 $sqlID = "DELETE FROM `film` WHERE film_id = '$filmID'";
		 $run_delete_ID = mysqli_query($links,$sqlID);
		 if($run_delete_ID){
			   $_SESSION['message'] = "Record has been deleted";
	           $_SESSION['msg_type'] = "danger";
	      echo("<script type='text/javascript'>
				alert('Successfully deleted');
				window.location = 'tables.php';
			</script>");
		 }else{
			   echo("<script type='text/javascript'>
				alert('Error : Film is not deleted');
				window.location = 'tables.php';
			</script>");
		 }
		 

	 
	  
  }else{
	  echo("<script type='text/javascript'>
				alert('Error in Fetching Data');
				window.location = 'tables_update.php';
			</script>");
	  
	  
  }

	
	
	
	
	
  
?>
</body>
</html>