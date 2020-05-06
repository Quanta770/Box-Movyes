<?php
	session_start();
	if(isset($_SESSION['customer_check']))
	{
		header("Location:customer_page.php");
	}
	else if(!isset($_SESSION['email']))
	{
		header("Location:staff_login.php");
	}//end of general staff login check
	else if(!isset($_POST['customer_id']))
	{
		header("Location:staff_view_customer.php");
	}
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel = "shortcut icon" href = "img/fav.png" />
	<script>
		
		function pass_me_fun()
		{
			$passcode = document.getElementById("passme").innerHTML;
			$counters = 0;
			$output = "";
			
			$length = $passcode.length;
					
			while($counters<$length)
			{
				
				if($counters<=1)
				{
					
					$output +=$passcode[$counters];
					
				}
				else
				{
					$output+= '*';
				}
				$counters++;
			}
			document.getElementById("password_form").value = $output;
			document.getElementById("password2").value = $output;
			document.getElementById("passme").innerHTML = "";
		}
		function password_fun()
		{
			document.getElementById("password_forms").submit();
		}
	</script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Buttons</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper" >

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
		$staff_id = $result['staff_id'];
		//sub2pewdiepie
		if($staff_id == 3)
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
       

            <!-- Nav Item - Alerts -->
          

            <!-- Nav Item - Messages -->
         

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  <?php 
			        $getStaffEmails = $_SESSION['email'];
					$sql = "SELECT * from `staff` where email = '$getStaffEmails'";
					$runStaff = mysqli_query($links,$sql);
					$resultStaffDisplay = mysqli_fetch_assoc($runStaff);
					if(!empty($resultStaffDisplay['staff_id'])){
						$getStaffFname = $resultStaffDisplay['first_name'];
						$getStaffLname = $resultStaffDisplay['last_name'];
						
					}else{
						$getStaffFname =  '-';
						$getStaffLname =  '-';
						
					}
			  
			  
			  ?>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $getStaffFname; echo '&nbsp'; echo $getStaffLname;     ?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="staff_page.php">
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
		<?php
			$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
			$customer_id = $_POST['customer_id'];
			$sql = "SELECT customer.first_name, customer.last_name, customer.email, customer.password, address.address, address.address2, address.district, address.city_id, address.postal_code, address.phone FROM customer INNER JOIN address ON customer.address_id = address.address_id WHERE customer.customer_id = '$customer_id'";
			$result = mysqli_query($links, $sql);
			$row = mysqli_fetch_assoc($result);
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$email = $row['email'];
			$password = $row['password'];
			$address = $row['address'];
			$address2 = $row['address2'];
			$district = $row['district'];
			$city_id = $row['city_id'];
			$postal_code = $row['postal_code'];
			$phone = $row['phone'];
			
			
			
		?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
		
          <!-- Page Heading -->
		  <?php
			echo("<p style = 'display:none;' id = 'passme'>$password</p>");
			
		  ?>
          <h1 class="h3 mb-4 text-gray-800">Edit Customer Details</h1>
		  <p>Here you can view and edit customer details</p>
			<a href = "staff_view_customer.php"><p class = "btn btn-primary" title = 'Back to Customer Table'>Back to Customer Table</p></a>
          <div class="row">
				<form action= 'staff_customer_password.php' method = 'post' id = 'password_forms' style = 'display:none;'>
					<?php 
						echo("<input type = 'text' value = '$customer_id' name = 'customer_id' />");
						echo("<input type = 'text' id = 'password2'  name = 'password_o' />");
					?>
				 </form>
            

              <!-- Circle Buttons -->
              <div class="card shadow mb-4" style = "width:1000px;">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Customer Details</h6>
                </div>
                <div class="card-body">
				<?php
						if(isset($_POST['update_success']))
						{
							echo("<p style = 'font-size:17px;color:#1cc88a'>Successfully updated customer details!</p>");
							
							
						}
						
					
					?>
                  <p style = 'font-size:20px;'><b> Customer id: <?php echo($customer_id);?></b></p>
                  <form action = 'update_customer_check.php' method = 'post'>
					<p><span style = 'font-size:17px;'><b>First Name: </b></span></p>
					 <input type="text" class="form-control form-control-user" name="first_name" minlength = "3" title = "Characters only and minimum length is 3" pattern="[^\s][A-Za-z\s]+" maxlength="45" required="required" id="first_name"  value="<?php echo($first_name); ?>" />
					 <br />
					 <p><span style = 'font-size:17px;'><b>Last Name: </b></span></p>
					 <input type="text" class="form-control form-control-user" maxlength="45" minlength = "5" title = "Characters only and minimum length is 3"  pattern="[^\s][A-Za-z\s]+" name = "last_name"  id="lastName" required="required" value="<?php echo($last_name); ?>" />
					 <br />
					 <p><span style = 'font-size:17px;'><b>Email Address: </b></span></p>
					 <input type="email" class="form-control form-control-user" maxlength = "50" minlength = "9" required = "required" name = "email" id="email" value="<?php echo($email); ?>" />
					 <br />
					 
					 <p><span style = 'font-size:17px;'><b>Password: </b><a href = '#' onclick = 'password_fun()'>Change password here</a></span></p>
					 <input disabled class="form-control form-control-user"type = 'text' title = 'Password' style = 'cursor:not-allowed;' id = 'password_form'/>
					 <br />
					 
					 <p><span style = 'font-size:17px;'><b>Address: </b></span></p>
					 <input type="text" class="form-control form-control-user" minlength = "6" pattern="[^\s][A-Za-z0-9 , \s]+" title = "Characters and numbers and ',' symbol only and minimum lenght is 6" maxlength = "50" required = "required" name = "address" id="address1" value="<?php echo($address);?>" />
					 <br />
					 <p><span style = 'font-size:17px;'><b>Address 2 (Optional): </b></span></p>
					 <input type="text" class="form-control form-control-user" minlength = "6" pattern="[^\s][A-Za-z0-9 , \s]+" title = "Characters and numbers and ',' symbol only and minimum lenght is 6" maxlength = "50" name = "address2" id="address2"  value="<?php echo($address2); ?>" />
					 <br />
					 <p><span style = 'font-size:17px;'><b>District: </b></span></p>
					 <input type="text" class="form-control form-control-user" minlength = "4" pattern="[^\s][A-Za-z & \s]+" title = "Characters and '&' symbol only minimum lenght is 4" maxlength = "20" required = "required" name = "district"  id="district" value="<?php echo($district); ?>" />
					 <br />
					 <?php
						echo("<input type = 'text' name = 'customer_id' value = '$customer_id' style = 'display:none;' />");
					?>
					 <p><span style = "font-size:17px;"><b>City: </b></span></p>
					<select autocomplete = 'off' required = 'required' title = 'City' name = 'city' id='list'  placeholder='Pick a city or search'>	 
						 <?php
						 //city_id2 is the id you're comparing with.
						  // $city = $cus_details['city'];
						   echo "<option value = ''>-- Select a city --</option>";
						   $sqli = "SELECT city_id,city FROM `city` WHERE 1";
						   $result2 = mysqli_query($links, $sqli);
						   
						   while($row = mysqli_fetch_assoc($result2)){
							   $city_id2 = $row['city_id'];
							   $city2 = $row['city'];
								$selected = "";
								if($city_id2 == $city_id)
								{
									$selected = "selected";
								}
							   
								echo "<option value='$city_id2' $selected>$city2</option>";
								   
								  
						   }
							   
											 
						 ?>
					</select>
					<br />
					 <p><span style = 'font-size:17px;'><b>Postal Code (Optional): </b></span></p>
					 <input type="text" class="form-control form-control-user" minlength = "4" maxlength = "10"  pattern="[0-9]+" title = "Numbers only and minimum lenght is 4" name = "postal_code" id="postalCode" value="<?php echo($postal_code); ?>">
					 <br />
					 <p><span style = 'font-size:17px;'><b>Phone (Optional): </b></span></p>
					 <input type="text" class="form-control form-control-user" pattern="[0-9]+" minlength = "6"   name = "phone" title = "Numbers only and minimum length is 6" id="phone"  value="<?php echo($phone); ?>">
					 
					 <br />
					 <input type = 'submit' value = 'Update Customer' title = 'Update Customer'  class = 'btn btn-primary'style = 'float:right;'/>
				  </form>
				  <?php
						echo("<script>pass_me_fun();</script>");
					 
				  ?>
                </div>
              </div>	

          </div>
			<a href = "staff_view_customer.php"><p class = "btn btn-primary" title = 'Back to Customer Table'>Back to Customer Table</p></a>
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
