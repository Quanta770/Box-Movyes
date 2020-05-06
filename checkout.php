<?php
//you can comment out this part if you didnt do the login to access this page, but this is needed when accessing the checkout.

session_start();
if (!isset($_SESSION['email'])) //restrict access if not login
{
    header('location:/login/login.php');
} else if (isset($_SESSION['staff_check'])) {
    echo("<script>
        alert('Sorry, only customer can rent movies.');
        window.location.href = 'search_page.php';
    </script>");
    //header('location:staff_page.php');
}


//conditon
/*
	if the user is not logged in and come in this page, it will redirect you to login
	if youre staff, and you go to this page, youll be redirected to the staff page
	if youre customer, nothing happends
	*/
?>
<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Box personal portfolio Template</title>
    <link rel="icon" href="img/fav.png" type="image/x-icon">

    <!-- Bootstrap -->

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- main css -->

    <link href="css/style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2d27c9ba48.js" crossorigin="anonymous"></script>

    <!--ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

    <!-- modernizr -->

    <script src="js/modernizr.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="custom-scrollbar-css p-2">
    <?php
    $links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
    $film_id = $_POST['id']; //say you receive this film id from the search page.
	
    $email = $_SESSION['email'];
	
    $sql = "SELECT inventory.inventory_id, inventory.store_id FROM rental INNER JOIN inventory ON rental.inventory_id = inventory.inventory_id INNER JOIN film ON inventory.film_id = film.film_id WHERE inventory.inventory_id NOT IN (SELECT inventory.inventory_id FROM rental INNER JOIN inventory ON rental.inventory_id = inventory.inventory_id INNER JOIN film ON film.film_id = inventory.film_id WHERE rental.return_date IS NULL AND film.film_id = '$film_id' AND inventory.inventory_status_id = 3)AND film.film_id = '$film_id' AND inventory.inventory_status_id = 3 GROUP BY inventory.inventory_id";
    $sql2 = "SELECT customer.first_name, customer.last_name, address.address_id, address.address, address.postal_code, address.district FROM customer JOIN address ON customer.address_id = address.address_id WHERE customer.email LIKE \"$email\"";
    $sql3 = "SELECT film.title, film.rental_duration, film.rental_rate FROM film WHERE film.film_id = $film_id";

    $result = mysqli_query($links, $sql);
    $result2 = mysqli_query($links, $sql2);
    $result3 = mysqli_query($links, $sql3);

    $rows3 = mysqli_fetch_assoc($result3);
	$error_1 = 1;
	$error_2 = 1;
	while ($row = mysqli_fetch_assoc($result)) {
		if ($row['store_id'] == 1) {
			$error_1 = 0;
			$inventory_id1 = $row['inventory_id'];
		} else if ($row['store_id'] == 2) {
			$error_2 = 0;
			$inventory_id2 = $row['inventory_id'];
		}
		if ($error_1 == 0 && $error_2 == 0) {
			break;
		}
	}
	if($error_1 == 1 && $error_2 == 1)
	{
		
		echo("<script>
		
			alert('Sorry, this movie is out of stock.');
			window.location.href = 'search_page.php';
		
		</script>");
	}
    ?>
    <!-- Preloader -->
    <div id="preloader">
        <div class="pre-container">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <!-- end Preloader -->

    <div class="container-fluid">
        <!-- box header -->
        <header class="box-header" style="background-color:orange;">
            <div class="box-logo">
                <a href="index.php"><img src="img/logo.png" width="80" alt="Logo"></a>
            </div>

            <!-- box-nav -->
            <a class="box-primary-nav-trigger" href="#0">
                <span class="box-menu-text">Menu</span><span class="box-menu-icon"></span>
            </a>
            <!-- box-primary-nav-trigger -->
        </header>
        <!-- end box header -->

        <!-- nav -->
        <nav>
            <ul class="box-primary-nav">
                

                <li class="box-label"><a href="index.php" style="color: orange;">Home</a></li>
                <?php
                    session_start();
                    if(isset($_SESSION['customer_check']))
                    {
                        echo("<li class='box-label'><a href='customer_page.php'>Profile</a></li>");
                    }
                    else if(isset($_SESSION['staff_check']))
                    {
                        echo("<li class='box-label'><a href='staff_page.php'>Profile</a></li>");
                    }
                
                
                ?>
                <li class="box-label"><a href="about.php">About</a></li>
                <li class="box-label"><a href="search_page.php">Browse</a></li>
                <li>
                    <form class="box-label" action="search_page.php" method="POST">
                        <input name="result" type="text" onfocus="this.value=''" id="nav-search" placeholder="Search"></input>
                        <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
                    </form>
                </li>
                              
                <div class="login-logout">
                <!-- button changes based on login status -->                
                <?php 
                
                if(isset($_SESSION['email'])){
                    echo ("<div class=\"btn-group\" role=\"group\" style=\"margin: 1em;\">");
                    echo ("<a class=\"btn btn-primary btn-lg btn-warning\" style=\"color: black;\" href=\"logout.php\">Log off</a>");
                    echo ("<a class=\"btn btn-primary btn-lg btn-warning\" style=\"color: black;\" href=\"register.php\">Register</a>" );               
                    echo ("</div>");
                }else{ 
                    echo ("<div class=\"btn-group\" role=\"group\" style=\"margin: 1em;\">");
                    echo ("<a class=\"btn btn-primary btn-lg btn-warning\" style=\"font-size: 20px; color: black;\" href=\"login.php\" >Log in</a>");
                    echo ("<a class=\"btn btn-primary btn-lg btn-warning\" style=\"font-size: 20px; color: black;\" href=\"register.php\">Register</a>" );               
                    echo ("</div>");
                }

                ?>
                </div>
                <!--need to link register to register.php -->
                
            </ul>
        </nav>
        <!-- end nav -->
    </div>

    <!--checkout form-->
    <div class="container main-container" style="padding-bottom: 200px;">
        <div class="container checkout-container">
            <div class="checkout py-5 text-center">

                <h2>Checkout</h2>
                <p class="lead">You are one step away from watching your movie!</p>
                <br>
            </div>
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">1</span>
                    </h4>
                    <!--Product-->
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <?php
                                $title = $rows3['title'];
                                $duration = $rows3['rental_duration'];
                                echo "<h6 class=\"my-0\">$title</h6>";

                                echo "<small class=\"text-muted\">Rental duration: $duration days</small>";
                                ?>
                            </div>
                            <?php

                            $rate = $rows3['rental_rate'];
                            echo "<small class=\"text-muted\">Rate: $$rate</small>"
                            ?>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <br>
                            <strong>
                                <?php

                                echo "$$rate";
                                ?>
                            </strong>
                        </li>
                    </ul>

                </div>

                <!--user info-->
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Billing address</h4>
                    <form class="needs-validation" method="POST" action="confirm_checkout.php" validate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name</label>
                                <?php
                                $row2 = mysqli_fetch_assoc($result2);
                                $firstname = $row2['first_name'];
                                $lastname = $row2['last_name'];
                                $address = $row2['address'];

                                echo "<input type=\"text\" READONLY class=\"form-control\" id=\"firstName\" value=\"$firstname\" required>";
                                ?>

                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name</label>
                                <?php
                                echo "<input type=\"text\" READONLY class=\"form-control\" id=\"lastName\" value=\"$lastname\" required>";
                                ?>

                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email <span class="text-muted">(Required)</span></label>
                            <?php
                            echo "<input type=\"email\" READONLY class=\"form-control\" id=\"email\" value=\"$email\">"
                            ?>
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>
                        <label>Collection option</label>
                        <select class="custom-select d-block w-100 mb-3" required id='check_form' onchange='check_fun()' name='get_option'>
                            <option value='deliver'>Deliver to house</option>
                            <option value='pickup'>Pickup at store</option>

                        </select>
                        <label id='store_check2' style='display:none;'>Store options: </label>
                        <select class="custom-select mb-3" name='store_id' id='store_check' style='display:none;' onchange='check_inventory_fun()'>
                            <?php
                            
                            if ($error_1 == 0) {
                                echo ("<option value = '1'>Store 1</option>");
                            }

                            if ($error_2 == 0) {
                                echo ("<option value = '2'>Store 2</option>");
                            }
                            ?>

                        </select>
                        <?php
                        if(isset($inventory_id1))
                        {
                            echo ("<p id = 'inven_1' style = 'display:none;'>$inventory_id1</p>");    
                        }
                        if(isset($inventory_id2))
                        {
                            echo ("<p id = 'inven_2' style = 'display:none;'>$inventory_id2</p>");    
                        }
                        if (isset($inventory_id1)) {
                            echo ("<input type = 'text' id = 'inventory_id' value = '$inventory_id1' name = 'inventory_id' style = 'display:none;'/>");
                        } else {
                            echo ("<input type = 'text' id = 'inventory_id' value = '$inventory_id2' name = 'inventory_id' style = 'display:none;'/>");
                        }


                        ?>
                        <div class="mb-3">
                            <label for="address">Current Address</label>
                            <?php
                            $addressid = $row2['address_id'];
                            $district = $row2['district'];
                            $postcode = $row2['postal_code'];
                            echo "<input type=\"text\" READONLY class=\"form-control\" id=\"address\" value=\"$address, $postcode, $district \">"
                            ?>

                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <hr>
                        <input type="checkbox" id="change_address" name="change_address" value="yes">
                        <label for="change_address">Use other address?</label>
                        <div class="mb-3">
                            <label for="address2">Change delievry address <span class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" id="address" name="new_address" placeholder="Apartment or suite">
                        </div>
                        <div class="mb-3">
                            <label for="address2">Postal code <span class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" id="postcode" name="new_postcode" placeholder="Postal code">
                        </div>
                        <div class="mb-3">
                            <label for="address2">District <span class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" id="district" name="new_district" placeholder="District">
                        </div>

                        <div class="row">
                            <div class="checkout-select col-md-5 mb-3">
                                <label for="country">City <span class="text-muted">(Optional)</span></label>
                                <select id="select-city" required="required" autocomplete="off" name="city_select" placeholder="Choose...">
                                    <?php

                                    $sqli = "SELECT city_id,city FROM `city` WHERE 1";
                                    $result2 = mysqli_query($links, $sqli);

                                    while ($row = mysqli_fetch_assoc($result2)) {

                                        $selected = (isset($_POST['city_select']) && $_POST['city_select'] ==  $row['city_id']) ? 'selected' : '';

                                        echo "<option value='$row[city_id]' $selected >$row[city]</option>";
                                    }

                                    ?>

                                </select>

                            </div>

                        </div>

                        <hr>

                        <h4 class="mb-3">Payment</h4>

                        <div class="d-block my-3">
                            <div class="form-check">
                                <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                                <label class="custom-control-label" for="credit">Credit card</label>
                            </div>
                            <div class="form-check">
                                <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="custom-control-label" for="debit">Debit card</label>
                            </div>
                            <div class="form-check">
                                <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="custom-control-label" for="paypal">PayPal</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-cvv">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>
                        <hr>
                        <input type="checkbox" name="condition">
                        <label id="condition" for="condition"> *I accept the Terms and Conditions and the Privacy Notice.</label>
                       
                        <?php
                                               
                        echo "<input type='hidden'id='film_id' value='$film_id' name='film_id' style='display:none;'/>";
                       	//echo "<input type='hidden' name='store_id' value='$store_id'></input>";
						
						
						
						
                        ?>
                        <input class="btn btn-primary btn-lg btn-block" style="margin-top: 1.5rem;" type="submit" value="Confirm"></input>
                    </form>
                </div>
            </div>


        </div>
        <footer class="my-5 pt-5 text-muted text-center text-small bg-w">
            <ul class="list-inline" style="margin-bottom: 2px;">
                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f fa-md"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab fa-instagram fa-md"></i></a></li>
                <li class="list-inline-item"><a href="https://github.com/Quanta770/Box-Movyes" target="_blank"><i class="fab fa-github fa-md"></i></a></li>
                
            </ul>
            <p class="mb-1">&copy; 2017-2019 Box Movyes</p>
        </footer>


    </div>


    <!--footer -->

    <!-- 
    <footer>
        <div class="container-fluid">
            <p class="copyright">© Box Portfolio 2016</p>
        </div>
    </footer>
    -->
    <!-- end footer -->

    <!-- back to top -->
    <a href="#0" class="cd-top"><i class="ion-android-arrow-up"></i></a>
    <!-- end back to top -->



    <!-- jQuery -->

    <script src="js/jquery-2.1.1.js"></script>
    <!--  plugins -->

    <script src="js/bootstrap.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/animated-headline.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>




    <!--  custom script -->
    <script src="js/custom.js"></script>

    <!-- google analytics  -->

    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-76796224-1', 'auto');
        ga('send', 'pageview');
    </script>
    <script>
        function check_inventory_fun() {
            $form = document.getElementById("store_check");
            $form_value = $form.options[$form.selectedIndex].value;
            if ($form_value == "1") {
                $values = document.getElementById("inven_1").innerHTML;
                document.getElementById("inventory_id").value = $values;
            } else if ($form_value == "2") {
                $values = document.getElementById("inven_2").innerHTML;
                document.getElementById("inventory_id").value = $values;
            }
        }

        function check_fun() {
            $form = document.getElementById("check_form");
            $form_value = $form.options[$form.selectedIndex].value;
            if ($form_value == "pickup") {
                document.getElementById("store_check").style = 'display:block;';
                document.getElementById("store_check").required = true;
                document.getElementById("store_check2").style = 'display:block;';
            } else {
                document.getElementById("store_check").required = false;
                document.getElementById("store_check").style = 'display:none;';
                document.getElementById("store_check2").style = 'display:none;';
            }
        }
    </script>
    <script>
        $(document).ready(function() {

            $('#select-city').selectize({
                sortField: 'text'
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#select-country').selectize({
                sortField: 'text'
            });
        });
    </script>
</body>

</html>