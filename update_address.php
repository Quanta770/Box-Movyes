<?php
    session_start();
	if(!isset($_SESSION['email']))//restrict access if not login
	{
        echo "linked";
	}
?>
<!DOCTYPE html>
<head>
<script>
	function back_fun()
	{
		document.getElementById("back_form").submit();
	}
</script>
</head>
<body>
    <?php
        $links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
        $new_address = $_POST['new_address'];
        $postcode = $_POST['new_postcode']; //user input int
        $district = $_POST['new_district']; //distric = user input text
        $city = $_POST['city_select']; //cityid
        $email = $_SESSION['email'];

        
        $sql = "SELECT customer.address_id FROM customer WHERE customer.email LIKE '$email'";
        $result = mysqli_query($links, $sql);
        $row = mysqli_fetch_assoc($result);
        $address_id = $row['address_id'];
        

        $update = "UPDATE `address` SET `address` = '$new_address', `district` = '$district', `city_id` = '$city', `postal_code`= '$postcode', `last_update` = current_timestamp() WHERE `address_id` = '$address_id'";
        
        if(!(mysqli_query($links,$update))){
            echo("<script>alert('Error update address');</script>");
        }else{
           
            echo("<script>window.location.href = 'thanks.php';</script>");
        }

             
        
    ?>

</body>
