<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>



<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Table</h1>
    <a href="Dash_reserv.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-chevron-circle-left fa-sm text-white-50"></i> Back to Dash_reserv</a>
      
  </div>

 <div class="product-bottom text-center" >
		<form  action="add-table.php" method="post" style="max-width:1000px;margin:auto;">
			
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
				
				<div class="form_group">
					<button type="submit" class="btn btn-warning" name="book" style="color: white;">Make your Booking</button>
				</div>
				
			</div>
		</form>
			<p class="clear"></p>
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
					
					
					// message
					if (isset($_GET['book'])) {
					echo '<div class="alert alert-success" role="alert"> Successful!</div>';
					}
				}
				
			?>
			
	  </div>
	
	</body>
		
</section>


<?php
include('inc/scripts.php');
include('inc/footer.php');
?>