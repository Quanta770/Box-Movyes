<?php
	session_start();
	if(!isset($_SESSION['email']))//restrict access if not login
	{
		header('location:staff_login.php');
	}
	else if (isset($_SESSION['customer_check']))
	{
		header('location:customer_page.php');
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
<link rel = "shortcut icon" href = "img/fav.png" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Staff - Dashboard</title>
  <script>
	  function change_color($the_color)
	  {
		  
		 document.getElementById("personal_message_2").style = "color:" + $the_color;
		
	  }
	function coloru($the_color)
	{
		
		document.getElementById("personal_message").style = "color:"+$the_color;
		
		
	}
	function encode()
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
		document.getElementById("o_password").value = $output;
		document.getElementById("passme").innerHTML = "";
		
	}
	
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
  
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
	<?php
	
		$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
		$emails = $_SESSION['email'];
		$sql1 = "SELECT address.phone,address.address,address.address2,address.district,address.postal_code,city.city,staff.email,staff.staff_id, staff.first_name, staff.last_name, staff.password FROM staff Inner JOIN address ON staff.address_id = address.address_id INNER JOIN city ON address.city_id =city.city_id WHERE staff.email = '$emails'";
		$result = mysqli_query ($links,$sql1);
		$cus_details = mysqli_fetch_assoc($result);  //fetch all the result into a variable, so
		$cus_password = $cus_details['password'];
	?>
	<p id = "passme" style = "display:none;"><?php echo($cus_password);?></p>

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

        <!-- Begin Page Content STARTCORE-->
        <div class="container-fluid">
		  
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class = "fa fa-user-circle"></i>&nbsp;&nbsp;&nbsp;Account Details</h1>
            
          </div>


          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary"><span class="glyphicon glyphicon-user"></span><i class = "fa fa-id-badge"></i>&nbsp;&nbsp;&nbsp;Personal Information</h5>
                </div>
                <div class="card-body">
				  <!-- This is the part where success or failure message is displayed -->
				  <p id = "personal_message">
					<?php
						echo((isset($_POST['return_message']))?$_POST['return_message']:'');
					?>
				  </p>
				  <?php
					if(isset($_POST['colors']))
					{
						
						$coloring = $_POST['colors'];
						echo("<script>coloru('$coloring');</script>");
					}
				  ?>
				  <form action = "staff_personal_info_check.php" method = "post"style = "margin-bottom:17%">
					
					<h6 class="font-weight-bold" >Staff ID: <i style = "margin-left:20px;"class = "fas fa-question-circle" title = "Staff ID helps uniquely identifies each staff and cannot be modified"></i></h6>
					<?php
						
						$cus_id = $cus_details['staff_id'];
						echo("<input type = 'text' class = 'form-control bg-light border-0 small'disabled = 'disabled' title = 'Customer ID' style= 'cursor:not-allowed;font-size:14px;'  value = '$cus_id'/>");
					?>
					
					<p style = "color:#36b9cc;font-size:13px;">Please provide your <i>Staff ID</i> when Database Administrator. Thanks!</p>
					<h6 class="font-weight-bold">First Name</h6>
					<?php
						$cus_name = $cus_details['first_name'];
						echo("<input minlength = '3' pattern='[^\s][A-Za-z\s]+' maxlength='45' type = 'text' title = 'First Name'class = 'form-control bg-light border-0 small' style = 'font-size:14px' required = 'required'name = 'cus_first_name'id ='cus_first_name' value = '$cus_name'/>");
					?>
					
					<br />
					<h6 class="font-weight-bold">Last Name</h6>
					<?php
						$cus_last_name = $cus_details['last_name'];
						echo("<input maxlength='45' minlength = '5' pattern='[^\s][A-Za-z\s]+' type = 'text' title = 'Last Name'class = 'form-control bg-light border-0 small'style = 'font-size:14px' required = 'required' name = 'cus_last_name' id = 'cus_last_name' value = '$cus_last_name'/>");
					?>
					
					<br />
				
					<h6 class="font-weight-bold">Password</h6>
					
					<h4 class="small" style = "margin-left:10px;margin-top:20px;"><b>Current Password</b></h4>
					<input disabled = 'disabled'type = "text" class = "form-control bg-light border-0 small" title = "Old Password"style = "font-size:14px;cursor:not-allowed;" id = "o_password" />
					<?php
						echo("<script>encode()</script>");
					
					?>
					
					<br />
					<h4 class="small" style = "margin-left:10px;"><b>New Password</b></h4>
					<input maxlength = "40" minlength = "5"type = "password" title = "New Password"class = "form-control bg-light border-0 small" style = "font-size:14px" name = "cus_new_password"/>	
					
					<br />
					<h4 class="small"style = "margin-left:10px;"><b>Repeat New Password</b></h4>
					<input maxlength = "40" minlength = "5"type = "password" title = "Repeat New Password"class = "form-control bg-light border-0 small" style = "font-size:14px" name = "repeat_password"/>
					<br />
					
					<input title = "Save"type = "submit" value = "Save" class = "btn btn-primary" style = "float:right;"/>
                  </form>
                </div>
              </div>

              

            </div>

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4" >
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary"><i class = "fa fa-comments"></i>&nbsp;&nbsp;&nbsp;Contact Information</h5>
                </div>
                <div class="card-body">
                  <!-- This is the part where success or failure message is displayed -->
				  <p id = "personal_message_2">
					<?php
						echo(isset($_POST['return_message2'])? $_POST['return_message2']:"");
					?>
				  </p>
				  <?php
					if(isset($_POST['color2']))
					{
						$changing_to_color = $_POST['color2'];
						echo("<script>change_color('$changing_to_color');</script>");
					}
				  ?>
				  <form action = "staff_contact_check.php" method = "post" >
					
					<h6 class="font-weight-bold">Email Address</h6>
					<?php
						$cus_email = $cus_details['email'];
						echo("<input maxlength = '50' minlength = '9'title = 'Email Address'type = 'email' class = 'form-control bg-light border-0 small' style = 'font-size:14px' required = 'required' name = 'cus_email' id = 'cus_email' value = '$cus_email'/>");
					?>
					
					<br />
					<h6 class="font-weight-bold">Address 1</h6>
					<?php
						$cus_address_1 = $cus_details['address'];
						echo("<input maxlength = '50'minlength = '6' pattern='[^\s][A-Za-z0-9 , \s]+' type = 'text' title = 'Address 1'class = 'form-control bg-light border-0 small'style = 'font-size:14px' required = 'required' name = 'cus_address' id = 'cus_address' value = '$cus_address_1'/>");
					?>
					
					<br />
					<h6 class="font-weight-bold">Address 2 (Optional)</h6>
					<?php
						$cus_address_2 = $cus_details['address2'];
						
						echo("<input  maxlength = '50'minlength = '6' pattern='[^\s][A-Za-z0-9 , \s]+'title = 'Address 2 (Optional)'type = 'text' class = 'form-control bg-light border-0 small'style = 'font-size:14px' name = 'cus_address2' id = 'cus_address2' value = '$cus_address_2'/>");
						
					?>
					
					<br />
					<h6 class="font-weight-bold">District</h6>
					<?php
						$district = $cus_details['district'];
						echo("<input minlength = '4' pattern='[^\s][A-Za-z & \s]+'maxlength = '20'type = 'text' title = 'District'class = 'form-control bg-light border-0 small'style = 'font-size:14px' required = 'required' name = 'cus_district' id = 'cus_district' value = '$district'/>");
					?>
					
					<br />
					<h6 class="font-weight-bold">Postal Code (Optional)</h6>
					<?php
						$postal_code = $cus_details['postal_code'];
						echo("<input minlength = '4' maxlength = '10'  pattern='[0-9]+'type = 'text' title = 'Postal Code (Optional)'class = 'form-control bg-light border-0 small'style = 'font-size:14px' name = 'cus_postal_code' id = 'cus_postal_code' value = '$postal_code'/>");
						
					?>
					
					<br />
					<h6 class="font-weight-bold">City</h6>
					
                     
					
					<select autocomplete = 'off' required = 'required' name = 'list' id='list'  placeholder='Pick a city or search'>	 
					 <?php
					   $city = $cus_details['city'];
					   echo "<option value = ''>-- Select a city --</option>";
					   $sqli = "SELECT city_id,city FROM `city` WHERE 1";
					   $result2 = mysqli_query($links, $sqli);
					   
					   while($row = mysqli_fetch_assoc($result2)){
						   
						   $selected = (isset($_POST['list']) && $_POST['list'] ==  $row['city_id']) ? 'selected' : '';
						   if ($city==$row[city])
						   {
							 $selected = "selected";
								 
						   }
						   else //look into $selected
						   {
							  $selected = null;
						   }
						    echo "<option value='$row[city_id]' $selected >$row[city]</option>";
							   
							  
					   }
						   
						 				 
					 ?>
					 </select>
						
					 <p style="color:#36b9cc;margin-left:10px;font-size:13px;">*Can also be search.</p>
					<h6 class="font-weight-bold">Phone Number (Optional)</h6>	
					<?php
						$phone_number = $cus_details['phone'];
						echo("<input pattern='[0-9]+' minlength = '6'type = 'text'title = 'Phone Number (Optional)'class = 'form-control bg-light border-0 small'style = 'font-size:14px' name = 'cus_phone_number' id = 'cus_phone_number' value = '$phone_number' />");
					
					
					?>
					<br />
						
						
					
					<input title = "Save"type = "submit" value = "Save" class = "btn btn-primary" style = "float:right;"/>
					
                  </form>
                </div>
              </div>

       

            </div>
          </div>
		  

              <!-- Illustrations -->
              <div class="card shadow mb-4" >
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary"><i class = "fa fa-key"></i>&nbsp;&nbsp;&nbsp;Your Privacy, Our Priority</h5>
                </div>
                <div class="card-body">
				  <!--<img title = "Your Privary, Our Priority" alt = "Your Privary, Our Priority"src = "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxISEhUSExIWFhUWFhcVFRYVFRYXFhYVFRUXFhUVGRUYHSggGBolGxYVITEhJSkrLi4uFx8zODMsNygtLisBCgoKDg0OGhAQGi0mHyUtLS0tLS0tLy4tKy0tLS0tLS0tLSstLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0rLf/AABEIALcBEwMBIgACEQEDEQH/xAAcAAABBQEBAQAAAAAAAAAAAAADAAIEBQYBBwj/xABEEAABAwIDBQQHBQYFBAMBAAABAAIRAyEEEjEFBkFRYSJxgZEHEzKhscHwI0JSktEUFUNicuEzgqLS8RZTVLI0RGQk/8QAGQEAAwEBAQAAAAAAAAAAAAAAAAECAwQF/8QAJBEAAgICAgEFAQEBAAAAAAAAAAECEQMhEjFRBBMiQWEygXH/2gAMAwEAAhEDEQA/AKluHPL3hW+xMKJNgLqeNjPcAcmo5I+FwDqREtiSuON2dE+idQwwCscPSQaIU2iFskYWFZTRBST6YRQ1VQARSTvVowau5UUADIuZFIypFqKAjFi56tScq5lRQAPVropo0JQgQxrUVrVwBOCoQ8JOKbKaXJiB1GqJUoA8FMcmlAEVuFHJcfhwpRco9V6VICLWdCgVlMqqM8JjSIL2IL2Ka9qC5qBkF7EFzFPexAfTQBCcxBdTU1zEJzEhkF9NR6lNWLmID6aQysqU1GqU1aVKajVKSLCisNNJSjTSRY6PXdmVAaTL/dHwQNtt7LT/ADKDsXAvDWvFxmnXTgrPbghg7wueN2W0qIlBqm0wouH0U2mFuZBmI7QhsCM0JoQ9oTsqTU+EwGZVwtRIXIQAOFzKiwmwkAPKuQiELkJgNhcTiuFADSmEp5TCgBpKaSnFDKAOOKC8IhTHJgRajUBzVNcEB7UARHMQHtU1zUJzUAQ3MQnMU1zEFzEgIjmITmKY5iG5iQ0QnU0J1NTyxN9UpbLSK11FQn0sxjgFeVqMBcw+BgLnyZK0bwh9lJ+xjkkr44LoksORrRo9i4lraRaXAQ52p6oW0cfSqghrhI6rC724qpSrgNLY7Rh3EhVeyN4nuq0w5jB6x8HLMgdV1O7OVVWz0/DGysKSrcMrKgtjEksR2hBYjtTAI0Jya1PCYCShdSTAbC5CeuIAZC4QnlNKQHl2+PpJxGExb8OyhTc1gHacXSZE8FUN9LuK/wDGo/meqT0pNjaVTq1p9xVBTr2AjRD/AAuEYu+Tr/LN6PSljDph6Pm9SKXpDxzv4FD8z1i8OeMK9wB6Jr9CcYr+XZoae+ePP8Ch+Z/6KVS3j2g/SjQ/M/8ARQcMdLLSbNDGxOqKIIjNqbRP8Gj+d3+1dfjtpcKNH87v9q1eGa0jRHL2AaJgYHHbX2hSYalRmHYxupc98D/Qq3Ze9uLxRLaJwznDVpdUa6OYaWSR1Uz0o1HVv2fDUY+0c9xzaEtb2QeGhcsRsrZL6GPwraTXuqCoPWQRED/EAgnsBpvKB0bp1fa3/aw/53/7EKtiNrNEmnh/zv8A9i39Oq4/cCi7RaS3RoQIx+6e2KuJFYVmta6nULOwSQYHUK7cFmdxh2sWf/0P9xhadykATghkIpTCkykMhPYxIBFprKRrEaaMkDldTKdBCpHtFTGOXDLbOlaQA0kkbMklQ7POfSjLXsIGriD4ifkvPNmYiMTSINvWt+ML0D0ph5psqOEWYSBwebHwXmDKkPYRwc0+8L0oLZwv+T6SwhsFZUFT7NdLGnoPgrjDlUiCWxGaUFqI0pgHaUQILSitKYDkkkkCOJJJFAxpXCnJpQB4D6WhG0T/AEN+ay9ItkfWq1Hpmdlx8xMsHzWLpY2PuJVZpDJxVUjRYIE6K/wrCI9rhF7C95vdZHZ+28v8Mxb4gfNX+A3nEM+xMuNjrfOGx5GUcSvffhGmo0XkktJFzF3SRGkaDvVhSZUaZ7QBBDQSCWkxBMnmDzWXG/uWCMO4iXZr3tGng5qms9Idw5uCLhwJn5CNZRxF7z8I2WyH1AT7QECznZjmEy7u0T9s7Zbh2ZqjjEwABJc48AFksP6QagqCMEZeWlxl0AkhkNtpA81U7x73nFOaTh/VilJBJPazNAdaOBGvVUkZylydkHb+9NTEODvYbTdmY3739TjxPQcyrz0YY+nVq1zkArDtB4403+01oOkOF+8LzhuIDmkzBk+IJ+Snbq7UOGxdGs0Zi1xBaPvtcMpb1sfMBMR79UrZRdx8FDxOIDmmAfeVmaW/z3saTg4LnOANzBa9gEiNDmOscFW7R9IdRoOTCQM7805pMFsGOFnNSAl+j8yzEHniav8A7lalyyXo3q5sO98RnrVHR/U8lapxSAaU0rjnLkpNFI7KcxyCSuZ1nJGkWEp1u05ShWVK6tFSOYUkV1xyjs6U9E010lWurpJUMrfSnQnCE8oPkV4u4Agkai/kvTN5t+qOKomk2k8EiCXZYv3LB06DADqZXenRwHu2wKuahTPNjT7lfUHRqV41sjfPEU2tptY0taABPIdUXb299bENDB2Gi5yE3PeplNROjD6WeXa68ntVSs1jS5xAAEkkwABqV5ttf0rAO/8A56GanMesc8Nc7qKcEgd8HosjvPvdXxFGlQLoa1oD/wCcwbnoAPNw5LJCqGgkn+kfXFVd9GTjxbTPRaHpZqtqCaQLZkgvJNusW4LabD9J+Fqt+0BpmCSPaiDHC/EcF4FXjQHhJj59U/B4khrgdOyQPd+iNoWj6PwHpAwFWp6ptaHfdJa4Nd0DiInotJhsUyoMzHtcObSDflZfLra9O2ab66W6g/qtp6MdpNw2KM1B6qowh0mIcLsMeJCXPyJx8HuaSbTdIBHFOWhJxJdUXam0KWHpOrVnhrGiSTx5ADiTwCAPEfTJhs+PaM4bLBczGvRQ9lejj1tNlQ4zLmEkerkC5GpeCdOSW9m8oxeJNZtMNAGVma7so4nhKhYbeGqwa6KbZceNbReVfRdkaXjHFwaCTlpXhon8fRUGM3cdSwLsYK1QZagZ6t7QCZcBOYOIi/mFZY3el1eg6iDkc4gk3AMai3P5KBW2tV/d78JUpnK1wc17puPWsIaLRF3cVSZLqzPmjigCSyoG6klpgDnMdB5J9H1pYXhzoA4PI9yGcfUIglxERBcY8l2liXBhYBYoQNJfZpdn7uYmq1lRuIs4A3cbcbquZg3GrVoPqGxyh7pII6Kw2ZvCKdEUySCBE/IAKJiNoUqgGZxtGnPyUpyHoCNkPpubSaMzqnskktA4XkQibO3aqVW5wS0hxGnEawUJm1MtQOnOGxGa8AGVe0t56bWwIHEgTqbn3rPJKaVIpKPZU1dh12QDUcJdrOkkDyUnau7Zos7WKLpNmtuTp/Zcx+8DXiJHfeVGxG2Gn754c+HgpxvI/wCjVLGbj0bCMGP6nf8AsVp3OWa9Hv8A8Jh5lx8yVoiV1HKcJXCUpTHFJjOOcguenPco9RymikyFtWrlyv5G/citxNkLFNDgQeKpKmGqNs2oY5LKWO3aNY5NbLh2LukqX9mf+MlJT7TH7qMM1h5FGpU+Lp7ggiq4WMg9UVtee9Eps78Xo8d23ZK/aWgQLBNpm8hQqlQXXcFXMuAIFteVxdQonVlyqEaQXaDsw7M2481UVGScoBLuasMe4g2vaQTx62UOnYktBzHTkOa3h0eHk2zlSGgtNiYsB75XaWY6aEZTfWL6dwQXkyDN/eE9r41uNbc+BVmYas/mm4fFOa4OB0IMdRxUV9UnU8ZSpSSANdPNDQI+q9zca6tg6FR1y6m0k6zbWVdyqLczC+qwOHbP8Jh5asBsFcudAlC6Ewkrwr0q7xPxGMdQDj6rDnIG8DUj7R5HEyS0cgDzXtLtos5r5036Zk2jiheHVTUHUVAHz/qKa2BWteCY0RCzgotJ44qUKrSOvuuqoCPVaul4cwyBnBHa4wuVdLJbNwpqPyyQLSQAYBcGi0jiUmNKxYLJq/hw5p2MyiMvemnCZZmoBFtFzD4Y1KjabH5nvcGtAHEqbH9ErM0NaMgJIEkp3q2x93xWh3s3IdhaIqCsXZQPWWFp5dFjm0wdKvuQtEONj8W4EiABHLimPI4chwi6IMCT/EPkpJ2C/X1vuTckOMaK0tT8kf8AKl09g1nGAT3x/ZSaO6tZ33nfl/slyRVHou4QjBUu75q9eVRbtfY0WUC13ZEZiDdXLirTTIO5kxzlyUxzkgGvco9RyI8oDygYF5UeqEZxQKiABJJpSQBg2VGuEET36juKiY6lk7QMtOh5dClK66qCIOh1Cy4o3hmlDpleaxOl1YYKgQ2XcZAHzPNObSA0CNmQ0Dyyl2FdhuyJtAt11VeaMScukgcDKsjXsDxHwXH1g5pAHaiyhWFplA6xnreV2uQLi3donYkE9onj79UIy4gDoFqjJj8HhjUcAB9clpMXsZtGtTAvABd3n6KFsbDFgFrn4rQ/sbq+JZRZdziGzqJOp8BJPcspyt0jaMUo7Pd8PlFNmX2crcvdAj3KJtDFgDLMSLItOnla1g9lrQ0c4aIHwQq9Iu4BayTa0YJq9mZp4Vwn7SZ0ngvNvSnTaMTTIF/VBrnfigkjyk/QXrmP2YXMcAYMWK8T31LmV8lUk9mxPCPldTH3L+TtFVD6VGeYU+UOpTcyAeIBHUHQprQ42jzWxmEe/wDurLYtUszGCS8ZLCTqCPGVWDDkahaLYWEc+pRps9tz2x3zKzmzXGt2an/ohjhNSpJNyLDwV5ufurh6OIFRrQXNBjjHVRMTuhjGtzOqwOrlfbi7GfRNR9R5fIAF9Oa51BqW2W5prombawQrZqTtH2KxO1NxsPTdDDFtVvXu+3g2AEqm2hgxisQBeKYl0GAehWmdpQ5NkY+6MdS3fj2agPfCZW2NVmQ9hHJajbWy/Xva5kU6YBbDTDi4c1UbX2bRotZ9s4l2t7BcePJGdLltm8tfRL2ZWFFuWGnyR3baA4N9y8426xzcSxraji0xoTCbu1QdWxb2FxIbPErrWKa1Zi5x7o9E/f3QIuC2h6wkRcKvp7EAMqxo0ci0hjmntkSlFrSJBKY5yBXxELPbW2o9zm0qZgm5I5K5SUVbFGLejRvKA8qgdWqjSofFc/eNYawVks8WW8Ui5cUJ6p/36DMjQwunbbR90q1kiTwkWJCSqXbZH4XeSSfOPkOL8GIa5DqlKkCRIC7U0UgSsNWtBSqVlCYDoE91OJkjuRQiz2Bsmvjavq6UQIL3u9lgOhPMm8Dit1S9H1GmCXVqpcBdwyBvXswbeKkbs0v2LB0WNEV8R9oZ+7mEgkfysy25qZjq8MIkkmxJJJK58k3dJnXDEuNswtXYzX1DERmkCLa2TH7EyumBZXtCmXVAxglzjAABPiY0HVaCruoTAfUMGPYAF/8AN3jy6qoqchTUI9mDpMhwiT0V1sjFvoPNRhGciJiYB1AV0NwHQXMrdrgHix6SBbUcFCr7qY2n/CzjnTcHe7X3LRQa7MZTT0iWN7MVPtz4Ih3wxP4x5Kifg6zbOpuaeRBB8iiUNk16nss8XOa0f6iJTVvoh0lbLOrvriQD2h5LGbQweK2hWzhsjTMbNC1Ddz8Q8SX0QOReSf8AS0j3rUDC1KVPLTFKQAAC6GnqTGiJLIukTHJi+5I8823u++nRp53Bzm9kECIGsdeKpaGDK9I29galWiG5mZ5kgZsng4ifcscNnVWG7D4doeYVRhlS+SGs2CTqMkRqmDAAlG2TWeyvSNMEvFRrmhoLjIM2aLlWmzNjVcU4U6bHSTBdlOVg4ucdBAm03XrO6+62HwTSabftIIdWdd5vJHJo0sOV5SUGzVzSWivfu3jMQya1f1fNpvPfHsqJUdXwv2IkBt8xvmHMcwt1nmyqt5sA6rSlsB7Jc2AO1b2dbTa6eSDrRjFmVpbYzOJcbxGkLCY3bWNoYiq+kCWOdpztCK7eEmpBFpgzqI5EahWjaYeJBBm65ssvgk0b4422Yz/qfFBwlskE2k6lSaYxFQNe9r4MxAkArQ4JuDqn1T/scQDYv9h/9JXKgr0an2bmuaNWgjzSjGMWnSX6Pf1t+GUGNJpZRAqOdFgxwyeJVvgcGyi91RhaHFsulC2rtDE1LBkDiTEodHD5hL9eN0SkovTLXKa+Son19sYkCWhrhy4qor74VwYLACrZrAOKqdv0GFhd94aHn0WkM7bpkTwqrRBqby1qhAgXMWUmlisri4tOY2mLKjwTe2DFhcqyO02zZPLvQsei1/eFM/fI6ERdODqZg5gSOqpzjWHUITjTPBYcDSy7qU2HgFGfSvY+HBVRY3mfNNNP+Z3mnx/QsszPJJVfqv5yuJ0KyNScGgDkpNHZeYh7+y3WOLv0CkYDA06faLsz+Z9lv9LfmVJqOn7y6ZSsxiqO5mt0AHkI7yomDZ+2V2UGAZZzVXkaMBAMDxAHMuGiHjsE6pYVA1vKDJ6kqXuzS/Zn1C54LalJzOyLh0hzHX4Ai/QlJDZqsftAuxc8AwgdJd+gRcLQq4qr6qkBNi559mm3mfkOPmRm6rm1KjXOdDQO0QJdrNhZbnZG92Cw9Isph4Ot2yXO0LnO4n9Eo442mzollSWuy9p4ClhGtpMaC51nOPtv5yRw1topTHHl1jjIOg4G4KyGH3ww+Yue9wPVpI75GnkrOnvbgnG1cAx96WzEcwF0Kjhk23bL8Oi2vxFhbvspLapA9499iqChtqi8wyo151hhBty+uvSLHD49jiYcL2jQienifq6HTBFsAHiHtDgbQYOhPPwUPGbtUKnaa40yOV2kf0nThoj0qo8flqPrqp9BwgX7p8pA4WSWtoUoxkqkjL1N1a7fZq0yO5wPkAeCg1Nn4pgJNMwOIg+QBlbgVRztpPv8SlmEH6+tVos0kc0vR45dWjDM2Pi3sD2hsOEgWDoOhiVabN3PB7WIeHSPZYCIPDtamy1IcNbf8a38ClUqD646/om882EPRYo7e/8ApzDUGU2CnTaGtAgAaf3Mrj6sceXvQqldoaST5C/h4INWsB1E8dNDN+WnkoOnomNZaTy8PFZ7bW8dKm7I2oCbyAZMxABiQBxM/NUG1t4jiXGk2W0w4tLgf8QW8Q2x713B4HChoZ6htuIlpjvBUe5FPYpRm4/Cr/Sl/wCmMATnDqjDMmH2PSHB3uhKhg6dIOdTD6jRrYTHMN4+Cv3bGolpylwP9QI+F0HD7GqwAK9No4NzObeeJiJ8USXp8iq6OeEvVYn5MZiNq4XEt/wyRMTABkciouz6tChORryXa5jK12O3Bc15qPeKYd2nBjc3aOpFwBOveSu090MM0S41HdcwHuAXDKEY2rPSjlbSdGWq7VB+57woON2p6tpfkHnqtbtDdCkT9jVLT+F/aHnYj3qi2luRiKgDRWogC+rjPWzUowgV7sivwm0qlRgdAbPACbd5Tagn2jPerkbr1WANBYQBFnR8QEFm7uIJsB07QWi4rolyb7KaIJsEF1Ifhar3FbuV4nNT/P8A2UU7tYj8TPzf2SbRUXopn0G/hjuKjuoDm74q+O7mI/FT/P8A2Qamwa44s/N/ZF/oWikdT/n8wh9vgQfFXf7irc2fmUlu6GJNM1XGmxg4vfE9whVZNozeepyPuSVlV2HVBIDWuH4mubB6i66iw0TG7aH/AIjT4GU4bbbxwbfeoQfQP8ZvjTd+i79h/wB1n5HfotjMnfv21sJT/ISmnb7PvYOn1s4KK1tL/us/K4fJOOFpQT66lpP3vLTVMY87ZpxbCt8S73FBO1qZ/wDrt8HOC67Cs4V6X5nBMdQ5VqZ7qv6lAh42myI/Z2+JJVfVbN8gHiVIdRdwe0/5mn5oJo1PotRoAuz3vouFWmYI4668CF6dsSuyvhWVa7e3qXMtxifgvKhSfz+C9Q3PpE7O7RvlePyudGimVPoe12WtDGgNtUfEWDgHEcrzorClvDT7IfaNXaNnv4fV1hqDnGL3gfAKZSwmYS50fNSsjQnGzeYbaDXCQ4O5QZFzz93nzUlmNHffT66lecjDMZPq5a6faBINtIKk08XiWtDfWz3iTrMErVZV9kOLN/8AtI48OHQ2snNxbSLwOh1u7v71gKO3sQ32mtcDaACD3g3+CHj9vVnNytGQkXdMm/IQq5xFTNTtnb1KhGYjgA0XJ04cYvdZfGbaqVpBMMMgNHEfzRx6ad6pTScTLiXOEXcZgdOEdym0MPbjz8e9ZzyeCoxJOGEmT3KdScfCed/+FGpN5Ixtx71hdmtExuItqBblM24SjYeu4yCYHn7uKqqdbgfqVx1SeP1zRxsVmkw20KlEZHduj/qaOk/BPbgGVe3Qqf5XEAt6/DyVBSxxGpFtCRp4IbseddNTLbdYjilT+wJG0WVKL3Ndw0IgAjmDIVbVxIGhkDu+Ku34kYunlNntFiNCsdi2uYTM8iDz4yk4DTLgYhxGoA4z8io9XHgHLxuOBHny8FUnFQI4RYEnvKVPGAWInl8tVPEZOr4mpYA8YPPyQRXdxPiJsJ01QHYyYi3X4phxTeUa+JRQBamIIJv+vRR6mKOnE8AguxWawuSdOXcVcUMHQoN9fingDUMIk9LC57k0gH7L2eI9bVMMF4NpHOeAWR323nOIeKdN00mcvZcYgR0F0Lere1+JcWUxkoaBv3nRoXH5CyzYK3hCuyGx3r3JJkhJaCGCqnCuo66rJJIxCI3EqGF2Uhk1uKT24sclAldlAFi3GN/CnjGM/AFWArsosC3ZjaXFi9G9G+0mPw9WiBGV2k8Hi5jwK8jBWg3K2scPiByeMht4juQI2AqOpOcwn2SW+/kpLcaPDggbxf4gqg2qCfEQD9dVX0q4BzDXj9dVlxodls2tcE3420Rqtck2t46d6qzi5+fw1XBWPCZ5qaGWwdFzeOeijPxIk8T9aKE6sQI1gIFEkm3C+sJpCbLQ1pOvBSqNcZed79yoWVcrj4e/61RalZ08u5OgLwYgTA4W6J1Sudf+PFUdPEEQIt8VL9faw8+HRFBZIZUM319yHWrwfl+qhveZm5PTn8kx7idT80UKyxGLk34crLrajfvHUfRVPn0sI8j1RXZf79OSYFrSxeRwLbHX65jorLatJtWgazGguiHDkRwPPoswCYHSY+Sl7G2kaRMnsOs8fMJ0BXubxi3z5IRIPxVltzAFhztux17fFUdSrCjiOwk6pU25jlAk8LcUTA4KpWcA0T14Ky2hiMPs8ds56p0A109w6qlCwchlekMJTNd0ZhFj15DmsPtfaZxDy97ieQ4AcAhbb21VxL8zzA+60EwB8z1VbKtRSC2SCW800kc0CVyUwDSEkGUkANSSSTJOrspJIGKV2UkkgOyuykkgYpTg5JJAG62HjDicO5rj2qfaHcBceI+AQGVbEBJJTIQ7194+teqK2tGpSSUjCisSCDbj3rmcAcv7/FJJAhlS4kapgqQIm/nZJJACLzOuiPRxJjX6CSSAD+tJ00XPWTpwvpfRJJMQAVJMcE11aOCSSQxHGnTlohGrxGn1dJJMC/2PtAVGGhUvAlp6cvCyhN2ZS9Zlc8kiCQB81xJWlYmRtt75jD5qGGZcQM5+6SLwNSe9YHEV3PcXvcXOJkkmSUkk2NApXEkkhilcSSTEcSSSQB//2Q==" style = "float:left;height:150px;margin-right:2%" />-->
                  <p>Your data will <b>never</b> be revealed to third-party applications. All personal data will be kept on our server in peace. Therefore, it is very important that you do not share your password or email address to this account with anyone.<br />This is because sharing of password and email address mey cause you to loose your account forever.<br /><br /><span style = "color:red;">Note: It is very important that you ensure all data provided are accurate. False or suspicious information may cause your account to be <strong>banned</strong>.</span></p>
				  
                </div>
              </div>

       

            

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; BOX MOVYES 2020</span>
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

  <!-- Page level plugins -->
<!--<script src="vendor/chart.js/Chart.min.js"></script>-->
<?php
	//$sql2 = "SELECT country_id FROM `country` WHERE 1";
	if (isset($_POST['list']))
   {
        $result1 = mysqli_query($links, 'SELECT city_id FROM city WHERE city_id=' . $_POST['list']);
        while ($row = mysqli_fetch_assoc($result1))
        {
            $city = $row['city_id'];
        }
   }

?>
<script>
   $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>

</body>

</html>
