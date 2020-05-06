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
<title>Delete Category</title>
<script>
  

</script>
</head>
<body>
<br /><br /><br />

<?php
 
  if(isset($_POST['deleteCate'])){
	 $categorID = $_POST['deleteCate'];
	 
	 $sqlDel = "DELETE FROM `category` WHERE category_id = '$categorID'";
	 $run_del = mysqli_query($links,$sqlDel);
	 
	 if($run_del){
		      $sql_Update_check = "UPDATE `film_category` SET `category_id`='1',`last_update`=current_timestamp() WHERE ISNULL(category_id)";
			  $run_update_new = mysqli_query($links,$sql_Update_check);
		      $_SESSION['messageC'] = "Record has been deleted";
	           $_SESSION['msg_typeC'] = "danger";
	      echo("<script type='text/javascript'>
				alert('Successfully deleted');
				window.location = 'tables_category.php';
			</script>");
		 
		 
	 }else{
		  echo("<script type='text/javascript'>
				alert('Error : Selected category is not deleted');
				window.location = 'tables_category.php';
			</script>");
		 
	 }
	 
	  
  }else{
	  echo("<script type='text/javascript'>
				alert('Error in Fetching Data');
				window.location = 'tables_category.php';
			</script>");
	  
	  
  }

	
	
	
	
	
  
?>
</body>
</html>