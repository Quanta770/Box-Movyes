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
	else if(!isset($_POST['deleteActor']))
	{
		header("location:tables_actor.php");
	}
	
//code that check if staff has logged in or not...
?>
<!DOCTYPE html>
<html>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
	<script>
		function continues()
		{
			$repli = confirm("This actor is the last actor for a film! If the actor is deleted, the film will be deleted as it has no actor too. Are you sure you want to continue?");
			if($repli == 1)
			{
				document.getElementById("forms").submit();
			}
			else
			{
				window.location.href = "tables_actor.php";
			}
		}
		function submit_form()
		{
			document.getElementById("del_actor_name").submit();
		}
	
	</script>
	<title>Delete Actor</title>
</head>
<body>
<?php
	$actor_id = $_POST['deleteActor'];
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$mysql = "SELECT film.film_id, COUNT(film_actor.actor_id) as counts FROM film_actor INNER JOIN film ON film_actor.film_id = film.film_id WHERE film_actor.film_id IN (SELECT film.film_id FROM film INNER JOIN film_actor ON film.film_id = film_actor.film_id INNER JOIN actor ON actor.actor_id = film_actor.actor_id WHERE actor.actor_id = $actor_id) GROUP BY film_actor.film_id";
	$result = mysqli_query($links,$mysql);
	$error = 0;
	$films;
	$counter = 0;
	while($row = mysqli_fetch_assoc($result))
	{
		
		if ($row['counts']==1)
		{
			$error = 1;
			$films[$counter] = $row['film_id'];
			$counter = $counter+1;
		}
		
	}
	
	if ($error ==1)
	{
		echo("<form id = 'forms' method = 'post' action = 'delete_actor_name.php' style = 'display:none'>");
		echo("<input type = 'text' value = '$actor_id' name = 'deleteActor'/>");
		echo("<input type = 'text' value = '1' name = 'deletefilm'/>");
		
		for($loop = 0;$loop<=$counter;$loop = $loop+1)
		{
			echo("<input type = 'text' value = '$films[$loop]' name = '$loop' />");
		}
		echo("<input type = 'text' value = '$counter' name = 'counter' />");
		echo("</form>");
		echo("<script>continues();</script>");
		$_SESSION['messageA'] = "Record is not deleted due to cancelation.";
	    $_SESSION['msg_typeA'] = "danger";
		//if positive, then send the following:
		//actor id, deletefilm to tell next page need to delete film, film-id need to be deleted, counter for how many film to delete
	}
	else
	{
		echo("<form method = 'post' action = 'delete_actor_name.php' id = 'del_actor_name' style = 'display:none'>");
		echo("<input type = 'text' name = 'deleteActor' value = '$actor_id'/>") ;
		echo("</form>");
		echo("<script>submit_form();</script>");
	}
?>
</body>
</html>