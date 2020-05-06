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
	

?>
<!DOCTYPE html>
<html lang="en">
 <?php 
  

	
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
			
	
   
  
  
  ?>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Animation Utilities</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  
  
  <style>
   .errorMessage{
	   color:red;
   }
  </style>
  <script type="text/Javascript">
     function errorSeleFilms($value){
		 
		 if($value == 1){
		 document.getElementById("errorFilm").innerHTML="Do not have stock for the current selected film";
		 }else{
			 
			 document.getElementById("errorFilm").innerHTML="";
		 }
		 
	 }
	 
	 function error_Pay1($value){
		  if($value == 1){
		    document.getElementById("error_Payment1").innerHTML="There is error in adding the payment record";
		 }else{
			 
			 document.getElementById("error_Payment1").innerHTML="";
		 }
		 
	 }
	 function error_Pay2($value){
		  if($value == 1){
		    document.getElementById("error_Payment2").innerHTML="There is error in adding the payment record";
		 }else{
			 
			 document.getElementById("error_Payment2").innerHTML="";
		 }
		 
	 }
	 function error_Pay3($value){
		  if($value == 1){
		    document.getElementById("error_Payment3").innerHTML="There is error in adding the payment record";
		 }else{
			 
			 document.getElementById("error_Payment3").innerHTML="";
		 }
		 
	 }
	 function error_Pay4($value){
		  if($value == 1){
		    document.getElementById("error_Payment4").innerHTML="There is error in adding the payment record";
		 }else{
			 
			 document.getElementById("error_Payment4").innerHTML="";
		 }
		 
	 }
	 function error_Pay5($value){
		  if($value == 1){
		    document.getElementById("error_Payment5").innerHTML="There is error in adding the payment record";
		 }else{
			 
			 document.getElementById("error_Payment5").innerHTML="";
		 }
		 
	 }
	  function error_Ren1($value){
		  if($value == 1){
		    document.getElementById("error_Rental1").innerHTML="There is error in adding the rental record";
		 }else{
			 
			 document.getElementById("error_Rental1").innerHTML="";
		 }
		 
	 }
	 function error_Ren2($value){
		  if($value == 1){
		    document.getElementById("error_Rental2").innerHTML="There is error in adding the rental record";
		 }else{
			 
			 document.getElementById("error_Rental2").innerHTML="";
		 }
		 
	 }
	 function error_Ren3($value){
		  if($value == 1){
		    document.getElementById("error_Rental3").innerHTML="There is error in adding the rental record";
		 }else{
			 
			 document.getElementById("error_Rental3").innerHTML="";
		 }
		 
	 }
	 function error_Ren4($value){
		  if($value == 1){
		    document.getElementById("error_Rental4").innerHTML="There is error in adding the rental record";
		 }else{
			 
			 document.getElementById("error_Rental4").innerHTML="";
		 }
		 
	 }
	 function error_Ren5($value){
		  if($value == 1){
		    document.getElementById("error_Rental5").innerHTML="There is error in adding the rental record";
		 }else{
			 
			 document.getElementById("error_Rental5").innerHTML="";
		 }
		 
	 }
	
	function error_Add($value){
		  if($value == 1){
		    document.getElementById("error_Address1").innerHTML="There is error in adding the new address";
		 }else{
			 
			 document.getElementById("error_Address1").innerHTML="";
		 }
		 
	 }
	 function error_Add2($value){
		  if($value == 1){
		    document.getElementById("error_Address2").innerHTML="The address data is not complete, please fill in all the non optional field";
		 }else{
			 
			 document.getElementById("error_Address2").innerHTML="";
		 }
		 
	 }
</script>

</head>

<body id="page-top">
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

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-1 text-gray-800">Add new rental</h1>
          

          <!-- Content Row -->
          <div class="row">

            <!-- Grow In Utility -->
            <div class="col-lg-8">

              <div class="card position-relative">
                <div class="card-header py-3">
				 <div class="text-center">
                  <h6 class="m-0 font-weight-bold text-primary">Enter the rental information to create new rental for customer</h6>
				  </div>
                </div>
                <div class="card-body">
					<p id = "errorFilm" class = "errorMessage"></p>
					<p id = "error_Payment1" class = "errorMessage"></p>
					<p id = "error_Payment2" class = "errorMessage"></p>
					<p id = "error_Payment3" class = "errorMessage"></p>
					<p id = "error_Payment4" class = "errorMessage"></p>
					<p id = "error_Payment5" class = "errorMessage"></p>
					<p id = "error_Rental1" class = "errorMessage"></p>
					<p id = "error_Rental2" class = "errorMessage"></p>
					<p id = "error_Rental3" class = "errorMessage"></p>
					<p id = "error_Rental4" class = "errorMessage"></p>
					<p id = "error_Rental5" class = "errorMessage"></p>
					<p id = "error_Address1" class = "errorMessage"></p>
					<p id = "error_Address2" class = "errorMessage"></p>
					
				  <form action = "rental_insert.php" method = "post" >
                    <div class="form-group">
					<span style = "color:black;"><b>Film Title:</b></span>
                   <select autocomplete = "off" required = "required" name = "ren_Film" id="ren_Film"   placeholder="" >
					
						 
						 <?php
						   echo "<option value = ''>-- Select a film to be rented--</option>";
						   $sqli = "SELECT inventory.film_id,film.title FROM `inventory` INNER JOIN `film` ON inventory.film_id = film.film_id GROUP BY inventory.film_id";
						   $result2 = mysqli_query($links, $sqli);
						   
						   while($row = mysqli_fetch_assoc($result2)){
							   
							   $selectedF = (isset($_POST['back_film_id']) && $_POST['back_film_id'] ==  $row['film_id']) ? 'selected' : '';
							   
							   echo "<option value='$row[film_id]' $selectedF>$row[film_id]&nbsp;&nbsp;$row[title]</option>";
							   
						   }
						  
						 				 
						 ?>
					   </select>
				   <span style = "color:#659EC7;"><small><i>*Can be search</i></small></span>
				   
                </div>
				 
                   
				   <div class="form-group">
		
				   <span style = "color:black;"><b>Customer Email: </b></span>
                     <select autocomplete = "off" required = "required"  name = "ren_Email" id="ren_Email"   placeholder="">
					
						 
						 <?php
						   echo "<option value = ''>-- Select a customer email --</option>";
						   
						   
						   $sqlii = "SELECT customer_id,email FROM `customer` WHERE 1";
						   $result = mysqli_query($links, $sqlii);
						   
						   while($row = mysqli_fetch_assoc($result)){
							   
							   $selectedC = (isset($_POST['back_cust_id']) && $_POST['back_cust_id'] ==  $row['customer_id']) ? 'selected' : '';
							   
							   echo "<option value='$row[customer_id]' $selectedC>$row[customer_id]&nbsp;&nbsp;$row[email]</option>";
							  
						   }
						   
						 				 
						 ?>
					   </select>
			
					 <hr class = "divider">
					
							<div class="form-group row">	
							<div class="col-sm-5 mb-3 mb-sm-0">				
						<span style="color:black;"><b>Confirm to change address ? : &nbsp;</b></span>
	<select id = 'confirmSelection' name = "confirmSelection">
		<option value = '1'>Yes</option>
		<option value = '2' selected>No</option>
	</select>
						<span style = "color:red;"><small><i>*Please select</i></small></span>
						</div>
						</div>
				<div class="form-group">
				 
                  <input type="text"  class="form-control form-control-user" minlength = "6" pattern="[^\s][A-Za-z0-9 , \s]+" title = "Characters and numbers and ',' symbol only and minimum lenght is 6" maxlength = "50"  name = "address1" id="address1" placeholder="Enter the address1" >
                </div>
				 <div class="form-group">
                  <input type="text"  class="form-control form-control-user" minlength = "6" pattern="[^\s][A-Za-z0-9 , \s]+" title = "Characters and numbers and ',' symbol only and minimum lenght is 6" maxlength = "50" name = "address2" id="address2" placeholder="Enter the address2(Optional)" >
                </div>
			  <div class="form-group row">
				<div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text"  class="form-control form-control-user" minlength = "4" pattern="[^\s][A-Za-z & \s]+" title = "Characters and '&' symbol only minimum lenght is 4" maxlength = "20"  name = "district"  id="district" placeholder="District" >
                  </div>
				  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" minlength = "4" maxlength = "10"  pattern="[0-9]+" title = "Numbers only and minimum lenght is 4" name = "postalCode" id="postalCode" placeholder="Postal Code(Optional)" >
                  </div>
				 
			   </div>
				    <div class="form-group row">
			    <div class="col-sm-6 mb-3 mb-sm-0" >
                     <select autocomplete = "off"   name = "cityList" id="cityList"  placeholder="Pick a city or search" >
					
						 
						 <?php
						   echo "<option value = ''>-- Select a city --</option>";
						   $sqli = "SELECT city_id,city FROM `city` WHERE 1";
						   $result2 = mysqli_query($links, $sqli);
						   
						   while($row = mysqli_fetch_assoc($result2)){
							   
							   //$selected = (isset($_POST['list']) && $_POST['list'] ==  $row['city_id']) ? 'selected' : '';
							   
							   echo "<option value='$row[city_id]' >$row[city]</option>";
							  
						   }
						   
						 				 
						 ?>
					   </select>
                  </div>
				 
                </div>
					<span style = "color:black;"><b><span style = "color:red;"><small>*Changing Address is optional and Address will only be updated for "will be delivered" status option</small></span></b></span>
				  <hr class = "divider">
				   <div class="form-group" id = "divTest">
				 <br/>
				
				   <span style = "color:black;"><b>Rental Status:</b></span>	   
                     <select autocomplete = "off" required = "required" name = "ren_Status" id="ren_Status"  placeholder="" >
					
						 
						 <?php
						   echo "<option value = ''>-- Select a Status --</option>";
						   
						   
						   $sqlii2 = "SELECT * FROM `rental_status` WHERE status_id <> '3' AND status_id <> '4' ";
						   $result2 = mysqli_query($links, $sqlii2);
						   
						   while($row = mysqli_fetch_assoc($result2)){
							   
							   
							   $selectedR = (isset($_POST['back_rent_id']) && $_POST['back_rent_id'] ==  $row['status_id']) ? 'selected' : '';
							   echo "<option value='$row[status_id]' $selectedR>$row[status_id]&nbsp;&nbsp;$row[status_name]</option>";
							  
						   }
						   
						 				 
						 ?>
					   </select>	
					  
                  </div>
			
                </div>
				
				<button  name = "submitPost"  type="submit" class="btn btn-primary btn-user btn-block">Add Rental</button>
				 
				  </form>
              </div>

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
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
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
   <?php
  if(isset($_POST['errorSeleFilm'])){
		 echo ("<script>errorSeleFilms(1);</script>");
	}
   else{
					 
		 echo ("<script>errorRentInsert(0);</script>");
	}
	
	 if(isset($_POST['inside_p1'])){
		 echo ("<script>error_Pay1(1);</script>");
	}
   else{
					 
		 echo ("<script>error_Pay1(0);</script>");
	}
	
	 if(isset($_POST['inside_r1'])){
		 echo ("<script>error_Ren1(1);</script>");
	}
   else{
					 
		 echo ("<script>error_Ren1(0);</script>");
	}
	
	 if(isset($_POST['inside_p2'])){
		 echo ("<script>error_Pay2(1);</script>");
	}
   else{
					 
		 echo ("<script>error_Pay2(0);</script>");
	}
	
	 if(isset($_POST['inside_r2'])){
		 echo ("<script>error_Ren2(1);</script>");
	}
   else{
					 
		 echo ("<script>error_Ren2(0);</script>");
	}
	
	 if(isset($_POST['inside_p3'])){
		 echo ("<script>error_Pay3(1);</script>");
	}
   else{
					 
		 echo ("<script>error_Pay3(0);</script>");
	}
	
	 if(isset($_POST['inside_r3'])){
		 echo ("<script>error_Ren3(1);</script>");
	}
   else{
					 
		 echo ("<script>error_Ren3(0);</script>");
	}
	
	 if(isset($_POST['inside_p4'])){
		 echo ("<script>error_Pay4(1);</script>");
	}
   else{
					 
		 echo ("<script>error_Pay4(0);</script>");
	}
	
	 if(isset($_POST['inside_r4'])){
		 echo ("<script>error_Ren4(1);</script>");
	}
   else{
					 
		 echo ("<script>error_Ren4(0);</script>");
	}
	
	 if(isset($_POST['inside_p5'])){
		 echo ("<script>error_Pay5(1);</script>");
	}
   else{
					 
		 echo ("<script>error_Pay5(0);</script>");
	}
	
	 if(isset($_POST['inside_r5'])){
		 echo ("<script>error_Ren5(1);</script>");
	}
   else{
					 
		 echo ("<script>error_Ren5(0);</script>");
	}
 if(isset($_POST['inside_r5'])){
		 echo ("<script>error_Ren5(1);</script>");
	}
   else{
					 
		 echo ("<script>error_Ren5(0);</script>");
	}
	
if(isset($_POST['errorAddress_in'])){
		 echo ("<script>error_Add(1);</script>");
	}
   else{
					 
		 echo ("<script>error_Add(0);</script>");
	}
	
	if(isset($_POST['errorAddress_in2'])){
		 echo ("<script>error_Add2(1);</script>");
	}
   else{
					 
		 echo ("<script>error_Add2(0);</script>");
	}
?>



<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

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
