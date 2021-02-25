<?php 
include('inc/connection.php');
 ?>

 <?php 
if(isset($_GET['id'])){
	$stockid = $_GET['id'];
	$query = "DELETE FROM stock WHERE id = '{$stockid}'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		//stock deleted
		header('Location:stock.php?delete_stock=true');
	}else{
		//materials deleted failed
		header('Location:stock.php?delete_stock=false');
	}

}

  ?>