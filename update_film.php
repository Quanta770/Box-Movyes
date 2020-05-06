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
  function inside_Film(){
	  document.getElementById("sameValue").submit();
	  
  }
  
  function dupli_title(){
	  document.getElementById("dupliTitle").submit();
	  
  }
  
  function error_update_film(){
	  document.getElementById("errorFilm").submit();
	  
  }
  function updateCan(){
	  document.getElementById("successFilm").submit();
  }

</script>
</head>
<body>
<br /><br /><br />

<?php
 
   if(isset($_POST['up_filmId'])&& isset($_POST['up_title'])){
	   $tempCheck = True; //True will continue, false will quit
	   $exeUp_filmId = $_POST['up_filmId'];
	   $exeUp_title = $_POST['up_title'];
	   $exeUp_description = $_POST['up_description'];
	   $exeUp_releaseYear = $_POST['up_yyear'];
	   $exeUp_language = $_POST['up_languages'];
	   $exeUp_rentalDuration = $_POST['up_rentalDuration'];
	   $exeUp_rentalRate = $_POST['up_rentalRate'];
	   $exeUp_filmLength = $_POST['up_filmLenght'];
	   $exeUp_replacementCost = $_POST['up_replacementCost'];
	   $exeUp_filmRating = $_POST['up_filmRating'];
	   $exeUp_actor_in_film = $_POST['up_actorss'];
	   $exeUp_category_in_film = $_POST['up_categoryss'];
	   $checkTitle = $_POST['check_title'];
	   if(isset($_POST['up_specFea'])){
		    $exeUp_specialFeature = implode(',', $_POST['up_specFea']);
		}else{
			$exeUp_specialFeature = '';
			
		}
	   
	   //Check if user update any data for film
	   $sql_Check_Film = "SELECT * FROM `film` WHERE film_id = '$exeUp_filmId'";
	   $result =  mysqli_query($links,$sql_Check_Film);
	   $film_result = mysqli_fetch_assoc($result);
	   $fromdb_filmId = $film_result['film_id'];
	   $fromdb_title = $film_result['title'];
	   $fromdb_description = $film_result['description'];
	   $fromdb_releaseYear = $film_result['release_year'];
	   $fromdb_language = $film_result['language_id'];
	   $fromdb_rentalDuration = $film_result['rental_duration'];
	   $fromdb_rentalRate = $film_result['rental_rate'];
	   $fromdb_length = $film_result['length'];
	   $fromdb_replacementCost = $film_result['replacement_cost'];
	   $fromdb_rating = $film_result['rating'];
	   $fromdb_specialF = $film_result['special_features'];
	   
	  
	   if($exeUp_filmId == $fromdb_filmId && $exeUp_title == $checkTitle && $exeUp_description == $fromdb_description && $exeUp_releaseYear == $fromdb_releaseYear && $exeUp_language == $fromdb_language && $exeUp_rentalDuration == $fromdb_rentalDuration && $exeUp_rentalRate == $fromdb_rentalRate && $exeUp_filmLength == $fromdb_length && $exeUp_replacementCost == $fromdb_replacementCost && $exeUp_filmRating == $fromdb_rating && $exeUp_specialFeature == $fromdb_specialF){
		  
           $sql_Check_Category = "SELECT * FROM `film_category` WHERE film_id ='$exeUp_filmId'";
	       $sql_Check_actor = "SELECT * FROM `film_actor` WHERE film_id = '$exeUp_filmId'";
		   $result1 = mysqli_query($links,$sql_Check_actor);
		   $result2 = mysqli_query($links,$sql_Check_Category);
		    $tempStore_actor = [];
			$tempStore_category = [];
		   while($actor_result=mysqli_fetch_assoc($result1)){
			   $tempStore_actor[] = $actor_result['actor_id'];
		   }
		   while($category_result=mysqli_fetch_assoc($result2)){
			   $tempStore_category[] = $category_result['category_id'];
		   }
		   
		   if(($tempStore_actor == $exeUp_actor_in_film) && ($tempStore_category == $exeUp_category_in_film)){
			 $tempCheck = False;
			 echo("<script type='text/javascript'>
				alert('Invalid update : same value found');	
			 </script>");
			 echo ("<form id = 'sameValue' name = 'sameValue' method = 'POST' action = 'tables_update.php'> <input type = 'text' value = '1' name = 'inside_update_film'/> <input type = 'text' value = '$exeUp_filmId' name = 'update_film'/>  
			   </form>");
		     echo ("<script>inside_Film();</script>");
			
			      
		   }else{
			   $tempCheck = True;
			  
		   }
			   
	   }else{
		   $tempCheck = True;
		   
		      
	   }
	   $check_Validity = 0;
	   if($tempCheck == True){
		   $sql = "SELECT film.title FROM film WHERE film.title <>'$fromdb_title'";
		   $results = mysqli_query($links,$sql);
		   $check_dupli_film = '';		
		 while($row = mysqli_fetch_assoc($results)){
			$check_dupli_film = $row['title'];	
			if(strtoupper($exeUp_title) == strtoupper($check_dupli_film)){
			 $check_Validity = 1;
		     echo("<script type='text/javascript'>
				alert('Invalid update : Duplicate Title Name Found');	
			 </script>");
			 echo ("<form id = 'dupliTitle' name = 'dupliTitle' method = 'POST' action = 'tables_update.php'> <input type = 'text' value = '1' name = 'dupliTitleUp'/> <input type = 'text' value = '$exeUp_filmId' name = 'update_film'/>  
			   </form>");
		     echo ("<script>dupli_title();</script>");

			}				
	     }
	  }    
	
      if($check_Validity == 0){
		  
		  $sql_film_update = "UPDATE `film` SET `film_id`='$exeUp_filmId',`title`='$exeUp_title',`description`= NULLIF('$exeUp_description',''),`release_year`= NULLIF('$exeUp_releaseYear',''),`language_id`='$exeUp_language',`original_language_id`=NULL,`rental_duration`='$exeUp_rentalDuration',`rental_rate`='$exeUp_rentalRate',`length`= NULLIF('$exeUp_filmLength',''),`replacement_cost`='$exeUp_replacementCost',`rating`= NULLIF('$exeUp_filmRating',''),`special_features`= NULLIF('$exeUp_specialFeature',''),`last_update`=current_timestamp() WHERE film_id = '$exeUp_filmId'";
		  $run_Film_update = mysqli_query($links,$sql_film_update);
		  $sql_take_iniActor = "SELECT actor_id FROM film_actor WHERE film_id = '$exeUp_filmId'";
		  $resultAU = mysqli_query($links,$sql_take_iniActor); //take all the actor_id out to compare
		  $tempStore_act_update = [];
		   while($actor_up_result=mysqli_fetch_assoc($resultAU)){
			   $tempStore_act_update[] = $actor_up_result['actor_id'];     //get all the value from the database for actor
		   }
		  $result = array_diff($exeUp_actor_in_film,$tempStore_act_update); //this is user add new actor that is different from the database
		  $result2 = array_diff($tempStore_act_update,$exeUp_actor_in_film);//this is to delete from the database
		  foreach($result as $value){
			  if($value != ''){
		     $sqlins = "INSERT INTO `film_actor`(`actor_id`, `film_id`, `last_update`) VALUES ('$value','$exeUp_filmId',current_timestamp())";
			 $run_actor_insert = mysqli_query($links,$sqlins);
			  }
			  
		  }
		  foreach($result2 as $input){
			  if($input != ''){
			  $sqlDel = "DELETE FROM `film_actor` WHERE actor_id = '$input' && film_id='$exeUp_filmId'";
			  $run_actor_delete = mysqli_query($links,$sqlDel);
			  }
		  }
		  $sql_take_iniCate = "SELECT * FROM `film_category` WHERE film_id = '$exeUp_filmId'";
		  $resultCate = mysqli_query($links,$sql_take_iniCate);
		  $tempStore_cate_update = [];
		   while($cate_up_result=mysqli_fetch_assoc($resultCate)){
			   $tempStore_cate_update[] = $cate_up_result['category_id'];     //get all the value from the database for category
		   }
		  $resultC1 = array_diff($exeUp_category_in_film,$tempStore_cate_update); //this is user add new category that is different from the database
		  $resultC2 = array_diff($tempStore_cate_update,$exeUp_category_in_film);//this is to delete from the database
		  foreach($resultC1 as $valuess){
			 if($valuess != ''){
		     $sqlCateI = "INSERT INTO `film_category`(`film_id`, `category_id`, `last_update`) VALUES ('$exeUp_filmId','$valuess',current_timestamp())";
			 $run_category_insert = mysqli_query($links,$sqlCateI);
			 }
			  
		  }
		  foreach($resultC2 as $inputss){
			  if($inputss != ''){
			  $sqlCDel = "DELETE FROM `film_category` WHERE category_id = '$inputss' and film_id = '$exeUp_filmId'";
			  $run_category_delete = mysqli_query($links,$sqlCDel);
			  }
		  }
		  
		  
		  if($run_Film_update){
				  
		  echo("<script type='text/javascript'>
				alert('Film successfully updated');
			</script>");
	      echo ("<form id = 'successFilm' name = 'successFilm' method = 'POST' action = 'tables_update.php'><input type = 'text' value = '$exeUp_filmId' name = 'update_film'/>  
			   </form>");
	      echo ("<script>updateCan();</script>");
			  
		  }else{
		     echo("<script type='text/javascript'>
				alert('Invalid update : Film is not updated');	
			 </script>");
			 echo ("<form id = 'errorFilm' name = 'errorFilm' method = 'POST' action = 'tables_update.php'> <input type = 'text' value = '1' name = 'error_film_update'/> <input type = 'text' value = '$exeUp_filmId' name = 'update_film'/>  
			   </form>");
		     echo ("<script>error_update_film();</script>");
		 
		  }
		  
		 if($run_actor_insert || $run_actor_delete){
			   echo("<script type='text/javascript'>
				alert('Film successfully updated');
			</script>");
	      echo ("<form id = 'successFilm' name = 'successFilm' method = 'POST' action = 'tables_update.php'><input type = 'text' value = '$exeUp_filmId' name = 'update_film'/>  
			   </form>");
	      echo ("<script>updateCan();</script>");
			 
		 }
		  
		   if($run_category_insert || $run_category_delete){
			   echo("<script type='text/javascript'>
				alert('Film successfully updated');
			</script>");
	      echo ("<form id = 'successFilm' name = 'successFilm' method = 'POST' action = 'tables_update.php'><input type = 'text' value = '$exeUp_filmId' name = 'update_film'/>  
			   </form>");
	      echo ("<script>updateCan();</script>");
			 
		 }
	 }else{
		     echo("<script type='text/javascript'>
				alert('Invalid update : Film is not updated');	
			 </script>");
			 echo ("<form id = 'errorFilm' name = 'errorFilm' method = 'POST' action = 'tables_update.php'> <input type = 'text' value = '1' name = 'error_film_update'/> <input type = 'text' value = '$exeUp_filmId' name = 'update_film'/>  
			   </form>");
		     echo ("<script>error_update_film();</script>");
		  
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