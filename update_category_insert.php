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
<! DOCTYPE html >
<html lang = "en">
<head>
<link rel = "shortcut icon" href = "img/fav.png" />
<title>Language check</title>
<script>
  function same_cateN(){
	  document.getElementById("sameCate").submit();
	  
  }
  
  function dupli_categoryName(){
	   document.getElementById("dupli_cate_Name").submit();
  }

  function updateCateCan(){
	   document.getElementById("successCate").submit();
  }
  
  function error_CateCant(){
	   document.getElementById("error_Cate").submit();
  }
</script>
</head>
<body>
<br /><br /><br />

<?php
	
	$categoryName = '';
	
	if(isset($_POST['cateID']) && isset($_POST['cateName']))
	{		
		$categoryName = $_POST['cateName'];
		$check_temp = True;
		$cateUID = $_POST['cateID'];
		$links = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
				
		
  
	    $sqlUpCheck = "SELECT name FROM category WHERE category_id = '$cateUID'";
		$resultss = mysqli_query($links,$sqlUpCheck);
		$rowCheck = mysqli_fetch_assoc($resultss);
		$checkCateName = $rowCheck['name'];
		
		if($categoryName == $checkCateName){
			$check_temp = False;
			 echo("<script type='text/javascript'>
				alert('Invalid update : same value found');	
			 </script>");
			 echo ("<form id = 'sameCate' name = 'sameCate' method = 'POST' action = 'update_category.php'> <input type = 'text' value = '1' name = 'inside_categoryUP'/> <input type = 'text' value = '$cateUID' name = 'update_category'/>  
			   </form>");
		     echo ("<script>same_cateN();</script>");
			  
			
		}
		$check_dupli_Cname = '';
		$sqlCheck = "SELECT category.name FROM category WHERE category.name <> '$checkCateName'";
		$resultCheck = mysqli_query ($links,$sqlCheck);
		while($row2 = mysqli_fetch_assoc($resultCheck)){
		    $check_dupli_Cname = $row2['name'];

			if(strtoupper($categoryName) == strtoupper($check_dupli_Cname)){
				$check_temp = False;
				 echo("<script type='text/javascript'>
				alert('Invalid update : Duplicate value found');	
			     </script>");
			   echo ("<form id = 'dupli_cate_Name' name = 'dupli_cate_Name' method = 'POST' action = 'update_category.php'> <input type = 'text' value = '1' name = 'dupli_categoryUP'/> <input type = 'text' value = '$cateUID' name = 'update_category'/>  
			   </form>");
		       echo ("<script>dupli_categoryName();</script>");
				
			}	
		}
		
       $checkForValuess = "SELECT category_id,name FROM `category` WHERE name = 'Action'";
	   $result = mysqli_query($links,$checkForValuess);
	   $resultss = mysqli_fetch_assoc($result);
	   $checkCateIDD = $resultss['category_id'];
	   $checkCateName = $resultss['name'];
	   if($cateUID == $checkCateIDD && strtoupper($categoryName) == $checkCateName){
		   
		    echo("<script type='text/javascript'>
				alert('Cannot update default value');
				window.location = 'tables_category.php';
			</script>");
		   
		   
	   }
		
	  if($check_temp == True){
		  $sqlUp = "UPDATE `category` SET `name`='$categoryName',`last_update`= current_timestamp() WHERE category_id = '$cateUID'";
		  $run_CateName_update = mysqli_query($links,$sqlUp);
		  if($run_CateName_update){
			   echo("<script type='text/javascript'>
				alert('Category name successfully updated');
			</script>");
	      echo ("<form id = 'successCate' name = 'successCate' method = 'POST' action = 'update_category.php'><input type = 'text' value = '$cateUID' name = 'update_category'/>  
			   </form>");
	      echo ("<script>updateCateCan();</script>");
		  }
		  
		  
	  }else{
		   echo("<script type='text/javascript'>
				alert('Invalid Update : Cannot be updated to database');
			</script>");
	      echo ("<form id = 'error_Cate' name = 'error_Cate' method = 'POST' action = 'update_language.php'><input type = 'text' value = '1' name = 'errorCateN'/><input type = 'text' value = '$cateUID' name = 'update_category'/>  
			   </form>");
	      echo ("<script>error_CateCant();</script>");
		  
		  
	  }
		
	}else{
		 echo("<script type='text/javascript'>
				alert('Error in fetching the data');
				window.location = 'tables_category.php';
			</script>");
				  
		
	}				
		
		
	  
  ?>
  
	
</body>
</html>