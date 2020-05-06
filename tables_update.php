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
     function errorFilm($value){
		 if($value == 1){
		 document.getElementById("sameValueFound").innerHTML="Invalid update: same value found";
		 }else{
			 
			 document.getElementById("sameValueFound").innerHTML="";
		 }
		 
		 
	 }
    function dupliTitle($value){
		if($value == 1){
			document.getElementById("dupliTitleFound").innerHTML="Invalid update : Duplicate Title Found";
			
		}else{
			
			document.getElementById("dupliTitleFound").innerHTML="";
		}
		
		
	}
  function errorfilmUpdate($value){
	  if($value == 1){
			document.getElementById("errorFilmUpdate").innerHTML="Invalid update : Update Film Error";
			
		}else{
			
			document.getElementById("errorFilmUpdate").innerHTML="";
		}
	  
  }
   
</script>
<script>
    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to update?, any changes made is vital");
      if (x)
          return true;
      else
        return false;
    }
</script> 
</head>

<body id="page-top">
  <?php 
			  $filmID = '';
			  if(isset($_POST['editButton'])){
				  $filmID = $_POST['editButton'];
				
			  }else if(isset($_POST['update_film'])){
			      $filmID = $_POST['update_film'];
			  }
			  else{
				  echo("<script type='text/javascript'>
				alert('Error in fetching the data');
				window.location = 'tables.php';
			</script>");
				  
				  
			  }
			  
			  $edit = "select film.film_id,film.title,film.description,film.release_year,film.language_id,language.name,film.rental_duration,film.rental_rate,film.length, film.replacement_cost,film.rating,film.special_features,film.last_update from `film` INNER JOIN `language` ON film.language_id = language.language_id where film.film_id='$filmID'";
		      $resultE=mysqli_query($links,$edit);
			  $editRow=mysqli_fetch_assoc($resultE);	
			
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
          <h1 class="h3 mb-1 text-gray-800">Update Film ID :  <span style = "color:#e15d44;"><?php echo $filmID;  ?></span></h1>
          

          <!-- Content Row -->
          <div class="row">

            <!-- Grow In Utility -->
            <div class="col-lg-9">

              <div class="card position-relative">
                <div class="card-header py-3">
				 <div class="text-center">
                  <h6 class="m-0 font-weight-bold text-primary">Enter the latest film information below to be added</h6>
				  </div>
                </div>
                <div class="card-body">
				<p id = "sameValueFound" class = "errorMessage"></p>
					<p id = "dupliTitleFound" class = "errorMessage"></p>
					<p id = "errorFilmUpdate" class = "errorMessage"></p>
				  <form action = "update_film.php" method = "post" >
				    <div class="form-group">
					<span style = "color:black;"><b>Last Update:</b></span>
                    <span style = "color:#e15d44;"><i><?php echo $editRow['last_update']; ?></i></span>
				      <input type="hidden" id="up_filmId" name="up_filmId" value="<?php echo $editRow['film_id']; ?>">
					  
                </div>
                    <div class="form-group">
					<span style = "color:black;"><b>Film Title:</b></span>
                   
				   <input type="text" class="form-control form-control-user" minlength = "3" pattern="[^\s][A-Za-z0-9 , \s]+" title = "Characters and numbers and ' , ' symbol only and minimum lenght is 3" maxlength = "255" required = "required" name = "up_title" id="up_title" placeholder="" value="<?php echo $editRow['title']; ?>">
				   <input type="hidden" value = "<?php echo $editRow['title']; ?>" name = "check_title">
                </div>
				 
                    <div class="form-group">
					<span style = "color:black;"><b>Film Description: </b><span style = "color:red"><i><small>Optional</small></i></span>
                  <input type="text" class="form-control form-control-user" minlength = "3" pattern="[^\s][A-Za-z0-9 , ? : \s]+" title = "Characters and numbers and ' , ? : ' symbol only and minimum lenght is 3" maxlength = "255"  name = "up_description" id="up_description" placeholder="" value="<?php echo $editRow['description'];  ?>">
                </div>
				   <div class="form-group row">
			    <div class="col-sm-6 mb-3 mb-sm-0">
				   <span style = "color:black;"><b>Film Release Year: </b><span style = "color:red"><i><small>Optional</small></i></span>
                     <select autocomplete = "off"  name = "up_yyear" id="up_yyear"  placeholder="" >
					
						 
						 <?php
						   echo "<option value = ''>-- Select a year --</option>";
						   
						   
						   foreach($years as $year) :
						    $selected = ($editRow['release_year'] ==  $year) ? 'selected' : '';
						    echo "<option value='$year' $selected>$year</option>";
							endforeach;
						   
						 				 
						 ?>
					   </select>					
                  </div>  
				  
				  <div class="col-sm-6 mb-3 mb-sm-0">
				     <span style = "color:black;"><b>Language of the Film: </b></span>
                     <select autocomplete = "off" required = "required" name = "up_languages" id="up_languages"  placeholder="" >
					
						 
						 <?php
						   echo "<option value = ''>-- Select a language--</option>";
						   $sqli = "SELECT language_id,name FROM `language` WHERE 1";
						   $result2 = mysqli_query($links, $sqli);
						   
						   while($row = mysqli_fetch_assoc($result2)){
							   
							   $selected = ($editRow['language_id'] ==  $row['language_id']) ? 'selected' : '';
							   
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
                    <input type="text" class="form-control form-control-user"  pattern="[0-9]+" maxlength = "3" min = "0" minlength = "1" placeholder = "e.g 1"   name = "up_rentalDuration" title = "Numbers only" id="up_rentalDuration" value = "<?php echo $editRow['rental_duration']; ?>">
					
                  </div>
				  <!-- Cant be validated yet -->
				<div class="col-sm-6 mb-3 mb-sm-0">
				<span style = "color:black;"><b>Rental Rate:</b></span>
                    <input type="number" class="form-control form-control-user"   step = ".01"  min = "0" max = "99.99" minlength = "1" placeholder = "e.g 2.99"   name = "up_rentalRate" title = "2 numbers front and 2 decimal point numbers only " id="up_rentalRate" value = "<?php echo $editRow['rental_rate']; ?>">
					
                  </div>
				 
			   </div>
			    <div class="form-group row">
				 <div class="col-sm-6 mb-3 mb-sm-0">
				 <span style = "color:black;"><b>Film Length: </b><span style= "color:red"><i><small>Optional</small></i></span>
                    <input type="text" class="form-control form-control-user"  pattern="[0-9]+" maxlength = "5" min = "0" minlength = "1" placeholder = "e.g 80"   name = "up_filmLenght" title = "Numbers only" id="up_filmLenght" value = "<?php echo $editRow['length']; ?>">
					 <span style = "color:#659EC7;"><small><i>*In minutes</i></small></span>
                  </div>
				<div class="col-sm-6 mb-3 mb-sm-0">
				 <span style = "color:black;"><b>Replacement Cost: </b></span>
                    <input type="number" class="form-control form-control-user" step = ".01"  min = "0" max = "999.99" minlength = "1" placeholder = "e.g 20.99"   name = "up_replacementCost" title = "3 numbers front and 2 decimal point numbers only for maximum " id="up_replacementCost" value = "<?php echo $editRow['replacement_cost']; ?>">
					
                  </div>
				 
			   </div>
				  <div class="form-group row">
		        <div class="col-sm-6 mb-3 mb-sm-0">
				 <span style = "color:black;"><b>Film Rating: </b><span style= "color:red"><i><small>Optional</small></i></span>
                    <input type="text" class="form-control form-control-user"  pattern="[^\s][A-Za-z0-9 [-] \s]+" maxlength = "10" min = "0" minlength = "1" placeholder = "e.g PG"   name = "up_filmRating"  id="up_filmRating" value = "<?php echo $editRow['rating']; ?>">
					
                  </div>
			     	 
				  <div class="col-sm-6 mb-3 mb-sm-0">
				   <span style = "color:black;"><b>Special Features: </b><span style= "color:red"><i><small>Optional</small></i></span>
                     <select autocomplete = "off"  name = "up_specFea[]" multiple = "multiple" id="up_specFea"  placeholder="">
					 <?php 
					
					
					 $g_specFea = [];
					 $g_specFea = implode(',', $editRow['special_features']);
					 $g_specFea = explode(',', $editRow['special_features']);
					
					 
					 ?>
					    <option value = "">--Select special features-- </option>
					    <option  value="Deleted scenes" <?php echo in_array('Deleted scenes', $g_specFea)  ? 'selected="selected"' : "" ?> >Deleted scenes</option>
						<option value="Behind the scenes"  <?php echo in_array('Behind the scenes', $g_specFea)  ? 'selected="selected"' : "" ?>>Behind the scenes</option>
						<option value="Trailer" <?php echo in_array('Trailer', $g_specFea) ? 'selected="selected"' : "" ?>>Trailer</option>
						<option value="Commentaries"  <?php echo in_array('Commentaries', $g_specFea)  ? 'selected="selected"' : "" ?>>Commentaries</option>
							 
					   </select>	
						<span style = "color:#659EC7;"><small><i>*one or more selection</i></small></span>
                  </div>	
				
			   </div>
			    <div class="form-group row">
			      <div class="col-sm-6 mb-3 mb-sm-0">
				   <span style = "color:black;"><b>Actors in Film: </b></span>
                     <select autocomplete = "off"  name = "up_actorss[]" multiple = "multiple" id="up_actorss" required = "required"  placeholder="" >
					     <?php
						   echo "<option value = ''>-- Select Actors--</option>";
						 
						   $valueSql = "SELECT film_actor.actor_id,actor.first_name,actor.last_name,film_actor.film_id FROM `film_actor` INNER JOIN `actor` ON film_actor.actor_id = actor.actor_id INNER JOIN `film` ON film_actor.film_id = film.film_id WHERE film_actor.film_id = '$filmID'";
						   $resultVal = mysqli_query($links, $valueSql);
						   $arrVal = [];
						   while($rowVal = mysqli_fetch_assoc($resultVal)){
							   $arrVal[] = $rowVal['actor_id'];
							   
						   }
						 
						   
						   $sqli = "SELECT actor_id,first_name, last_name FROM `actor` WHERE 1";
						   $resultAct = mysqli_query($links, $sqli);
						   
						    while($row = mysqli_fetch_assoc($resultAct)){
							   
							   $selectedAct = in_array($row['actor_id'],$arrVal) ? 'selected' : '';
							 
							   echo "<option value='$row[actor_id]' $selectedAct>$row[first_name]\n\n\n\n$row[last_name]</option>";
							   
						    }
						  
						 			 
						 ?>
					   </select>
					  
					  <span style = "color:#659EC7;"><small><i>*one or more selection</i></small></span>
				
                  </div>
				  <div class="col-sm-6 mb-3 mb-sm-0">
				   <span style = "color:black;"><b>Film Category: </b></span>
                     <select autocomplete = "off"  name = "up_categoryss[]" multiple = "multiple" id="up_categoryss" required = "required"  placeholder="" >
					     <?php
						   echo "<option value = ''>-- Select Categories--</option>";
						   $valSql = "SELECT film_category.category_id FROM `film_category` WHERE film_category.film_id = '$filmID'";
						   $resultC = mysqli_query($links,$valSql);
						   $arrC = [];
						    while($rowC = mysqli_fetch_assoc($resultC)){
							   $arrC[] = $rowC['category_id'];
							   
						   }
						   
						   
						
						   
						   $sqli = "SELECT category_id, name FROM `category` WHERE 1";
						   $resultCate = mysqli_query($links, $sqli);
						   
						   while($rowCC = mysqli_fetch_assoc($resultCate)){
							   
							 $selectedC = in_array($rowCC['category_id'],$arrC) ? 'selected' : '';
							   
							   echo "<option value='$rowCC[category_id]' $selectedC>$rowCC[name]</option>";
							  
						   }
						   
						 				 
						 ?>
					   </select>
					   <span style = "color:#659EC7;"><small><i>*one or more selection</i></small></span>
							  
                  </div>
			   
			   
			    </div>
				<button Onclick="return ConfirmDelete();" type = "submit"  name = "submitPost"  type="submit" class="btn btn-primary btn-user btn-block">Update film</button>
				
				  </form>
				  <br/>
				  <?php if (isset($filmID)){ 
				  echo("<a  class='btn btn-danger btn-user' href='tables.php'>Back</a>");
				   } ?>
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
  <!-- End of Page Wrapper -->
</div>
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
  
	
	 if(isset($_POST['inside_update_film'])){
		 echo ("<script>errorFilm(1);</script>");
	 }
	 else{
					 
		 echo ("<script>errorFilm(0);</script>");
	 }
     if(isset($_POST['dupliTitleUp'])){
		  echo ("<script>dupliTitle(1);</script>");
	 }
     else{
					 
		  echo ("<script>dupliTitle(0);</script>");
	 }
	 
	  if(isset($_POST['error_film_update'])){
		  echo ("<script>errorfilmUpdate(1);</script>");
	 }
     else{
					 
		  echo ("<script>errorfilmUpdate(0);</script>");
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
