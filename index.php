
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

    <div id="homepage" class="container-fluid">
        <!-- box header -->
        <header class="box-header">
            <div class="box-logo">
                <a href="index.html"><img src="img/logo.png" width="80" alt="Logo"></a>
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
                    echo ("<a class=\"login-logout btn btn-primary btn-lg btn-warning\" style=\"color: black;\" href=\"logout.php\">Log off</a>");
                    echo ("<a class=\"login-logout btn btn-primary btn-lg btn-warning\" style=\"color: black;\" href=\"register.php\">Register</a>" );               
                    echo ("</div>");
                }else{ 
                    echo ("<div class=\"btn-group\" role=\"group\" style=\"margin: 1em;\">");
                    echo ("<a class=\"login-logout btn btn-primary btn-lg btn-warning\" style=\" color: black;\" href=\"login.php\" >Log in</a>");
                    echo ("<a class=\"login-logout btn btn-primary btn-lg btn-warning\" style=\"color: black;\" href=\"register.php\">Register</a>" );               
                    echo ("</div>");
                }

                ?>
                </div>
                <!--need to link register to register.php -->
                
            </ul>
        </nav>
        <!-- end nav -->

        <!-- box-intro -->
        <section class="box-intro">
            <div class="table-cell">
                <h1 class="box-headline letters rotate-2">
                    <span class="box-words-wrapper">
                        <b class="is-visible">Movies.</b>
                        <b>Films.</b>
                        <b>Drama.</b>
                        <b>Action.</b>
                    </span>
		        </h1>
                <h5>everything you need to entertain yourself</h5>
            </div>

            <div class="mouse">
                <div class="scroll"></div>
            </div>
        </section>
        <!-- end box-intro -->
    </div>

    <!-- portfolio div -->
    <div class="main-container">
            <div class="portfolio-div">
            <div class="portfolio">
                <div class="no-padding portfolio_container">
                    <!-- single work -->
                    <div class="col-md-3 col-sm-6 fashion ads">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/06.jpg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>Little Women</span></span>
                                        <em>Drama / Romance</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->

                    <!-- single work -->
                    <div class="col-md-3 col-sm-6 ads graphics">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/03.jpg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>Joker</span>
                                        <em>Drama / Thriller</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->

                    <!-- single work -->
                    <div class="col-md-6 col-sm-12 photography">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/02.jpg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>Game of Thrones</span>
                                        <em>Serial / Action</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->

                    <!-- single work -->
                    <div class="col-md-3 col-sm-6 fashion ads">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/04.jpg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>Avengers: Endgame</span>
                                        <em>Action</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->

                    <!-- single work -->
                    <div class="col-md-3 col-sm-6 graphics ads">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/011.jpeg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>Toy Story</span>
                                        <em>Family / Children</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->

                    <!-- single work -->
                    <div class="col-md-6 col-sm-12 photography">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/010.jpg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>Wonder Woman</span>
                                        <em>Action</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->

                    <!-- single work -->
                    <div class="col-md-3 col-sm-6 graphics ads">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/015.jpg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>Parasite</span>
                                        <em>Drama / Thriller</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->

                    <!-- single work -->
                    <div class="col-md-3 col-sm-6 graphics ads">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/016.jpg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>Avengers: Infinity War</span>
                                        <em>Action</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->

                    <!-- single work -->
                    <div class="col-md-3 col-sm-6 graphics ads">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/08.jpg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>ALABAMA DEVIL</span>
                                        <em>Horror</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->

                    <!-- single work -->
                    <div class="col-md-3 col-sm-6 graphics ads">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/09.jpg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>Black Widow</span>
                                        <em>Action</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->
                    
                    <!-- single work -->
                    <div class="col-md-3 col-sm-6 fashion ads">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/015.jpg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>Parasite</span>
                                        <em>Drama / Thriller</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->
                    
                    <!-- single work -->
                    <div class="col-md-3 col-sm-6 fashion ads">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/012.jpg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>Spider-Man: Far From Home</span>
                                        <em>Action / Comedy</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->
                    <!--start here new line-->
                    <!-- single work -->
                    <div class="col-md-6 col-sm-12 photography">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/014.jpeg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>James Bond</span>
                                        <em>Action</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->
                    <!-- single work -->
                    <div class="col-md-3 col-sm-6 fashion ads">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/013.jpg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>ALICE FANTASIA</span>
                                        <em>Classics</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->
                    

                    <!-- single work -->
                    <div class="col-md-3 col-sm-6 ads graphics">
                        <a href="#" class="portfolio_item">
                            <img src="img/portfolio/07.jpg" alt="image" class="img-responsive" />
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>The Irishman</span>
                                        <em>Drama</em>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- end single work -->

                    
                </div>
                <!-- end portfolio_container -->
            </div>
            <!-- portfolio -->
            
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
    
    <!-- end portfolio div -->

    <!-- footer -->
    
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


    <!--  custom script -->
    <script src="js/custom.js"></script>
    
    <!-- google analytics  -->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
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

</body>

</html>