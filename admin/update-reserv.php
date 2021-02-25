<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- insert foods items -->
<?php 

	//intilization
	$reserve_id ='';
	$no_of_guest = '';
	$email = '';
	$phone = ''; 
	$date_res = ''; 
	$time = ''; 
	$suggestions = ''; 
    $category = '';
	
	if(isset($_GET['reserve_id']))
		{
			$reserve_id = mysqli_real_escape_string ($conncetion,$_GET['reserve_id']);
		}
	if(isset($_POST['update'])){
		$no_of_guest =$_POST['no_of_guest'];
		$email =$_POST['email'];
		$phone =$_POST['phone'];
		$date_res =$_POST['date_res'];
		$time =$_POST['time'];
		$suggestions =$_POST['suggestions'];
		$category =$_POST['category'];
		
		
		
		$query = "UPDATE reservation SET ";
			$query .= "WHERE reserve_id = {$reserve_id} LIMIT 1";
			$query .= "no_of_guest = '{$no_of_guest}', "; 
			$query .= "email = '{$email}', "; 
			$query .= "phone = '{$phone}', "; 
			$query .= "date_res = '{$date_res}', "; 
			$query .= "time = {$time} "; 
			$query .= "suggestions = {$suggestions} "; 
			$query .= "category = {$category} "; 
			

			$result = mysqli_query($connection, $query);
	
			if ($result) {
		    //query successfull...user added true
		    header('Location:Dash_reserv.php?');
		   }
			
		  }
	

?>

<?php
include('inc/scripts.php');
include('inc/footer.php');
?>