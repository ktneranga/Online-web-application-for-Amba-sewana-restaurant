<?php 
include('inc/connection.php');
 ?>

 <?php 
if(isset($_GET['id'])){
	$cat_id = $_GET['id'];
	$query = "DELETE FROM ecategory WHERE id = '{$cat_id}'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		//category deleted
		header('Location:ecategory.php?delete=true');
	}else{
		//category deleted failed
		header('Location:ecategory.php?delete=false');
	}

}

  ?>