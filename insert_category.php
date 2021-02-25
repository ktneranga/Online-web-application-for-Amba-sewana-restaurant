<?php include('inc/connection.php'); ?>

<?php 

$category = "Short-eats";

$query = "INSERT INTO category (category) VALUES ('{$category}')";

$result = mysqli_query($connection, $query);

if($result){
		echo "1 cat  added";
}else{
	echo "insert query failed";
}

 ?>