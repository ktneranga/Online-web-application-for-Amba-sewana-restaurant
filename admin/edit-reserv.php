<?php
include('inc/connection.php');
	//data callling
	if(isset($_GET['id'])){
		$reserve_id = $_GET['id'];
		
		$rec = mysqli_query($connection,"SELECT * FROM reservation WHERE reserve_id =  '$reserve_id' ");
		$record = mysqli_fetch_array($rec);
		$reserve_id = $record['reserve_id'];
		$no_of_guest = $record['no_of_guest'];
		$email = $record['email'];
		$phone = $record['phone'];
		$date_res = $record['date_res'];
		$time = $record['time'];
		$suggestions = $record['suggestions'];
		$category = $record['category'];
		
	}

include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!DOCTYPE html>
<html lang="en">   

<section class="contact">
	<div class="row text-center">
		<div class="col-md-12">
			<h1 class="section-title"><span style="color: orange;">Reserve Table update </span></h1>
		</div>
	</div>

	<div class="container">
		<div class="row">
			
		</div>
	</div>
 
	
	<!--table reservation form-->
	
	  
  
	<div class="product-bottom text-center" >
		<form  action="update-reserv.php" method="post" style="max-width:1000px;margin:auto;">
			<input type="hidden" name="reserve_id" value = "<?php echo $reserve_id ;?>">
			<div class="form-row" >
				<div class="col">
					 <label>No of Guest</label>
					<input type="number" class=" form-control" name="no_of_guest" value ="<?php echo $no_of_guest;?>" >	
				</div>
				
				<div class="col">
					<label>Give Category</label>
					<select id="category" class=" form-control"  name="category" value ="<?php echo $category;?>" >
					  <option value="Family"selected>Family special </option>
					  <option value="Couple">Couple love </option>
					  <option value="Meeting">Meeting official</option>
					  <option value="Friends" >Friends enjoyable</option>
					</select>
				</div>
				
				<div class="col">
					<label>Email</label>
					<input type="email" class=" form-control" name="email" value ="<?php echo $email;?>">	
				</div>
				
				<div class="col">
					<label>Phone Number</label>
					<input type="number" class=" form-control" name="phone" value ="<?php echo $phone;?>" >
				</div>
				
				<div class="col">
					<label>Date</label>
					<input type="date"class=" form-control"  name="date_res" value ="<?php echo $date_res;?>" >

				</div>
				
				<div class="col">
					<label>Time</label>
					<input type="time" class=" form-control" name="time" value ="<?php echo $time;?>">
				</div>
				
				
			</div>
			
			<div class="form-group mt-4">
				
				<div class="form_group">
                    <label>Suggestions <small><b>(E.g No of Plates, How you want the setup to be)</b></small></label>
					<textarea name="suggestions" class=" form-control" value ="<?php echo $suggestions;?>" ></textarea>
				</div>
				
				<div class="form_group">
					<button type="submit" class="btn btn-warning" name="update" style="color: white;">update</button>
					<a href="Dash_reserv.php?" class="btn btn-warning ">ignore</a>
				</div>
				
			</div>
		</form>
			<p class="clear"></p>
			
			
	  </div>
	
	</body>
		
</section>

<!-- contact -->

<?php include('inc/footer.php'); ?>