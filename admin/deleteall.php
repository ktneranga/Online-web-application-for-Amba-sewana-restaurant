<?php 
include('inc/connection.php');
 ?>

 <?php 
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$query = "TRUNCATE TABLE reservation";
	$result = mysqli_query($connection, $query);
	if ($result) {
		//category deleted
		header('Location:Dash_reserv.php?delete=true');
	}else{
		//category deleted failed
		header('Location:Dash_reserv.php?deletefalse');
	}

}

  ?>