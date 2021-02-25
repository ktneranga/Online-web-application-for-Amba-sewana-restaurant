<?php 
include('inc/connection.php');
 ?>

 <?php 
if(isset($_GET['id'])){
	$employeeid = $_GET['id'];
	$query = "DELETE FROM employeesalary WHERE id = '{$employeeid}'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		//category deleted
		header('Location:employeesalary.php?delete_employee=true');
	}else{
		//category deleted failed
		header('Location:employeesalary.php?delete=false');
	}

}

  ?>