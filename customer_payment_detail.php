<?php
	session_start();
	if(!isset($_SESSION['email']))//restrict access if not login
	{
		header('location:login.php');
	}
	else if (isset($_SESSION['staff_check']))
	{
		header('location:staff_page.php');
	}
	else if (isset($_POST['pay_id']))
	{
		$payment_id = $_POST['pay_id'];
		//$mysqls = "SELECT payment.payment_date, payment.amount, IFNULL(rental.return_date,0) as returns, payment.payment_status, payment.rental_id, rental.rental_date, film.title, category.name, staff.first_name, staff.last_name FROM payment INNER JOIN rental ON payment.rental_id = rental.rental_id INNER JOIN inventory ON rental.inventory_id = inventory.inventory_id INNER JOIN film ON inventory.film_id = film.film_id INNER JOIN film_category ON film.film_id = film_category.film_id INNER JOIN category ON category.category_id = film_category.category_id INNER JOIN staff ON payment.staff_id = staff.staff_id WHERE payment.payment_id = $payment_id";
		$message = "Back to Current Payments";
		$link_back = "customer_check_payment.php";
		
	}
	else if (isset($_POST['other_payment']))
	{
		//sql code for other payment...
		$payment_id = $_POST['other_payment'];
		//$mysqls ="SELECT payment.payment_date, payment.amount, payment.payment_status, payment.rental_id, staff.first_name, staff.last_name FROM payment INNER JOIN staff ON payment.staff_id = staff.staff_id WHERE payment.payment_id = $payment_id";
		$message = "Back to Other Payments";
		$link_back = "customer_other_payment.php";
	}
	else if (isset($_POST['out_pay']))
	{
		$payment_id = $_POST['out_pay'];
		$message = "Back to Outstanding Payments";
		$link_back = "customer_outstanding_payment.php";
	}
	else if (isset($_POST['other_unpaid']))
	{
		$payment_id = $_POST['other_unpaid'];
		$message = "Back to Other Unpaid Payments";
		$link_back = "customer_other_unpaid.php";
	}
	else
	{
		//header('location:customer_check_payment.php');
		echo("<script>window.location.href = 'customer_check_payment.php';</script>");
	}
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$emails = $_SESSION['email'];
	$sql = "SELECT customer.first_name,customer.last_name FROM customer WHERE customer.email = '$emails'";
	$result = mysqli_query($links,$sql);
	$results = mysqli_fetch_assoc($result);
	$first_name = $results['first_name'];
	$last_name = $results['last_name'];
	$name = $first_name." ".$last_name;
	//conditon
	/*
	if the user is not logged in and come in this page, it will redirect you to login
	if youre staff, and you go to this page, youll be redirected to the staff page
	if youre customer, nothing happends
	*/
	/*
	if you're not from the customer_check_rent_page, you will be redirected to the customer_check_rent_page
	
	*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel = "shortcut icon" href = "img/fav.png" />
	<style>
		.details{
			font-size:12px;
		}
	</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Customer Rent Details</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
	<?php
		
		$mysqls = "SELECT payment_type.name, payment.payment_date, payment.amount, payment.payment_status, payment.rental_id, staff.first_name, staff.last_name FROM payment INNER JOIN staff ON payment.staff_id = staff.staff_id INNER JOIN payment_type ON payment.payment_type_id = payment_type.payment_type_id WHERE payment.payment_id = $payment_id";
		$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
		$result = mysqli_query ($links,$mysqls);
		$final_result = mysqli_fetch_assoc($result);
		$name = $final_result['name'];
		$mysqls2 = "SELECT IFNULL(rental.return_date,0) as returns, payment.rental_id, rental.rental_date, film.title, category.name FROM payment INNER JOIN rental ON payment.rental_id = rental.rental_id INNER JOIN inventory ON rental.inventory_id = inventory.inventory_id INNER JOIN film ON inventory.film_id = film.film_id INNER JOIN film_category ON film.film_id = film_category.film_id INNER JOIN category ON category.category_id = film_category.category_id WHERE payment.payment_id = $payment_id";
		$result2 = mysqli_query ($links,$mysqls2);
		$final_result2 = mysqli_fetch_assoc($result2);
		
	?>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <!--<i class="fas fa-laugh-wink"></i>-->
          
        </div>
        <img src = 'img/fav.png' width = '25%' title = 'Box Movyes Homepage' alt = 'Box Movyes Homepage'/>
        <div class="sidebar-brand-text mx-3">BOX MOVYES </div>
      </a>




      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="customer_page.php">
          <i class = "fa fa-user-circle"></i>
          <span>My Movyes Account</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        My Movie Records <!-- classification1 -->
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa fa-magic"></i>
          <span>Payments</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">My Payments: </h6>
             <a class="collapse-item" href="customer_check_payment.php">My Payment Records</a>
			<a class="collapse-item" href="customer_other_payment.php">Other Payment Records</a>
            <a class="collapse-item" href="customer_outstanding_payment.php">Outstanding Payments</a>
			<a class="collapse-item" href="customer_other_unpaid.php">Other Outstanding Records</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa fa-film"></i>
          <span>Rental</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">My Rentals:</h6>
            <a class="collapse-item" href="customer_check_rental.php" title = "Past Rental shows your past rental records in your Movyes account.">My Past Rentals</a>
            <a class="collapse-item" href="customer_unresolved_rental.php" title = "Unresolved rental shows the rental which has not been delivered to/picked up by you yet.">Unresolved Rentals</a>
			<a class="collapse-item" href="customer_current_rental.php" title = "Current Rental shows the Rental that has not been returned to the Store yet.">My Current Rentals</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
	  <!--
      <div class="sidebar-heading">
        Addons  
      </div>
	-->
      <!-- Nav Item - Pages Collapse Menu -->
	  <!--
      <li class="nav-item">
        <a class="nav-link" href="#" >
          <i class="fas fa-fw fa fa-universal-access"></i>
          <span>My Recommends</span>
        </a>
        
      </li>
	-->
     
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
		  
          <form action = 'search_page.php' method = 'post'class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                 
                
              <input name = 'result' type="text" placeholder = 'Search Movies here..'class="form-control bg-light border-0 small" aria-label="Search" title = 'Explore More Movies Here' aria-describedby="basic-addon2">
              <div class="input-group-append">
                  
                  
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
                
              </div>
              
            </div>
          </form>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
			
            <!--
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
               
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                
                <span class="badge badge-danger badge-counter">7</span>
              </a>
             
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>
			-->
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo($name);?></span>
                <img class="img-profile rounded-circle" src="https://media.tenor.com/images/a1b416b7518e33b010a34938d236a3fc/tenor.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="customer_page.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Account Details
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="search_page.php">
                  <i class="fas fa-fw fa fa-universal-access mr-2 text-gray-400"></i>
                  Search Movies..
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
		
                
                  <h1 class="h3 mb-4 text-gray-800">Customer Rent Details</h1>
			  
                
					<p class="mb-4">More movies, more fun. Rest assured, with our 2-step verification, all rental through our website is fully encrypted and secure.</p>
               
         
          
		  
		 
          
			<!--<h5 class="m-0 font-weight-bold text-primary"><?php
					//echo("Rental Details for Rental ID: $rental_id");
					
				  ?>
				  
		    </h5>-->
			<?php
				$payment_date = $final_result['payment_date'];
				$amount = $final_result['amount'];
				//$payment_status = $final_result['payment_status'];
				$first_name = $final_result['first_name'];
				$last_name = $final_result['last_name'];
				$payment_status = $final_result['payment_status'];
				if($payment_status ==1)
				{
					$payment_status = "Paid";
				}
				else if($payment_status == 0)
				{
					$payment_status = "Unpaid";
				}
				else if($payment_status == 2)
				{
					$payment_status = "Refund";
				}
				else if($payment_status == 3)
				{
					$payment_status = "Voided";
				}
			?>
              <!-- Circle Buttons -->
			  <?php 
				if($name=='rental')
				{
					$message_here = "Rental Details";
					
					  
				}
				else
				{
					$message_here = "Payment For";
				}
				$rental_id = $final_result2['rental_id'];
					$rental_date = $final_result2['rental_date'];
					$title = $final_result2['title'];
					$name2 = $final_result2['name'];
					echo("<div class='card shadow mb-4'>
							<div class='card-header py-3'>
								<h5 class = 'font-weight-bold'>$message_here</h5>
							  
							</div>
							<div class='card-body'>
								  <h6 class = 'font-weight-bold details' >Rental ID &nbsp;&nbsp;&nbsp;<i class = 'fas fa-info-circle' title = 'Rental ID helps uniquely identify each rental made. Please provide this when contacting us for any problems.'></i></h6>
								  <p >");
					echo($rental_id);
					echo("</p>
					  <h6 class = 'font-weight-bold details' >Rental Date</h6>
					  <p >");
					echo($rental_date);
					echo("</p><h6 class = 'font-weight-bold details' >Film Title</h6>
					  <p >");
					echo($title);
					echo("</p>
					  <h6 class = 'font-weight-bold details'>Film Category</h6>
					  <p >");
					echo($name2);  
					echo("</p>");
					if(isset($final_result['returns']))
					{
							
						$returns = $final_result['returns'];
						if($returns == 0)
						{
							
							$sql_return = "SELECT (TIMEDIFF((DATE_ADD(rental.rental_date, INTERVAL film.rental_duration*24 HOUR)),CURRENT_TIMESTAMP())/24/10000)<1 as diff, (DATE_ADD(now(), INTERVAL film.rental_duration*24 HOUR)) as return_date FROM rental INNER JOIN inventory ON rental.inventory_id = inventory.inventory_id INNER JOIN film ON inventory.film_id = film.film_id WHERE rental.rental_id = $rental_id";
							$return_result = mysqli_query($links,$sql_return);
							$final_return = mysqli_fetch_assoc($return_result);
							$diff = $final_return['diff'];
								
							if($diff = 1)
							{
								$colour = "color:red;";
								//change the text colour to red
								$spacing = "&nbsp;&nbsp;&nbsp;";
								$class = "fas fa-exclamation-circle";
							}
							else
							{
								$colour = "color:black;";
								$spacing = "";
								$class = "";
							}				
							$return_date = $final_return['return_date'];
							echo("<h6 class = 'font-weight-bold details'>Due By</h6>");
							echo("<p style = $colour><i class = '$class'></i>$spacing$return_date</p>");
								
							//item not returned
						}
						else
						{
							$sql_return = "SELECT rental.return_date FROM rental WHERE rental.rental_id = $rental_id";
							$return_result = mysqli_query($links,$sql_return);
							$final_return = mysqli_fetch_assoc($return_result);
							$return_date = $final_return['return_date'];
							echo("<h6 class = 'font-weight-bold details'>Return Date</h6>");
							echo("<p >$return_date</p>");
							//item returned
								
						}
					}
					
					if($name!='rental')
					{
						echo("<h6 class = 'font-weight-bold details'>Payment Purpose:</h6>");
						$name= strtoupper($name);
						echo("<p style = 'color:red;'>$name</p>");
					}
					echo("  </div></div>");  
					  
					  
						
						
					  
					  
					  
				  
              
			  
			  ?>
			  <div class="card shadow mb-4">
                <div class="card-header py-3">
					<h5 class = "font-weight-bold">Payment Details</h5>
                </div>
                <div class="card-body">
					
					
				  
				  
				  <h6 class = "font-weight-bold details">Payment ID &nbsp;&nbsp;&nbsp;<i class = 'fas fa-info-circle' title = 'Payment ID helps uniquely identify each rental made. Please provide this when contacting us for any problems.'></i></h6>
				  <p ><?php echo($payment_id);?></p>
				  <?php
					if(isset($payment_date))
					{
						echo("<h6 class = 'font-weight-bold details'>Payment Date</h6>
				  <p >");
						echo($payment_date);
						echo("</p>");
					}
				  ?>
				  <h6 class = "font-weight-bold details">Amount</h6>
				  <p ><?php echo($amount);?></p>
				  <h6 class = "font-weight-bold details">Status</h6>
				  <p ><?php echo($payment_status);?></p>
				  <?php
					if($payment_status =="Unpaid")
					{
						if(isset($_POST['other_unpaid']))
						{
							$name_here = "payment_id";
						}
						else
						{
							$name_here = "payment_id_out";
						}
						echo("<form action = 'payment.php' method = 'post'>
											<input style = 'display:none;' value = '$payment_id'type = 'text' name = '$name_here' />
											<input title= 'Click here to pay'type = 'submit' value = 'Pay Now' class = 'btn-info'style = 'cursor:pointer;padding:10px;border-radius:10px;'>
										</form>");
						
						
					}
				  
				  ?>
                </div>
              </div>
			  <?php
			  if($payment_status=="Paid")
			  {
				  echo("<div class='card shadow mb-4'>
                <div class='card-header py-3'>
					<h5 class = 'font-weight-bold'>Staff Details</h5>
                </div>
                <div class='card-body'>
					
				  <h6 class = 'font-weight-bold details'>Staff First Name</h6>
				  <p>");
					echo($first_name);
					echo("</p>
				  <h6 class = 'font-weight-bold details'>Staff First Name</h6>
				  <p>");
				  echo($last_name);
				  echo("</p>
                </div>
              </div>");
			  }
			  ?>
			  <?php
				echo("<a title = '$message'class = 'btn-primary' href = '$link_back' style = 'padding:12px;'>$message</a>");
				
			   ?>
              

            

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
