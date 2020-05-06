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
  function same_valueF(){
	  document.getElementById("sameVa").submit();
	  
  }
  function success_Update(){
	   document.getElementById("successUpdate").submit();
  }
  
 function error_Update(){
	   document.getElementById("errorUpdate").submit();
 }
</script>
</head>
<body>
<br /><br /><br />

<?php
	
   $checker = True;
   $needUpdateCusID = '';
   $needUpdateinvenFilm = '';
   $theRentalID = '';
   if(isset($_POST['up_CusEmail'])&& isset($_POST['up_invenFilmID']) && isset($_POST['up_rentalId'])){
	   
	   
	    $getStaffEmail = $_SESSION['email'];
		$sql = "SELECT * from `staff` where email = '$getStaffEmail'";
		$runG = mysqli_query($links,$sql);
		$result = mysqli_fetch_assoc($runG);
		$staffID = $result['staff_id'];   
	   
	  $needUpdateCusID = $_POST['up_CusEmail'];
	  $needUpdateinvenFilm = $_POST['up_invenFilmID'];
	  $theRentalID = $_POST['up_rentalId'];
	  
	  $selectExisting = "SELECT customer_id, inventory_id FROM `rental` WHERE rental_id = ' $theRentalID'";	
	  $query = mysqli_query($links,$selectExisting);
	  $run = mysqli_fetch_assoc($query);
	  
		  $getActualCusID = $run['customer_id'];
		  $getActualInvenID = $run['inventory_id'];
		  if($needUpdateCusID == $getActualCusID && $needUpdateinvenFilm == $getActualInvenID){
			   $checker = False;
			   echo("<script type='text/javascript'>
				alert('Invalid update : Same value as before');	
			   </script>");
			   echo ("<form id = 'sameVa' name = 'sameVa' method = 'POST' action = 'update_rental.php'> <input type = 'text' value = '1' name = 'same_value_found'/> <input type = 'text' value = '$theRentalID' name = 'update_rental'/>  
			   </form>");
		       echo ("<script>same_valueF();</script>");
		  }
		  
		  if($checker == True){
			  $sqlUpdateQuery = "UPDATE `rental` SET `inventory_id`='$needUpdateinvenFilm',`customer_id`='$needUpdateCusID',`staff_id`='$staffID',`last_update`=current_timestamp() WHERE rental_id = ' $theRentalID'";
			  $run_update = mysqli_query($links,$sqlUpdateQuery);
			  if($run_update){
				   echo("<script type='text/javascript'>
				   alert('Updated Successfully');	
			       </script>");
			       echo ("<form id = 'successUpdate' name = 'successUpdate' method = 'POST' action = 'update_rental.php'><input type = 'text' value = '$theRentalID' name = 'update_rental'/>  
			       </form>");
		           echo ("<script>success_Update();</script>");
				  
			  }else{
				   echo("<script type='text/javascript'>
				   alert('Unable to updated into the database');	
			       </script>");
			       echo ("<form id = 'errorUpdate' name = 'errorUpdate' method = 'POST' action = 'update_rental.php'> <input type = 'text' value = '1' name = 'error_updating'/> <input type = 'text' value = '$theRentalID' name = 'update_rental'/>  
			       </form>");
		           echo ("<script>error_Update();</script>");
				  
			  }
			  
			  
			  
		  }
	
	  
	  
      	  
   }else{
	   
	    echo("<script type='text/javascript'>
				alert('Error in Fetching Data');
				window.location = 'tables_rental.php';
			</script>");
	   
	   
   }
	   



	
	
	
	
	
  
?>
</body>
</html>