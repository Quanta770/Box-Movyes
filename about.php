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
    <script src="https://kit.fontawesome.com/2d27c9ba48.js" crossorigin="anonymous"></script>

    <!-- main css -->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">

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
        <header class="box-header">
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

    <!-- Top bar -->
    <div id="topbar-about" class="special top-bar">
        <h1>About</h1>
        <div class="mouse" style="color: black;">
            <div class="scroll"></div>
        </div>
    </div>
    <!-- end Top bar -->

    <!-- Main container -->
    <div id="about" class="container-fluid main-container about" style="padding-bottom: 180px;">
        <div class="container about-container bg-w text-center">
            <img class="shadow" src="img/logo.png"></img>
            <div class="row about-text text-center">
                <h2>About us</h2>
                <p>At BOX MOVYES, you can rent movies for a low economically price. Then, you can either have the movies delivered to your house or picked up at one of our store, at your desire!</p>
            </div>

        </div>
        <div class="container-fluid about-container bg-grey">
            <div class="row about-text">
                <div class="col-sm-8">
                    <h2>Low prices</h2>
                    <p>Our prices are definately lowest in the market! Feel free to check around, you will definitely agree that Netflix sounds more like Cashfix.</p>
                </div>
                <div class="col-sm-4">
                    <span class=""><img src="img/money.gif" style="height:50%; width:50%;"></img></span>
                </div>
            </div>
        </div>
        <div class="container-fluid about-container bg-w">
            <div class="row about-text">
                <div class="col-sm-4">
                    <span class=""><img src="img/coin.gif" style="height:50%; width:50%;"></img></span>
                </div>
                <div class="col-sm-8">
                    <h2>Low late return fees</h2>
                    <p>The late return fees are very low, therefore if you can return in time, just dont. Our shareholders need more cash.</p>
                </div>
            </div>
        </div>
        <div class="container-fluid about-container bg-grey">
            <div class="row about-text">
                <div class="col-sm-8">
                    <h2>Customer portal</h2>
                    <p>Each customer has a portal that they can view your rented movies, payments and so on!</p>
                </div>
                <div class="col-sm-4">
                    <span class=""><img src="img/portal.png" style="height:30%; width:30%;"></img></span>
                </div>
            </div>
        </div>
        <div class="container-fluid about-container bg-w">
            <div class="row about-text">
                <div class="col-sm-4">
                    <span class=""><img src="img/earth.png" style="height:50%; width:50%;"></img></span>
                </div>
                <div class="col-sm-8">
                    <h2>Wide variety of movies</h2>
                    <p>Our database has the world's largest database of movies. Choose from Classic to Science Fiction movies in our database! Dont even mention that we dont have Endgame, it is coming soon!</p>
                </div>
            </div>
        </div>
        <div id="team-container" class="container-fluid text-center bg-grey " style="padding-bottom: 0px;">
            <div id="teams">
                <h2>Meet the team</h2>

                <div class="row text-center team-text slideanim">
                    <div class="col-sm-4 team-icon">
                        <div class="thumbnail">
                            <img src="img/team/member-3.png" class="img-fluid" width="200" height="200">
                            <p class="thumbnail-p">
                                <h4>Yap Uen Hsieh</h4>
                            </p>
                            <p class="x-1">Front-end</p>
                        </div>
                    </div>
                    <div class="col-sm-4 team-icon">
                        <div class="thumbnail">
                            <img src="img/team/member-1.png" class="img-fluid" alt="New York" width="200" height="200">
                            <p class="thumbnail-p">
                                <h4>Chew Boon Chan</h4>
                            </p>
                            <p class="x-1">Back-end</p>
                        </div>
                    </div>
                    <div class="col-sm-4 team-icon">
                        <div class="thumbnail">
                            <img src="img/team/member-2.png" class="img-fluid" alt="San Francisco" width="200" height="200">
                            <p class="thumbnail-p">
                                <h4>How Khai Chuin</h4>
                            </p>
                            <p class="x-1">Back-end</p>
                        </div>
                    </div>

                </div>
            </div>
            <br>
            <br>
        </div>
        <div id="carousel" class="container-fluid carousel-container bg-w">
            <div id="carousel-title" class="row  text-center">
                <h2>What our customers say</h2>
            </div>
            <div id="myCarousel" class="container-fluid carousel-container carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="img/04.jpg" style="width:100%; opacity: 0.75">
                        <div class="carousel-caption review">
                            <h4 ><i class="fa fa-quote-left"></i> Amazing prices, my family and I always spend the summer break renting movies and having a great time at minimal price. <i class="fa fa-quote-right"></i><br> ~ Pewdiepie</h4><br>
                            
                        </div>
                    </div>

                    <div class="item">
                        <img src="img/04.jpg" style="width:100%; opacity: 0.75">
                        <div class="carousel-caption review">
                        <h4 ><i class="fa fa-quote-left"></i> Delivery is the best, especially now. I would be bored to death during lockdown without the movie deliveries. <i class="fa fa-quote-right"></i><br> ~ John Cena</h4><br>
                        </div>
                    </div>

                    <div class="item">
                        <img src="img/04.jpg" style="width:100%; opacity: 0.75">
                        <div class="carousel-caption review">
                        <h4 ><i class="fa fa-quote-left"></i> Customer friendly portal allows me to track my rented movies in 1 click! <i class="fa fa-quote-right"></i><br> ~ T-Series</h4><br>
                        </div>
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>


        <!-- end Main container -->
        <footer class="my-5 pt-5 text-muted text-center text-small bg-grey">
            <ul class="list-inline" style="margin-bottom: 2px;">
                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f fa-md"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab fa-instagram fa-md"></i></a></li>
                <li class="list-inline-item"><a href="https://github.com/Quanta770/Box-Movyes" target="_blank"><i class="fab fa-github fa-md"></i></a></li>

            </ul>
            <p class="mb-1">&copy; 2017-2019 Box Movyes</p>
        </footer>



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
        <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>


        <!--  custom script -->
        <script src="js/custom.js"></script>
        <script>
            $(window).scroll(function() {
                $(".slideanim").each(function() {
                    var pos = $(this).offset().top;

                    var winTop = $(window).scrollTop();
                    if (pos < winTop + 600) {
                        $(this).addClass("slide");
                    }
                });
            });
        </script>

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
    </div>
</body>

</html>