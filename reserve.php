<?php session_start(); ?>
<?php include('inc/connection.php'); ?>
<?php include('inc/product_nav.php'); ?>

<!-- side-menu -->
<?php include('inc/side_menu.php'); ?>
<!-- side-menu -->

<!DOCTYPE html>
<html lang="en">   

<section class="contact">
	<div class="row text-center">
		<div class="col-md-12">
			<h1 class="section-title"><span style="color: orange;">Reserve Table</span></h1>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<?php 
			  //delete message
			  if (isset($_GET['book'])) {
				echo '<div class="alert alert-success" role="alert">Reservation requests successful!</div>';
			  }	

			?>
		</div>
	</div>
 
	
	<!--table reservation form-->
	
  
	<div class="product-bottom text-center" >
		<form  action="reserve.php" method="post" style="max-width:1000px;margin:auto;">
			
			<div class="form-row" >
				<div class="col">
					 <label>No of Guest</label>
					<input type="number" class=" form-control" placeholder="How many guests" min="1" name="no_of_guest" id="guest"  required>	
				</div>
				
				<div class="col">
					<label>Give Category</label>
					<select id="category" class=" form-control" placeholder="category"  name="category" id="category" required>>
					  <option value="Family"selected>Family special </option>
					  <option value="Couple">Couple love </option>
					  <option value="Meeting">Meeting official</option>
					  <option value="Friends" >Friends enjoyable</option>
					</select>
				</div>
				
				<div class="col">
					<label>Email</label>
					<input type="email" class=" form-control" name="email" placeholder="Enter your email" required>	
				</div>
				
				<div class="col">
					<label>Phone Number</label>
					<input type="phone number" class=" form-control" pattern="[0-9]+" name="phone" placeholder="Enter your phone number" required>
				</div>
				
				<div class="col">
					<label>Date</label>
					<input type="date"class=" form-control"  name="date_res"  placeholder="Select date for booking"  required>

				</div>
				
				<div class="col">
					<label>Time</label>
					<input type="time" class=" form-control" name="time" pattern="[7-10]+" placeholder="Select time for booking"   required>
				</div>
				
				
			</div>
			
			<div class="form-group mt-4">
				
				<div class="form_group">
                    <label>Suggestions <small><b>(E.g No of Plates, How you want the setup to be)</b></small></label>

					<textarea name="suggestions" class=" form-control" placeholder="your suggestions" required></textarea>
				</div>
				
				<div class="form_group mt-3">
					<button type="submit" class="btn btn-warning" name="book" style="color: white;">Make your Booking</button>
				</div>
				
			</div>
		</form>
			<p class="clear"></p>
			
			<!--set data to data base-->
			<?php
			
			//insert 
				require "inc/connection.php";
		
				if(isset($_POST['book'])){
					$no_of_guest =$_POST['no_of_guest'];
					$email =$_POST['email'];
					$phone =$_POST['phone'];
					$date_res =$_POST['date_res'];
					$time =$_POST['time'];
					$suggestions =$_POST['suggestions'];
					$category=$_POST['category'];
					$query = "INSERT INTO reservation(no_of_guest,email,phone,date_res,time,suggestions,category) VALUES('$no_of_guest','$email','$phone','$date_res','$time','$suggestions','$category')";
				
					//give data  in to data base
					$connection->query($query);
				}
			?>
			
			
	  </div>
	
	</body>
		
</section>

<!-- contact -->

<?php include('inc/footer.php'); ?>