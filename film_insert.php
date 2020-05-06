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
<title>Insert film</title>
<script>
  function inside_Film(){
	  document.getElementById("errorLang").submit();
	  
  }


</script>
</head>
<body>
<br /><br /><br />

<?php
	
	$film_title = '';
	$film_description = '';
	$release_year = '';
	$film_language = '';
	$rental_duration = '';
	$rental_rate = '';
	$film_length = '';
	$replacement_cost = '';
	$film_rating = '';
	$special_feature = '';
	$actor_in_film = '';
	$category_in_film = '';
	
	
	if(isset($_POST['title']) && isset($_POST['rentalDuration']) && isset($_POST['rentalRate']))
	{		
		$film_title = $_POST['title'];
		$film_description = $_POST['description'];
		$release_year = $_POST['yyear'];
		$film_language = $_POST['languages'];
		$rental_duration = $_POST['rentalDuration'];
		$rental_rate = $_POST['rentalRate'];
		$film_length = $_POST['filmLenght'];
		$replacement_cost = $_POST['replacementCost'];
		$film_rating = $_POST['filmRating'];
		
		if(isset($_POST['specFea'])){
		  $special_feature = implode(',', $_POST['specFea']);
		}else{
			$special_feature = '';
			
		}
		
				
				
		$sql = "SELECT film.title FROM film WHERE 1";
		
					
		$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
		
		$results = mysqli_query ($links,$sql);

							
		
		$check_dupli_film = '';		
	    $check_temp = True;
		while($row = mysqli_fetch_assoc($results)){
			$check_dupli_film = $row['title'];
			if(strtoupper($film_title) == strtoupper($check_dupli_film)){	
			//$_SESSION['lanName'] = $_POST['languName'];
		    $check_temp = False;
			echo("<script type='text/javascript'>
				alert('Insertion Error: Duplicate film title found');
				
			</script>");
			//$store = [];
			
			
			
			$store = $_POST['actorss'];
			$handle = implode(" ",$store);
			
			$storeC = $_POST['categoryss'];
			$handleC = implode(" ",$storeC);
			
			echo ("<form id = 'errorLang' name = 'errorLang' method = 'POST' action = 'film.php'> <input type = 'text' value = '1' name = 'inside_Film_ins'/>
			        <input type = 'text' value = '$film_title' name = 'back_film_title' />
					 <input type = 'text' value = '$film_description' name = 'back_film_description' />
					  <input type = 'text' value = '$release_year' name = 'back_release_year' />
					   <input type = 'text' value = '$film_language' name = 'back_film_language' />
					    <input type = 'text' value = '$rental_duration' name = 'back_rental_duration' />
						 <input type = 'text' value = '$rental_rate' name = 'back_rental_rate' />
						  <input type = 'text' value = '$film_length' name = 'back_film_lenght' />
						   <input type = 'text' value = '$replacement_cost' name = 'back_replacement_cost' />
						    <input type = 'text' value = '$film_rating' name = 'back_film_rating' />
							 <input type = 'text' value = '$special_feature' name = 'back_special_feature' />
							  <input type = 'text' value = '$handle' name = 'back_actor_in_film' />
							   <input type = 'text' value = '$handleC' name = 'back_category_in_film' /></form>");
			echo ("<script>inside_Film();</script>");
			 
			}
		}
		if($check_temp == True)
		{	
	     $sqlFilm = "INSERT INTO `film` (`film_id`, `title`, `description`, `release_year`, `language_id`, `original_language_id`, `rental_duration`, `rental_rate`, `length`, `replacement_cost`, `rating`, `special_features`, `last_update`) VALUES (NULL, '$film_title', NULLIF('$film_description',''), NULLIF('$release_year',''), '$film_language', NULL, '$rental_duration', '$rental_rate', NULLIF('$film_length',''), '$replacement_cost', NULLIF('$film_rating',''), NULLIF('$special_feature',''), current_timestamp());";
		 $run_language_tb = mysqli_query($links,$sqlFilm);
	      if( $run_language_tb){
			  $film_id_in= mysqli_insert_id($links);
			
				foreach ($_POST['actorss'] as $value) 
				{
					$ins = "INSERT INTO `film_actor` (`actor_id`, `film_id`, `last_update`) VALUES ('$value', '$film_id_in', current_timestamp());";
					$run_actorss_tb = mysqli_query($links,$ins);
					if(!$run_actorss_tb){
						echo("<script type='text/javascript'>
						alert('Error in inserting the data inside actor');
						window.location = 'film.php';
						</script>");
						
					}
				}
				
				foreach ($_POST['categoryss'] as $valueC) 
				{
					$insC = "INSERT INTO `film_category` (`film_id`, `category_id`, `last_update`) VALUES (' $film_id_in', '$valueC', current_timestamp());";
					$run_categoryss_tb = mysqli_query($links,$insC);
					if(!$run_categoryss_tb){
						echo("<script type='text/javascript'>
						alert('Error in inserting the data inside category');
						window.location = 'film.php';
						</script>");
						
					}
				}
				
				
	      echo("<script type='text/javascript'>
				alert('Film successfully added');
				window.location = 'film.php';
			</script>");
			
		  }
		  else{
			   echo("<script type='text/javascript'>
				alert('Error in inserting the data');
				window.location = 'film.php';
			</script>");
			  
			  
		  }		  
		
        	   
		}	
			
					
		
	  
	} 
	 else
	 {
		//header('location:index.html'); // Need change to the SB admin home page
		echo("<script>window.location.href = 'index.php';</script>");
	 }		 
	  
	  
  ?>
  
	
</body>
</html>