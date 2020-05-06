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
<title>Delete Actor</title>
<script>
  

</script>
</head>
<body>
<br /><br /><br />

<?php
 
  if(isset($_POST['deleteActor'])&&isset($_POST['deletefilm']))
  {
	
	$counter = $_POST['counter'];
	for($loop = 0;$loop<=$counter;$loop = $loop+1)
	{
		$film_id = $_POST[$loop];
		$mysql = "DELETE FROM `film` WHERE film.film_id = '$film_id'";
		mysqli_query($links,$mysql);
		
	}
	$acID = $_POST['deleteActor'];
	 
	 $sqlDel = "DELETE FROM `actor` WHERE actor_id = '$acID'";
	 mysqli_query($links,$sqlDel);
	 $_SESSION['messageA'] = "Record has been deleted";
	           $_SESSION['msg_typeA'] = "danger";
	      echo("<script type='text/javascript'>
				alert('Successfully deleted');
				window.location = 'tables_actor.php';
			</script>");
	
  }
  else if(isset($_POST['deleteActor']))
  {
	 $acID = $_POST['deleteActor'];
	 
	 $sqlDel = "DELETE FROM `actor` WHERE actor_id = '$acID'";
	 $run_del = mysqli_query($links,$sqlDel);
	 
	 if($run_del){
		      $_SESSION['messageA'] = "Record has been deleted";
	           $_SESSION['msg_typeA'] = "danger";
	      echo("<script type='text/javascript'>
				alert('Successfully deleted');
				window.location = 'tables_actor.php';
			</script>");
		 
		 
	 }else{
		  echo("<script type='text/javascript'>
				alert('Error : Selected actor is not deleted');
				window.location = 'tables_actor.php';
			</script>");
		 
	 }
	 
	  
  }else{
	  echo("<script type='text/javascript'>
				alert('Error in Fetching Data');
				window.location = 'tables_actor.php';
			</script>");
	  
	  
  }

	
	
	
	
	
  
?>
</body>
</html>