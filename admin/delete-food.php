<?php 
include('inc/connection.php');
 ?>

 <?php 
if(isset($_GET['id'])){
	$foodid = $_GET['id'];
	$query = "DELETE FROM foods WHERE id = '{$foodid}'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		//category deleted
		header('Location:foods.php?delete_food=true');
	}else{
		//category deleted failed
		header('Location:foods.php?delete=false');
	}

}

  ?>