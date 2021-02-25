<?php 
include('inc/connection.php');
 ?>

 <?php 
if(isset($_GET['id'])){
	$cat_id = $_GET['id'];
	$query = "DELETE FROM category WHERE id = '{$cat_id}'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		//category deleted
		header('Location:category.php?delete=true');
	}else{
		//category deleted failed
		header('Location:category.php?delete=false');
	}

}

  ?>