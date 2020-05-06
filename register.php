<?php
  session_start();
  if(isset($_SESSION["email"]))//restrict customer from register when logged in
  {
	  header('Location:index.php');
	  
  }
  

?>
<!DOCTYPE html>

<html lang="en">
 <?php 
    //$fName=$_REQUEST['firstName'];
	//$lName=$_REQUEST['lastName'];
	
	
	$sql = "";
			//put the sql query inside a string...
	
	$sql2 = "SELECT country_id FROM `country` WHERE 1";
	
	$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
			//connect to the database....	
			//problem when upload, maybe
			
	//$result = mysqli_query ($links,$sql);
			//make the query based on the connection to the database
			
    $result1 = mysqli_query($links,$sql2); 
   
  
  
  ?>
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
  <style>
  #errorPassword {
  color: red;
  
  }
  #errorEmail{
	  color:red;
  }
  #phoneDetails{
	  color:blue;
	  
  }
  </style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
   <script>
  function checkingPassword($input)
	{
		if ($input ==1)
		{
			document.getElementById("errorPassword").innerHTML = "Password does not match";
			
		}
		else
		{
			
			document.getElementById("errorPassword").innerHTML = "";
		}
		
	}
	 function checkingEmail($input)
	{
		if ($input ==1)
		{
			document.getElementById("errorEmail").innerHTML = "This Email already exist";
			
		}
		else
		{
			
			document.getElementById("errorEmail").innerHTML = "";
		}
		
	}
	function checkInsertADD($input)
	{
		if($input == 1)
		{
		   document.getElementById("errorAddress").innerHTML = "Error! Address record cannot be inserted";	
			
		}
		else
		{
			
			document.getElementById("errorAddress").innerHTML = "";
		}	
			
	}
	
	function checkInsertCus($input)
	{
		if($input == 1)
		{
			document.getElementById("errorCus").innerHTML = "Error! Customer record cannot be inserted";
			
		}
		else
		{
			document.getElementById("errorCus").innerHTML = "";
		}
		
	}
	
	
	
 
  </script>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-sgray-900 mb-4">Create an Account!</h1>
				<p id = "errorPassword"></p>
				<p id = "errorEmail"></p>
				<p id = "errorAddress"></p>
				<p id = "errorCus"></p>
              </div>
              <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" >
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="firstName" minlength = "3" title = "Characters only and minimum length is 3" pattern="[^\s][A-Za-z\s]+" maxlength="45" required="required" id="firstName" placeholder="First Name" value="<?php echo isset($_POST["firstName"]) ? $_POST["firstName"] : ''; ?>">
					<p id = "wrongFirstName"></P>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" maxlength="45" minlength = "5" title = "Characters only and minimum length is 3"  pattern="[^\s][A-Za-z\s]+" name = "lastName"  id="lastName" required="required" placeholder="Last Name" value="<?php echo isset($_POST["lastName"]) ? $_POST["lastName"] : ''; ?>">
					<p id = "wrongLastName"></p>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" maxlength = "50" minlength = "9" required = "required" name = "email" id="email" placeholder="Email Address" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>">
                </div>
				 <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" maxlength = "40" minlength = "5"  title = "minimum length is 5" required = "required" name = "password" id="passwords" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" maxlength = "40" minlength = "5" required = "required" id="repeatPassword" name = "repeatPassword" placeholder="Repeat Password">
                  </div>
                </div>
				 <div class="form-group row">
				 <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" pattern="[0-9]+" minlength = "6"   name = "phone" title = "Numbers only and minimum length is 6" id="phone" placeholder="Phone (Optional)" value="<?php echo isset($_POST["phone"]) ? $_POST["phone"] : ''; ?>">
					<p id = "phoneDetails">* Only numbers<br/></P>
                  </div>
				 </div>
				 <div class="form-group">
                  <input type="text" class="form-control form-control-user" minlength = "6" pattern="[^\s][A-Za-z0-9 , \s]+" title = "Characters and numbers and ',' symbol only and minimum lenght is 6" maxlength = "50" required = "required" name = "address1" id="address1" placeholder="Enter the address1" value="<?php echo isset($_POST["address1"]) ? $_POST["address1"] : ''; ?>">
                </div>
				 <div class="form-group">
                  <input type="text" class="form-control form-control-user" minlength = "6" pattern="[^\s][A-Za-z0-9 , \s]+" title = "Characters and numbers and ',' symbol only and minimum lenght is 6" maxlength = "50" name = "address2" id="address2" placeholder="Enter the address2(Optional)" value="<?php echo isset($_POST["address2"]) ? $_POST["address2"] : ''; ?>">
                </div>
			  <div class="form-group row">
				<div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" minlength = "4" pattern="[^\s][A-Za-z & \s]+" title = "Characters and '&' symbol only minimum lenght is 4" maxlength = "20" required = "required" name = "district"  id="district" placeholder="District" value="<?php echo isset($_POST["district"]) ? $_POST["district"] : ''; ?>">
                  </div>
				  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" minlength = "4" maxlength = "10"  pattern="[0-9]+" title = "Numbers only and minimum lenght is 4" name = "postalCode" id="postalCode" placeholder="Postal Code(Optional)" value="<?php echo isset($_POST["postalCode"]) ? $_POST["postalCode"] : ''; ?>">
                  </div>
				 
			   </div>
			   
						 
                       <div class="form-group row">
			    <div class="col-sm-6 mb-3 mb-sm-0">
                     <select autocomplete = "off" required = "required" name = "list" id="list"  placeholder="Pick a city or search" >
					
						 
						 <?php
						   echo "<option value = ''>-- Select a city --</option>";
						   $sqli = "SELECT city_id,city FROM `city` WHERE 1";
						   $result2 = mysqli_query($links, $sqli);
						   
						   while($row = mysqli_fetch_assoc($result2)){
							   
							   $selected = (isset($_POST['list']) && $_POST['list'] ==  $row['city_id']) ? 'selected' : '';
							   
							   echo "<option value='$row[city_id]' $selected >$row[city]</option>";
							  
						   }
						   
						 ?>
					   </select>
						<div class="form-group row">
						
						<div>
                <?php
				if(empty($_POST['list'])){  
					
					  echo "<p style=\"color: blue;margin-left:10px;\">*Can also be search","</p>\n\n";
					  
				}
                
				
                ?>
            </div>
				</div>
                  </div>
				  
                </div>
				
                <button  name = "submitPost"  type="submit" class="btn btn-primary btn-user btn-block">
                  Register Account</button>
				 <button onClick="window.location.href=window.location.href" class="btn btn-primary btn-user btn-block">Refresh Page</button>
                </a>
				
             
                
              </form>
			  
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.html">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
 <?php
   $f_Name = '';
   $l_Name = '';
   $email1 = '';
   $password1 =''; 
   $conPassword ='';
   $address_1 = '';  
   $dist = ''; 
   $city = ''; 
   $tempBool = True;
   
   if (isset($_POST['list']))
   {
        $result1 = mysqli_query($links, 'SELECT city_id FROM city WHERE city_id=' . $_POST['list']);
        while ($row = mysqli_fetch_assoc($result1))
        {
            $city = $row['city_id'];
        }
   }
   
   
   if(isset($_REQUEST['password'])&&isset($_REQUEST['repeatPassword']) && isset($_REQUEST['email'])){
	  $f_Name = $_REQUEST['firstName'];
      $l_Name = $_REQUEST['lastName'];
      $phonePP = $_REQUEST['phone'];
	  $address_1 = $_REQUEST['address1'];
	  $address_2 = $_REQUEST['address2'];
	  $postalC = $_REQUEST['postalCode'];
	  $dist = $_REQUEST['district'];
	  $password1 = $_REQUEST['password'];
	  $conPassword =$_REQUEST['repeatPassword'];
	  $email1 =$_REQUEST['email'];
	  $sqlEmail= "SELECT customer.email FROM customer WHERE 1";
	  $results = mysqli_query ($links,$sqlEmail);
   if($password1 != $conPassword){
	   echo(" <script> checkingPassword(1)</script>");
	   $tempBool = False;
   }
   while($rowEmail = mysqli_fetch_assoc($results)) 
  {   
	    $data_Email = $rowEmail['email'];
		
		 if((strtoupper($email1) == strtoupper($data_Email)) || (strtolower($email1)== strtolower($data_Email))){
	       echo("<script> checkingEmail(1)</script>");
	       $tempBool = False;
         }
  }
  
   if($tempBool == True){
	   $sqlAdd = "INSERT INTO address (`address_id`, `address`, `address2`, `district`, `city_id`, `postal_code`, `phone`, `last_update`) VALUES (NULL, '$address_1', NULLIF('$address_2',''), '$dist', '$city', NULLIF('$postalC',''), NULLIF('$phonePP',''), current_timestamp())";
	   $run_address_tb = mysqli_query($links,$sqlAdd);
	   if($run_address_tb){
	     $address_id_in= mysqli_insert_id($links);
	     $customerQuery = "INSERT INTO `customer` (`customer_id`, `store_id`, `first_name`, `last_name`, `email`, `address_id`, `active`, `create_date`, `last_update`, `password`) VALUES (NULL, NULL, '$f_Name', '$l_Name', '$email1', '$address_id_in', '1', current_timestamp(), current_timestamp(), '$password1')";
	     $run_customer_tb = mysqli_query($links,$customerQuery);
	     if(!$run_customer_tb){
		     echo("<script> checkInsertCus(1)</script>");
		   
	     }else{
		     echo("<script type='text/javascript'>
				alert('register successful');
				window.location = 'login.php';
			</script>");
		 
	    }
	   }else
	   {
		     echo("<script> checkInsertADD(1)</script>");
		   
	   }
	   
	   
   }
   
  }
    
  
 ?>
 
  

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script>
  // function alpha(){  //problem when using this and cant check other validation
  //  var element = document.getElementById("list");
   // var letters = /^[a-zA-Z]+$/;
   // if(document.getElementById("firstName").value.match(letters))
  //  {
  //   alert('Your registration number have accepted : you can try another');   
 //   }
 //   else 
  //  { 
  //   document.getElementById("wrongFirstName").innerHTML =  "Please enter the correct alphabest";
  //  } 
  // }</script>
 
<script>
   $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
  </script>
 
</body>

</html>
