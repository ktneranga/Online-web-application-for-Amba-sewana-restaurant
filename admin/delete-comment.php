<?php 
include('inc/connection.php');
 ?>

 <?php 
if(isset($_GET['id'])){
	$rev = $_GET['id'];
	$query = "DELETE FROM reviews WHERE id = '{$rev}'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		//category deleted
		header('Location:comments.php?delete_com=true');
	}else{
		//category deleted failed
		header('Location:comments.php?delete_com=false');
	}

}

  ?>