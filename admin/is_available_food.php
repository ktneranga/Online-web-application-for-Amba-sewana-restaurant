<?php 
include('inc/connection.php');
 ?>

 <?php 
if(isset($_GET['available_id'])|| isset($_GET['unavailable_id'])){

	if (isset($_GET['available_id'])) {
		$foodid = $_GET['available_id'];

		$query = "UPDATE foods SET is_available = 0 WHERE id = '{$foodid}' ";
		$result = mysqli_query($connection, $query);

		if ($result) {
			//food made unavailable
			header('Location:foods.php?available_food=true');
		}else{
			//food make unavailable failed
			header('Location:foods.php?available_food=false');
		}


	}else if (isset($_GET['unavailable_id'])) {
		$foodid = $_GET['unavailable_id'];

		$query = "UPDATE foods SET is_available = 1 WHERE id = '{$foodid}' ";
		$result = mysqli_query($connection, $query);

		if ($result) {
			//food made unavailable
			header('Location:foods.php?unavailable_food=true');
		}else{
			//food make unavailable failed
			header('Location:foods.php?unavailable_food=false');
		}
	}else{
		header('Location: foods.php?query_failed=true');
	}

}

  ?>