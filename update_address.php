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

        
        $sql = "SELECT customer.customer_id FROM customer WHERE customer.email LIKE '$email'";
        $result1 = mysqli_query($links, $sql);
        $rows1 = mysqli_fetch_assoc($result1);
        $customer_id = $rows1['customer_id'];
       


        $insert1 = "INSERT INTO `address` (`address_id`, `address`, `district`, `city_id`, `postal_code`,  `last_update`) VALUES (NULL, '$new_address',  '$district', '$city', '$postcode', current_timestamp());";
        if(!(mysqli_query($links,$insert1))){
            echo("<script>alert('Error insert address');</script>");
        }

        $sql1 = "SELECT address.address_id FROM address WHERE address.address LIKE '$new_address'";
        $result2 = mysqli_query($links, $sql1);
        $rows2 = mysqli_fetch_assoc($result2);
        $address_id = $rows2['address_id'];
       
        $insert2 = "UPDATE `customer` SET `address_id`= '$address_id' WHERE `customer_id` = $customer_id;"; //update not insert

        if(!(mysqli_query($links,$insert2))){
            echo("<script>alert('Error update customer address');</script>");
        }else{
           
            echo("<script>window.location.href = 'thanks.php';</script>");
        }

    ?>

</body>
