<?php
	$sql_start = "SELECT staff.email FROM staff WHERE staff.staff_id = 3";
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$result_start = mysqli_query ($links,$sql_start);
	$staff_email = mysqli_fetch_assoc($result_start);
	$staff_email = $staff_email['email'];
	
	session_start();
	if(isset($_SESSION['customer_check']))
	{
		header("location:customer_page.php");
		//is customer
	}
	else if(!isset($_SESSION['email']))
	{
		//is guest
		header("location:staff_login.php");
	}
	else if ($_SESSION['email']!=$staff_email)
	{
		//is staff
		
		header("location:staff_page.php");
	}
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
	$emails = $_SESSION['email'];
	$sql = "SELECT staff.first_name,staff.last_name FROM staff WHERE staff.email = '$emails'";
	$result = mysqli_query($links,$sql);
	$results = mysqli_fetch_assoc($result);
	$first_name = $results['first_name'];
	$last_name = $results['last_name'];
	$name = $first_name." ".$last_name;
	
//add such that redirect back when not database admin login....


?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel = "shortcut icon" href = "img/fav.png" />
	<script>
		function encrypt_pass_func()
		{
			$pass = document.getElementById("o_password").innerHTML;
			$length = $pass.length;
			$counters = 0;
			$output = "";
			while($counters<$length)
			{
				
				if($counters<=1)
				{
					
					$output +=$pass[$counters];
					
				}
				else
				{
					$output+= '*';
				}
				$counters++;
			}
			document.getElementById("o_password").innerHTML = "";
			document.getElementById("encrypted_field").value = $output;
			
		}
		function areyousurefun()
		{
			confirm("Are you sure");
			
		}
	</script>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>
  <?php
	if(isset($_POST['old_staff']))
	{
		echo("Edit Staff Details");
	}
	else
	{
		echo("Add New Staff");
	}
  ?>
  
  </title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

</head>

<body id="page-top" onbeforeunload = "areyousurefun();" >
	
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
      <li class="nav-item">
        <a class="nav-link" href="staff_page.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Staff Pages
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Film Component</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">FILM :</h6>
             <a class="collapse-item" href="film.php">Add Film</a>
            <a class="collapse-item" href="tables.php">Update/Delete Film</a>
			<a class="collapse-item" href="film_detail.php">Add Film Details</a>
			<a class="collapse-item" href="tables_language.php">Update/Delete Languages</a>
			<a class="collapse-item" href="tables_category.php">Update/Delete Category</a>
			<a class="collapse-item" href="tables_actor.php">Update/Delete Actors</a>
          </div>
        </div>
      </li>
<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Inventory Component</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Inventory :</h6>
            <a class="collapse-item" href="inventory.php">Add Inventory with movie</a>
			<a class="collapse-item" href="view_inventory_stock.php">View inventory quantity</a>
		    <a class="collapse-item" href="tables_inventory.php">Update/Delete Inventory</a>
			 <h6 class="collapse-header">Inventory Status Pages:</h6>
			<a class="collapse-item" href="tables_inventory_status.php">View Inventory Status</a>
          </div>
        </div>
      </li>
		
		<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Rental Component</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Rental :</h6>
            <a class="collapse-item" href="Add_rental.php">Add new rental</a>
			<a class="collapse-item" href="online_rental_process.php">Online rental process</a>
			<a class="collapse-item" href="store_collect_rental.php">Store rental process</a>
			<a class="collapse-item" href="customer_rental_return.php">Customer return process</a>
			 <a class="collapse-item" href="tables_rental.php">Update/Delete Rental</a>
			  <a class="collapse-item" href="view_rental_cancelled.php">View Cancelled Rental</a>
			   <h6 class="collapse-header">Rental Status Pages:</h6>
			    <a class="collapse-item" href="tables_rental_status.php">View Rental Status</a>
          </div>
        </div>
      </li>
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
          <i class="fas fa-fw fa-folder"></i>
          <span>Payment Component</span>
        </a>
        <div id="collapseExample" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Payment :</h6>
            <a class="collapse-item" href="rental_payment.php">Rental Payment</a>
			<a class="collapse-item" href="late_payment.php">Late Payment</a>
			<a class="collapse-item" href="lost_payment.php">Lost Payment</a>
			<a class="collapse-item" href="view_refund.php">Refunded Payment View</a>
			 <a class="collapse-item" href="view_void.php">Void Payment View</a>
			  <a class="collapse-item" href="tables_payment.php">Update/Delete Payment</a>
			   <h6 class="collapse-header">Payment Status Pages:</h6>
			     <a class="collapse-item" href="tables_payment_status.php">View Payment Type Status</a>
				  <a class="collapse-item" href="view_payment_status.php">View Payment Status</a>
          </div>
        </div>
      </li>
	   
	   <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAddress" aria-expanded="true" aria-controls="collapseAddress">
          <i class="fas fa-fw fa-folder"></i>
          <span>Address Component</span>
        </a>
        <div id="collapseAddress" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Address :</h6>
            <a class="collapse-item" href="country.php">Add New Country</a>
			  <a class="collapse-item" href="tables_country.php">Update/Delete Country</a>
			  <a class="collapse-item" href="city.php">Add New City</a>
			   <a class="collapse-item" href="tables_city.php">Update/Delete City</a>
          </div>
        </div>
      </li>
	  <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer" aria-expanded="true" aria-controls="collapseCustomer">
          <i class="fas fa-fw fa-folder"></i>
          <span>Customer Component</span>
        </a>
        <div id="collapseCustomer" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Customer :</h6>
            <a class="collapse-item" href="staff_view_customer.php">Manage Customer</a>
			  <a class="collapse-item" href="add_new_customer.php">Add New Customer</a>
			 
          </div>
        </div>
      </li>
	
	
	  <!-- Divider -->
      <hr class="sidebar-divider">
	  <!-- Heading -->
      <div class="sidebar-heading">
        Admin Pages
      </div>
		<?php
		$email_here_pew = $_SESSION['email'];
		$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
		$sql_here_pew = "SELECT staff_id FROM staff WHERE staff.email = '$email_here_pew'";
		$result = mysqli_query($links,$sql_here_pew);
		$result = mysqli_fetch_assoc($result);
		$staff_id2 = $result['staff_id'];
		//sub2pewdiepie
		if($staff_id2 == 3)
		{
			echo("<li class='nav-item '>
        <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseTwos' aria-expanded='true' aria-controls='collapseTwos'>
          <i class='fas fa-building'></i>
          <span>Store</span>
        </a>
        <div id='collapseTwos' class='collapse' aria-labelledby='headingTwos' data-parent='#accordionSidebar'>
          <div class='bg-white py-2 collapse-inner rounded'>
            <h6 class='collapse-header'>Store Components:</h6>
            <a class='collapse-item active' href='admin_store.php'>My Stores</a>
            <a class='collapse-item' href='add_store_admin.php'>Add New Store</a>
          </div>
        </div>
      </li>

      
      <li class='nav-item'>
        <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseUtilitiess' aria-expanded='true' aria-controls='collapseUtilitiess'>
          <i class='fas fa-user-graduate'></i>
          <span>Staff</span>
        </a>
        <div id='collapseUtilitiess' class='collapse' aria-labelledby='headingUtilities' data-parent='#accordionSidebar'>
          <div class='bg-white py-2 collapse-inner rounded'>
            <h6 class='collapse-header'>Store Components:</h6>
            <a class='collapse-item' href='admin_staff.php'>My Staffs</a>
            <a class='collapse-item' href='staff_add.php'>Add New Staff</a>
            
          </div>
        </div>
      </li>");
		}
	   
	   ?>
      <!-- Divider -->
      <hr class="sidebar-divider">
	  
      <!-- Heading -->
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

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
			<!--
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
			  -->
              <!-- Dropdown - Messages -->
			  <!--
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
			-->
            <!-- Nav Item - Alerts -->
			<!--
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
				<?php echo($name);?>
				</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="staff_page.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="admin_pages.php">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Admin Pages
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="search_page.php">
                  <i class="fas fa-fw fa fa-universal-access mr-2 text-gray-400"></i>
                  Search Movies..
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
		<?php
			
			$message = "Add New Staff";
			if(isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['address'])&&isset($_POST['district'])&&isset($_POST['email_address'])&&isset($_POST['city'])&&isset($_POST['store']))
			{
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$address = $_POST['address'];
				$address2 = $_POST['address2'];
				$district = $_POST['district'];
				$postal_code = $_POST['postal_code'];
				$city = $_POST['city'];
				$store = $_POST['store'];
				$email_address = $_POST['email_address'];
				$phone_number = $_POST['phone_number'];
								
								
			}
			else if(isset($_POST['old_staff']))
			{
				$staff_id = $_POST['staff_id'];                                                            																										//something wrong here?
				$sql_old_staff = "SELECT staff.first_name, staff.last_name, address.address, address.address2, address.district, address.postal_code, address.city_id, address.postal_code, address.phone, IFNULL(staff.store_id,0)as store_id, staff.email, staff.password FROM staff INNER JOIN address ON staff.address_id = address.address_id WHERE staff.staff_id = $staff_id";
				$result = mysqli_query($links, $sql_old_staff);
				$row = mysqli_fetch_assoc($result);
				$disabled = "disabled";
				//putting the values inside a variable
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];
				$address = $row['address'];
				$address2 = $row['address2'];
				$district = $row['district'];
				$postal_code = $row['postal_code'];
				$city = $row['city_id'];
				$store = $row['store_id'];
				$email_address = $row['email'];
				$phone_number = $row['phone'];
				$password = $row['password'];
				
				
				$message = "Update Current Staff";
				
						
			}
			else
			{
					
				$first_name = "";
				$last_name = "";
				$address = "";
				$address2 = "";
				$district = "";
				$postal_code = "";
				$city = "";
				$store = "-1";
				$email_address = "";
				$phone_number = "";
					
			}
		
		
		
		?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
			<?php
				if(isset($password))
				{
					echo("<p style = 'display:none;' id = 'o_password'>$password</p>");
					
				}
				
			?>
          <!-- Page Heading -->
		  <?php
			echo("<h1 class='h3 mb-2 text-gray-800'>$message - Form</h1>");
			if (isset($_POST['old_staff']))
			{
				echo("<p class='mb-4'>Update your employee details</p>");
				echo("<a href = 'admin_staff.php'><span class = 'btn btn-primary'>Back to Staff Table</span></a>");
			}
			else
			{
				echo("<p class='mb-4'>Congratulations on employing a new staff!</p>");
				echo("<a href = 'admin_staff.php'><span class = 'btn btn-primary'>Back to Staff Table</span></a>");
			}
		  
		  
		  ?>
          <div class="row">

            

				<br />	

              <div class="card shadow mb-4" style = "width:1000px;">
                <div class="card-header py-3">
                  <?php
					echo("<h5 class='m-0 font-weight-bold text-primary'>$message</h5>");
					
				  ?>
                </div>
                <div class="card-body" >
                  <form method = 'post' action = 'staff_add_check.php' id = 'add_staff_form'>
						<?php
							if(isset($_POST['success_add']))
							{
								echo("<p><span style = 'font-size:17px;color:#1cc88a'>Successfully added staff!</span></p>");
								
							}
							else if(isset($_POST['password_err']))
							{
								if($_POST['password_err']==1)
								{
									echo("<p><span style = 'font-size:17px;color:red'>Password does not match!</span></p>");
								}
								else if ($_POST['password_err']==2)
								{
									echo("<p><span style = 'font-size:17px;color:red'>Email has been used before!</span></p>");
								}
							}
							else if (isset($_POST['success_update_staff']))
							{
								echo("<p><span style = 'font-size:17px;color:#1cc88a'>Successfully updated staff!</span></p>");
								
							}
							if(isset($_POST['old_staff']))
							{
								echo("<p><span style = 'font-size:20px;'><b>Staff ID: $staff_id</b></span></p>");
							}
						?>
						
						<p><span style = 'font-size:17px;'><b>First Name: </b></span></p>
						<?php
							echo("<input required = 'required'value = '$first_name'minlength = '3'maxlength = '45' pattern ='[^\s][A-Za-z0-9 , \s]+' class = 'form-control form-control-user'type = 'text' name = 'first_name' title = 'First Name' />");
						?>
					
						<p><span style = "font-size:17px;"><b>Last Name: </b></span></p>
						<?php
							echo("<input required = 'required'value = '$last_name'minlength = '3' maxlength = '45' pattern = '[^\s][A-Za-z0-9 , \s]+' class = 'form-control form-control-user'type = 'text' name = 'last_name' title = 'Last Name' />");
						?>
					
						<p><span style = "font-size:17px;"><b>Phone Number: (Optional)</b></span></p>
						<?php
							echo("<input value = '$phone_number'minlength = '6' pattern = '[0-9]+' class = 'form-control form-control-user'type = 'text' name = 'phone_number' title = 'Phone Number' />");
						?>
					
						<p><span style = "font-size:17px;"><b>Address: </b></span></p>
						<?php
							echo("<input required = 'required'value = '$address' minlength = '3' maxlength = '50' pattern = '[^\s][A-Za-z0-9 , \s]+' class = 'form-control form-control-user'type = 'text' name = 'address' title = 'Address' />");
						?>
					
						<p><span style = "font-size:17px;"><b>Address 2: (Optional)</b></span></p>
						<?php
							echo("<input value = '$address2' minlength = '3' maxlength = '50' pattern = '[^\s][A-Za-z0-9 , \s]+' class = 'form-control form-control-user'type = 'text' name = 'address2' title = 'Address 2 (Optional)' />");
						?>
					
						<p><span style = "font-size:17px;"><b>District</b></span></p>
						<?php
							echo("<input required = 'required'value = '$district' minlength = '4' maxlength = '20' pattern = '[^\s][A-Za-z0-9 , \s]+' class = 'form-control form-control-user'type = 'text' name = 'district' title = 'District' />");
						?>
					
						<p><span style = "font-size:17px;"><b>Postal Code: (Optional)</b></span></p>
						<?php
							echo("<input value = '$postal_code' minlength = '4' maxlength = '10' pattern = '[0-9]+' class = 'form-control form-control-user'type = 'text' name = 'postal_code' title = 'Postal Code' />");
						?>
					
						<p><span style = "font-size:17px;"><b>City</b></span></p>
						<select autocomplete = 'off' required = 'required' title = 'City' name = 'city' id='list'  placeholder='Pick a city or search'>	 
							 <?php
							  // $city = $cus_details['city'];
							   echo "<option value = ''>-- Select a city --</option>";
							   $sqli = "SELECT city_id,city FROM `city` WHERE 1";
							   $result2 = mysqli_query($links, $sqli);
							   
							   while($row = mysqli_fetch_assoc($result2)){
									if($row[city_id]==$city)
									{
										$selected1 = "selected";
									}
									else
									{
										$selected1 = "";
									}
								   
									echo "<option value='$row[city_id]'   $selected1>$row[city]</option>";
									   
									  
							   }
								   
												 
							 ?>
						</select>
					
					    <?php
					        
					            echo("<p><span style = 'font-size:17px;'><b>Assign to Store: </b></span></p>");
        						echo("<select autocomplete = 'off' required = 'required' name = 'store_id' required = 'required' title = 'Store' placeholder = 'Pick a store'>");
        							
        								echo "<option value = ''>Pick a store</option>";
        								$sql_here= "SELECT store.store_id, address.address FROM store INNER JOIN address ON store.address_id = address.address_id WHERE 1";
        								$result2 = mysqli_query($links, $sql_here);
        								while($row = mysqli_fetch_assoc($result2))
        								{
        									
        									$store_id = $row['store_id'];
        									if($store_id == $store)
        									{
        										$selected2 = "selected";
        									}
        									else
        									{
        										$selected2 = "";
        									}
        									$address = $row['address'];
        									$final = $store_id." - ".$address;
        									echo "<option value='$store_id'  $selected2>$final</option>";
        								}
        								$selected2 = "";
        								if($store==0)
        								{
        									$selected2 = "selected";
        								}
        								
        								
        								echo "<option value=0  $selected2>None for now</option>";
        							
        						echo("</select>");
					        
    						
					    ?>
						<p><span style = "font-size:17px;"><b>Staff Email Address</b></span></p>
						<?php
							echo("<input value = '$email_address' maxlength = '50' minlength = '9'class = 'form-control form-control-user'type = 'email' name = 'email'required = 'required' title = 'Staff Email Address' />");
							
						?>
						<?php
							if(isset($_POST['old_staff']))
							{
								echo("<p><span style = 'font-size:17px;'><b>Current Password: </b></span></p>");
								echo("<input type = 'text' id = 'encrypted_field' $disabled style = 'cursor:not-allowed;' class = 'form-control form-control-user' />");
								echo("<input type = 'text' style = 'display:none;' name = 'old_staff' value = 1 />");
								echo("<input type = 'text'  name = 'staff_id' style = 'display:none;' value = '$staff_id' />");
								$password_message = "New Password";
								$required = "";
							}
							else
							{
								$password_message ="Password for Staff";
								$required = "required";
							}
						
						
						
						
							echo("<p><span style = 'font-size:17px;'><b>$password_message</b></span></p>");
						
							echo("<input maxlength = '40' minlength = '5'class = 'form-control form-control-user'type = 'password' id = 'password'name = 'password'$required title = 'Password' />");
						
						
					
							echo("<p><span style = 'font-size:17px;'><b>Confirm Password</b></span></p>");
						
							echo("<input maxlength = '40' minlength = '5'class = 'form-control form-control-user'type = 'password' id = 'password_confirm'name = 'password_confirm' $required title = 'Confirm Password' />");
						
							echo("<br />");
						
							echo("<input type = 'submit' title = 'Add new customer' value = '$message' class = 'btn btn-primary' style = 'float:right;'/> ");
							if(isset($password))
							{
								echo("<script>encrypt_pass_func();</script>");
								unset($password);
							}
						?>
				  </form>
				  
                  
                </div>
              </div>

            

          </div>
			<?php
				
					echo("<a href = 'admin_staff.php'><span class = 'btn btn-primary'>Back to Staff Table</span></a>");
			
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
  <!--<script src="vendor/jquery/jquery.min.js"></script>-->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <!--<script src="vendor/jquery-easing/jquery.easing.min.js"></script>-->

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
	<script>
	   $(document).ready(function () {
		  $('select').selectize({
			  sortField: 'text'
		  });
	  });
	</script>
</body>

</html>
