<?php 
include('inc/connection.php');
 ?>

 <?php 
if(isset($_GET['id'])){
	$mat_id = $_GET['id'];
	$query = "DELETE FROM materials WHERE id = '{$mat_id}'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		//materials deleted
		header('Location:materials.php?delete=true');
	}else{
		//materials deleted failed
		header('Location:materials.php?delete=false');
	}

}

  ?>
  