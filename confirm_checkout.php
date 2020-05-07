<?php
	//you can comment out this part if you didnt do the login to access this page, but this is needed when accessing the checkout.
	
	session_start();
	if(!isset($_SESSION['email']))//restrict access if not login
	{
		header('location:login.php');
	}
	else if (isset($_SESSION['staff_check']))
	{
		header('location:staff_page.php');
	}
	else if(!(isset($_POST['film_id'])&&isset($_POST['get_option'])&&isset($_POST['inventory_id'])))
	{
		header('location:searchpage.php');
	}	
	
	//conditon
	/*
	if the user is not logged in and come in this page, it will redirect you to login
	if youre staff, and you go to this page, youll be redirected to the staff page
	if youre customer, nothing happends
	*/
?>
<!DOCTYPE html>
<head>
<script>
	function back_fun()
	{
		document.getElementById("back_form").submit();
	}

	function submit()
	{
		document.getElementById("update_address").submit();
	}
</script>
<title>Processing request</title>
</head>
<body>
<?php

	$new_address = $_POST['new_address'];
	$postcode = $_POST['new_postcode']; //user input int
	$district = $_POST['new_district']; //distric = user input text
	$city = $_POST['city_select']; //cityid

	if ( isset($_POST['change_address']) && $_POST['change_address'] == 'yes'){
		echo "<form id = 'update_address' type='hidden' action='update_address.php' method='POST'> ";
		echo "<input name='new_postcode' value='$new_address' ></input>";
		echo "<input name='new_address' value='$postcode' ></input>";
		echo "<input name='new_district' value='$district' ></input>";
		echo "<input name='city_select' value='$city' ></input>";
		echo "</form>";
		echo "<script>submit()</script>";
	}


	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$film_id = $_POST['film_id'];
	$option = $_POST['get_option'];
	$inventory_id = $_POST['inventory_id'];
	$email = $_SESSION['email'];
	$customer_id = "SELECT customer.customer_id FROM customer WHERE customer.email LIKE '$email'";
	
	$result1 = mysqli_query($links,$customer_id);
	$customer_id = mysqli_fetch_assoc($result1);
	$customer_id = $customer_id['customer_id'];
	
	
	if($option == 'deliver')
	{
		$status_id = 2;
		$payment_status = 1;
		
		$sql2 = "INSERT INTO rental (`rental_id`, `rental_date`,`inventory_id`,`customer_id`,`return_date`,`staff_id`,`status_id`,`collect_store_id`,`last_update`) VALUES (NULL,current_timestamp(),'$inventory_id','$customer_id',NULL,'4','$status_id',NULL,current_timestamp());";
		
	}
	else
	{
		$status_id = 1;
		$payment_status = 0;
		
		$store_id = $_POST['store_id'];
		$sql2 = "INSERT INTO `rental` (`rental_id`, `rental_date`,`inventory_id`,`customer_id`,`return_date`,`staff_id`,`status_id`,`collect_store_id`,`last_update`) VALUES (NULL,current_timestamp(),'$inventory_id','$customer_id',NULL,'4','$status_id','$store_id',current_timestamp());";
		
		
	}
	$result5 = mysqli_query($links,$sql2);
	
	
	$sql3 = "SELECT rental.rental_id FROM rental WHERE rental.inventory_id = '$inventory_id' AND rental.customer_id = '$customer_id' AND rental.staff_id  = '4' AND rental.status_id = '$status_id'";
	$result3 = mysqli_query($links,$sql3);
	$rental_id = mysqli_fetch_assoc($result3);
	$rental_id = $rental_id['rental_id'];
	
	
	if(!isset($rental_id)){
		echo "<script>alert(Rental for this item already exist. Error code 1234.);</script>";
	}
	
	//getting the amount to charge the user
	
	$sql4 = "SELECT film.rental_rate FROM film WHERE film.film_id = '$film_id'";
	$result4 = mysqli_query($links,$sql4);
	$rental_rate = mysqli_fetch_assoc($result4);
	$rental_rate = $rental_rate['rental_rate'];
	if($option == 1)
	{
		$additional_charge = $rental_rate *.05;
		$amount = $rental_rate+$additional_charge;
	}else{
		$amount = $rental_rate;
	}
	$sql5 = "INSERT INTO `payment`(`payment_id`, `customer_id`,`staff_id`,`rental_id`,`amount`,`payment_date`,`payment_status`,`payment_type_id`,`last_update`) VALUES (NULL,'$customer_id','4','$rental_id','$amount',NULL,'$payment_status','1',current_timestamp());";//insert into payment

	$result5 = mysqli_query($links,$sql5);
	
	
	if($result5 == 1)
	{
		echo("<script>alert('Successfully rented item!');</script>");
		echo("<script>window.location.href = 'thanks.php';</script>");
	}
	else
	{
		echo("<script>alert('Error fetching data');</script>");
		
	}
	
?>
</body>