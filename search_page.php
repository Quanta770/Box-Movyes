<?php
include 'search.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Box personal portfolio Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="ionicons/css/ionicons.min.css" rel="stylesheet">
    <link rel="icon" href="img/fav.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/2d27c9ba48.js" crossorigin="anonymous"></script>
    <!-- main css -->
    <link href="css/style.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.dataTables.min.css">



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
            <div class="row" style="margin-right: 0px; margin-left: -15px;">
                <!-- <h2 class="text-center box-name">Movyes</h2> -->

                <div class="col-md-4 box-logo">
                    <a href="index.php"><img src="img/logo.png" width=80 alt="Logo"></a>

                </div>

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
                if (isset($_SESSION['customer_check'])) {
                    echo ("<li class='box-label'><a href='customer_page.php'>Profile</a></li>");
                } else if (isset($_SESSION['staff_check'])) {
                    echo ("<li class='box-label'><a href='staff_page.php'>Profile</a></li>");
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

                    if (isset($_SESSION['email'])) {
                        echo ("<div class=\"btn-group\" role=\"group\" style=\"margin: 1em;\">");
                        echo ("<a class=\"btn btn-primary btn-lg btn-warning\" style=\"color: black;\" href=\"logout.php\">Log off</a>");
                        echo ("<a class=\"btn btn-primary btn-lg btn-warning\" style=\"color: black;\" href=\"register.php\">Register</a>");
                        echo ("</div>");
                    } else {
                        echo ("<div class=\"btn-group\" role=\"group\" style=\"margin: 1em;\">");
                        echo ("<a class=\"btn btn-primary btn-lg btn-warning\" style=\"color: black;\" href=\"login.php\" >Log in</a>");
                        echo ("<a class=\"btn btn-primary btn-lg btn-warning\" style=\"color: black;\" href=\"register.php\">Register</a>");
                        echo ("</div>");
                    }

                    ?>
                </div>
                <!--need to link register to register.php -->

            </ul>
        </nav>
        <!-- end nav -->

    </div>



    <!-- main-search -->
    <div id="topbar-browse" class="special top-bar">
        <h1>Browse</h1>
        <div class="search-m ">
            <div class="search-s "></div>
        </div>
    </div>
    <!-- end main-search -->
    <div class="search-text text-center">
        <h2>Browse and search movies</h2>
    </div>
    <!--main content/ display search result-->
    <div id="search-table" class="main-container slideanim">

        <table class="table js-dynamitable table-bordered table-responsive table-striped" id="search_result">
            <thead>

                <tr>
                    <th></th>

                    <th>Title</th>
                    <th>Description</th>
                    <th>Release Year</th>

                    <th>Category</th>
                    <th>Rating</th>
                </tr>


            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

                    <th></th>
                    <th></th>
                </tr>

            </tfoot>

        </table>

        <footer class="bg-w my-5 pt-5 text-muted text-center text-small">
            <ul class="list-inline" style="margin-bottom: 2px;">
                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f fa-md"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab fa-instagram fa-md"></i></a></li>
                <li class="list-inline-item"><a href="https://github.com/Quanta770/Box-Movyes" target="_blank"><i class="fab fa-github fa-md"></i></a></li>

            </ul>
            <p class="mb-1">&copy; 2017-2019 Box Movyes</p>
        </footer>
    </div>

    <!--end main content-->
    <?php

    if (isset($_POST['result'])) {
        $result = $_POST['result'];
        echo ("<p style = 'display:none;'id = 'result'>$result</p>");
    } else {
        echo ("<p style = 'display:none;'id = 'result'></p>");
    }


    ?>






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
    <script src="js/jquery-datatables-column-filter.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>


    <!--  custom script -->
    <script src="js/custom.js"></script>
    <script>
        $result = document.getElementById("result").innerHTML;
        
        /* Formatting function for row details - modify as you need */
        function format(d) {
            // `d` is the original data object for the row
            
            
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                '<td>' +
                '<form action = "checkout.php" name = "rental" method = "POST">' +
                '<input name="id" type="hidden" value = "' + d.film_id + '"></input>' +
                '<input type = "submit" value = "Rent"></input>' +
                '</form>' +
                '</td' +
                '<br>' +
                '<td>' + 'Copies available: ' + d.Stock + '</td>' +
                '</tr>' + 
                '</table>';
        }

        $(document).ready(function() {
            var table = $('#search_result').DataTable({
                responsive: true,
                ajax: {
                    url: 'assignment2.json',
                    dataSrc: ''
                },

                "columns": [{
                        "className": 'details-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },

                    {
                        "data": "title"
                    },
                    {
                        "data": "description"
                    },
                    {
                        "data": "release_year"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "rating"
                    }
                ],
                "order": [
                    [1, 'asc']
                ],
                "search": {
                    "search": $result
                },
                initComplete: function() {
                    this.api().columns([3, 4, 5]).every(function() {
                        var column = this;
                        var select = $('<select><option value="">All</option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                }



            })


            // Add event listener for opening and closing details
            $('#search_result tbody').on('click', 'td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }

            });

        });
    </script>
    <!--slide animation-->
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

</body>

</html>