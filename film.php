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
  
  <?php $years = range(1950, strftime("%Y", time())); ?>
  
  <style>
   .errorMessage{
	   color:red;
   }
  </style>
  <script type="text/Javascript">
     function errorFilmTitle($value){
		 
		 if($value == 1){
		 document.getElementById("errorFilm1").innerHTML="Invalid input: Duplicate film title found";
		 }else{
			 
			 document.getElementById("errorFilm1").innerHTML="";
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
          <h1 class="h3 mb-1 text-gray-800">Add new film</h1>
          

          <!-- Content Row -->
          <div class="row">

            <!-- Grow In Utility -->
            <div class="col-lg-8">

              <div class="card position-relative">
                <div class="card-header py-3">
				 <div class="text-center">
                  <h6 class="m-0 font-weight-bold text-primary">Enter the film information below to be added</h6>
				  </div>
                </div>
                <div class="card-body">
					<p id = "errorFilm1" class = "errorMessage"></p>
				  <form action = "film_insert.php" method = "post" >
                    <div class="form-group">
					<span style = "color:black;"><b>Film Title:</b></span>
                  
				   <input type="text" class="form-control form-control-user" minlength = "3" pattern="[^\s][A-Za-z0-9 , \s]+" title = "Characters and numbers and ' , ' symbol only and minimum lenght is 3" maxlength = "255" required = "required" name = "title" id="title" placeholder="" value="<?php if (isset($_POST['back_film_title'])){echo $_POST['back_film_title'];} ?>">
				   
                </div>
				 
                    <div class="form-group">
					<span style = "color:black;"><b>Film Description: </b><span style = "color:red"><i><small>Optional</small></i></span>
                  <input type="text" class="form-control form-control-user" minlength = "3" pattern="[^\s][A-Za-z0-9 , ? : \s]+" title = "Characters and numbers and ' , ? : ' symbol only and minimum lenght is 3" maxlength = "255"  name = "description" id="description" placeholder="" value="<?php if (isset($_POST['back_film_description'])){echo $_POST['back_film_description'];} ?>">
                </div>
				   <div class="form-group row">
			    <div class="col-sm-6 mb-3 mb-sm-0">
				   <span style = "color:black;"><b>Film Release Year: </b><span style = "color:red"><i><small>Optional</small></i></span>
                     <select autocomplete = "off"  name = "yyear" id="yyear"  placeholder="" >
					
						 
						 <?php
						   echo "<option value = ''>-- Select a year --</option>";
						   
						   
						   foreach($years as $year) :
						    $selected = (isset($_POST['back_release_year']) && $_POST['back_release_year'] ==  $year) ? 'selected' : '';
						    echo "<option value='$year' $selected>$year</option>";
							endforeach;
						   
						 				 
						 ?>
					   </select>					
                  </div>  
				  
				  <div class="col-sm-6 mb-3 mb-sm-0">
				     <span style = "color:black;"><b>Language of the Film: </b></span>
                     <select autocomplete = "off" required = "required" name = "languages" id="languages"  placeholder="" >
					
						 
						 <?php
						   echo "<option value = ''>-- Select a language--</option>";
						   $sqli = "SELECT language_id,name FROM `language` WHERE 1";
						   $result2 = mysqli_query($links, $sqli);
						   
						   while($row = mysqli_fetch_assoc($result2)){
							   
							   $selected = (isset($_POST['back_film_language']) && $_POST['back_film_language'] ==  $row['language_id']) ? 'selected' : '';
							   
							   echo "<option value='$row[language_id]' $selected >$row[name]</option>";
							  
						   }
						   
						 				 
						 ?>
					   </select>
						<div class="form-group row">
						
						<div>
                <?php
				if(empty($_POST['list'])){
					
					 // echo "<p style=\"color: blue;margin-left:10px;\">*Can also be search","</p>\n";
				}
                
				
                ?>
            </div>
				</div>
                  </div>
                </div>
				 <div class="form-group row">
				 <div class="col-sm-6 mb-3 mb-sm-0">
				   <span style = "color:black;"><b>Rental Duration: (days)</b></span>
                    <input type="text" class="form-control form-control-user"  pattern="[0-9]+" maxlength = "3" min = "0" minlength = "1" placeholder = "e.g 1"   name = "rentalDuration" title = "Numbers only" id="rentalDuration" value = "<?php if (isset($_POST['back_rental_duration'])){echo $_POST['back_rental_duration'];} ?>">
					
                  </div>
				  <!-- Cant be validated yet -->
				<div class="col-sm-6 mb-3 mb-sm-0">
				<span style = "color:black;"><b>Rental Rate:</b></span>
                    <input type="number" class="form-control form-control-user"   step = ".01"  min = "0" max = "99.99" minlength = "1" placeholder = "e.g 2.99"   name = "rentalRate" title = "2 numbers front and 2 decimal point numbers only " id="rentalRate" value = "<?php if (isset($_POST['back_rental_rate'])){echo $_POST['back_rental_rate'];} ?>">
					
                  </div>
				 
			   </div>
			    <div class="form-group row">
				 <div class="col-sm-6 mb-3 mb-sm-0">
				 <span style = "color:black;"><b>Film Length: </b><span style= "color:red"><i><small>Optional</small></i></span>
                    <input type="text" class="form-control form-control-user"  pattern="[0-9]+" maxlength = "5" min = "0" minlength = "1" placeholder = "e.g 80"   name = "filmLenght" title = "Numbers only" id="filmLenght" value = "<?php if (isset($_POST['back_film_lenght'])){echo $_POST['back_film_lenght'];} ?>">
					 <span style = "color:#659EC7;"><small><i>*In minutes</i></small></span>
                  </div>
				<div class="col-sm-6 mb-3 mb-sm-0">
				 <span style = "color:black;"><b>Replacement Cost: </b></span>
                    <input type="number" class="form-control form-control-user" step = ".01"  min = "0" max = "999.99" minlength = "1" placeholder = "e.g 20.99"   name = "replacementCost" title = "3 numbers front and 2 decimal point numbers only for maximum " id="replacementCost" value = "<?php if (isset($_POST['back_replacement_cost'])){echo $_POST['back_replacement_cost'];} ?>">
					
                  </div>
				 
			   </div>
				  <div class="form-group row">
		        <div class="col-sm-6 mb-3 mb-sm-0">
				 <span style = "color:black;"><b>Film Rating: </b><span style= "color:red"><i><small>Optional</small></i></span>
                    <input type="text" class="form-control form-control-user"  pattern="[^\s][A-Za-z0-9 [-] \s]+" maxlength = "10" min = "0" minlength = "1" placeholder = "e.g PG"   name = "filmRating"  id="filmRating" value = "<?php if (isset($_POST['back_film_rating'])){echo $_POST['back_film_rating'];} ?>">
					
                  </div>
			     	 
				  <div class="col-sm-6 mb-3 mb-sm-0">
				   <span style = "color:black;"><b>Special Features: </b><span style= "color:red"><i><small>Optional</small></i></span>
                     <select autocomplete = "off"  name = "specFea[]" multiple = "multiple" id="specFea"  placeholder="">
					 <?php 
					
					 $resultSF = $_POST['back_special_feature'];
					 $handless = explode(',', $resultSF);
					 
					  
					 ?>
					    <option value = "">--Select special features-- </option>
					    <option  value="Deleted scenes" <?php echo (isset($handless) && in_array('Deleted scenes', $handless) ) ? 'selected="selected"' : "" ?> >Deleted scenes</option>
						<option value="Behind the scenes"  <?php echo (isset($handless) && in_array('Behind the scenes', $handless) ) ? 'selected="selected"' : "" ?>>Behind the scenes</option>
						<option value="Trailer" <?php echo (isset($handless) && in_array('Trailer', $handless) ) ? 'selected="selected"' : "" ?>>Trailer</option>
						<option value="Commentaries"  <?php echo (isset($handless) && in_array('Commentaries', $handless) ) ? 'selected="selected"' : "" ?>>Commentaries</option>
							 
					   </select>	
						<span style = "color:#659EC7;"><small><i>*one or more selection</i></small></span>
                  </div>	
				
			   </div>
			    <div class="form-group row">
			      <div class="col-sm-6 mb-3 mb-sm-0">
				   <span style = "color:black;"><b>Actors in Film: </b></span>
                     <select autocomplete = "off"  name = "actorss[]" multiple = "multiple" id="actorss" required = "required"  placeholder="" >
					     <?php
						   echo "<option value = ''>-- Select Actors--</option>";
						   $sqli = "SELECT actor_id,first_name, last_name FROM `actor` WHERE 1";
						   $resultAct = mysqli_query($links, $sqli);
							$resultArr = $_POST['back_actor_in_film'];
							$handle = explode(" ",$resultArr);
						    while($row = mysqli_fetch_assoc($resultAct)){
							   
							   $selectedAct = in_array($row['actor_id'],$handle) ? 'selected' : '';
							 
							   echo "<option value='$row[actor_id]' $selectedAct>$row[first_name]\n\n\n\n$row[last_name]</option>";
							   
						    }
						  
						 			 
						 ?>
					   </select>
					  
					  <span style = "color:#659EC7;"><small><i>*one or more selection</i></small></span>
				
                  </div>
				  <div class="col-sm-6 mb-3 mb-sm-0">
				   <span style = "color:black;"><b>Film Category: </b></span>
                     <select autocomplete = "off"  name = "categoryss[]" multiple = "multiple" id="categoryss" required = "required"  placeholder="" >
					     <?php
						   echo "<option value = ''>-- Select Categories--</option>";
						   $sqli = "SELECT category_id, name FROM `category` WHERE 1";
						   $resultCate = mysqli_query($links, $sqli);
						   $resultC = $_POST['back_category_in_film'];
						   $handleCC = explode(" ",$resultC);
						   while($row = mysqli_fetch_assoc($resultCate)){
							   
							 $selectedC = in_array($row['category_id'],$handleCC) ? 'selected' : '';
							   
							   echo "<option value='$row[category_id]' $selectedC>$row[name]</option>";
							  
						   }
						   
						 				 
						 ?>
					   </select>
					   <span style = "color:#659EC7;"><small><i>*one or more selection</i></small></span>
							
                  </div>
			   
			   
			    </div>
				<button  name = "submitPost"  type="submit" class="btn btn-primary btn-user btn-block">Add film</button>
				 
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
  if(isset($_POST['inside_Film_ins'])){
		 echo ("<script>errorFilmTitle(1);</script>");
	}
   else{
					 
		 echo ("<script>errorFilmTitle(0);</script>");
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
