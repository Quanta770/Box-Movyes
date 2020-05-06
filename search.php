
<?php
   
    $conn = mysqli_connect('localhost','hfycb1_hfycb1','12345isint.','hfycb1_id13307643_assignment2') or die("Could not connect to database");
    

    $sql = "SELECT film.film_id, film.title, film.description, film.release_year, film.rating, category.name 
    FROM film 
    JOIN film_category ON film_category.film_id = film.film_id
    JOIN category ON category.category_id = film_category.category_id";


    $result = mysqli_query($conn, $sql) or die ("Bad Query: $sql");
    $result_check = mysqli_num_rows($result);
    $datarray = array();

    if($result_check > 0){
        while($row = mysqli_fetch_assoc($result)){
            $datarray[] = $row;

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





