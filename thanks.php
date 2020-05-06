<?php
//you can comment out this part if you didnt do the login to access this page, but this is needed when accessing the checkout.

session_start();
if (!isset($_SESSION['email'])) //restrict access if not login
{
    header('location:/login/login.php');
} else if (isset($_SESSION['staff_check'])) {
    header('location:staff_page.php');
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


    <div class="container main-container" style="padding-bottom: 200px;">
        <div class="w-100 container text-center message">
            <h1>Thank you for your purchase!</h1>
            <img src="img/cat.png" class="img-fluid" width="300" height="300"></img>
            <h1><a href="search_page.php">-- Go back --</a></h1>
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