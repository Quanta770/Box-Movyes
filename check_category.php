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
<title>Category check</title>
<script>
  function inside_Category(){
	  document.getElementById("errorCate").submit();
	  
  }


</script>
</head>
<body>
<br /><br /><br />

<?php
	
	$category_name = '';
	
	
	if(isset($_POST['cateName']))
	{		
		$category_name = $_POST['cateName'];
		
		
				
				
		$sql = "SELECT category.name FROM category WHERE 1";
		
					
		$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
		
		$results = mysqli_query ($links,$sql);

				
					
		
		$check_dupli_cateName = '';
				
	    $check_temp = True;
		while($row = mysqli_fetch_assoc($results)){
			$check_dupli_cateName = $row['name'];
			
			if((strtoupper($category_name) == strtoupper($check_dupli_cateName)) || (strtolower($category_name)== strtolower($check_dupli_cateName))){		
		    $check_temp = False;
			echo("<script type='text/javascript'>
				alert('Insertion Error: Duplicate value found');
				
			</script>");
			
			echo ("<form id = 'errorCate' name = 'errorCate' method = 'POST' action = 'film_detail.php'> <input type = 'text' value = '1' name = 'inside_Category'/><input type = 'text' value = '$category_name' name = 'backCateName' /></form>");
			echo ("<script>inside_Category();</script>");
			
			}
		}
		
			
					
		if($check_temp == True)
		{	
	     $sqlCat = "INSERT INTO `category` (`category_id`, `name`, `last_update`) VALUES (NULL, '$category_name', current_timestamp())";
		 $run_category_tb = mysqli_query($links,$sqlCat);
	      if($run_category_tb){
			
	      echo("<script type='text/javascript'>
				alert('Category successfully added');
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