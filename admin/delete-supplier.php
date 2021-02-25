<?php 
include('inc/connection.php');
 ?>

 <?php 
if(isset($_GET['id'])){
	$sup_id = $_GET['id'];
	$query = "DELETE FROM supplier WHERE id = '{$sup_id}'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		//supplier deleted
		header('Location:supplier.php?delete=true');
	}else{
		//supplier deleted failed
		header('Location:supplier.php?delete=false');
	}

}

  ?>
  