
<?php
   
   $conn = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
   

   $sql = "SELECT film.film_id, film.title, film.description, film.release_year, film.rating, category.name FROM film JOIN film_category ON film_category.film_id = film.film_id JOIN category ON category.category_id = film_category.category_id ";
   

   $result = mysqli_query($conn, $sql) or die ("Bad Query: $sql");
   //$result2 = mysqli_query($conn, $sql2) or die ("Bad Query: $sql2");
   $result_check = mysqli_num_rows($result);
   
   $rows = mysqli_fetch_array($result);
  
   
   $datarray = array();
   
   if($result_check > 0){
       while($rows = mysqli_fetch_assoc($result)){
           
           $film_id = $rows['film_id'];
           $sql2 = "SELECT COUNT(B.film_id) AS 'Stock' FROM (SELECT inventory.inventory_id, inventory.film_id, inventory.store_id FROM rental INNER JOIN inventory ON rental.inventory_id = inventory.inventory_id INNER JOIN film ON inventory.film_id = film.film_id WHERE inventory.inventory_id NOT IN (SELECT inventory.inventory_id FROM rental INNER JOIN inventory ON rental.inventory_id = inventory.inventory_id INNER JOIN film ON film.film_id = inventory.film_id WHERE rental.return_date IS NULL AND film.film_id = '$film_id' AND inventory.inventory_status_id = 3)AND film.film_id = '$film_id' AND inventory.inventory_status_id = 3 GROUP BY inventory.inventory_id) AS B ";
           $query = mysqli_query($conn, $sql2) or die ("Bad Query: $sql2");
           $row1 = mysqli_fetch_assoc($query);
           $stock_count = $row1['Stock'];
           $temp = array("Stock"=>"$stock_count");
           $merged_array = array_merge($rows, $temp);
           $datarray[] = $merged_array;
           
       }
       json_encode($datarray);
       $fp = fopen('assignment2.json', 'w');
       fwrite($fp, json_encode($datarray));
       fclose($fp);
   }else{
       echo "No result";
   }
   
   mysqli_close($conn);


?>





