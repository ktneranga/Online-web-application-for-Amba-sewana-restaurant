<?php session_start(); ?>
<?php include('inc/connection.php'); ?>
<?php include('inc/product_nav.php'); ?>

<!-- side-menu -->
<?php include('inc/side_menu.php'); ?>
<!-- side-menu -->

<?php include('inc/functions.php'); ?>
<?php include('inc/comment_modal.php'); ?>

<?php 
//checking if food has selected
	if (!isset($_GET['pid'])) {	
	 header('Location:index.php?');
	}
 ?>

 <!-- checking if the cat_id has passed  -->
 <?php 
$cat_id = '';
if (isset($_GET['cat_id'])) {
	$cat_id = $_GET['cat_id'];
}

  ?>

<?php 
if (isset($_GET['pid']) && !empty($_GET['pid'])) {
	$id = $_GET['pid'];
	//get the details of the food item passed from the foods page
	$foodsql = "SELECT * FROM foods WHERE id = $id";
	$result = mysqli_query($connection, $foodsql);
	$foodrow = mysqli_fetch_assoc($result);
}else{
	//header('Location:foods.php');
}

 ?>

<section class="single-product">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div id="product-slider" class="carousel slide" data-ride="carousel">
				  <div class="carousel-inner">
				    <div class="carousel-item active">
				      <img src="img/product/<?=$foodrow['thumbnail']?>" class="d-block" alt="..." style="height: 400px; width: 480px;">
				    </div>
				    <div class="carousel-item">
				      <img src="img/product/<?=$foodrow['thumbnail']?>" class="d-block" alt="..." style="height: 400px; width: 480px;">
				    </div>
				    <div class="carousel-item">
				      <img src="img/product/<?=$foodrow['thumbnail']?>" class="d-block" alt="..." style="height: 400px; width: 480px;">
				    </div>
				  </div>
				  <a class="carousel-control-prev" href="#product-slider" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#product-slider" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
			</div>

			<div class="col-md-7">
				<p class="new-arrival text-center">NEW</p>
				<h2 class="food-title"><?php echo $foodrow['name']; ?></h2>
				<p>Product Code : ASFI0001</p>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star-half-o"></i>

				<p class="price">Rs. <?php echo number_format($foodrow['price'],2); ?></p>
				<form method="get" action="cart.php?action=addToCart&id=">
				<label>Quantity :</label>
				<input type="product-quantity" class="" name="quantity" id="quantity" value="1" size="2">
				<input type="hidden" name="id" id="id" value="<?php echo $foodrow['id']; ?>"><br>
				<button type="submit" class="btn btn-primary" name="add">Add to Cart</button>
				</form>
				
			</div>

		</div>
	</div><!-- container -->
</section>

<!-- product description -->

<section class="product-description">
	<div class="container">

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<!-- //description tab -->
	  <li class="nav-item">
	    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><h2 style="color: orange; font-size: 18px;">Food Description</h2></a>
	  </li>
	  <!-- //comments tab -->
	  <li class="nav-item">
	    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><h2 style="color: orange; font-size: 18px;">Comments</h2></a>
	  </li>
	</ul>

	<div class="tab-content" id="myTabContent">
	  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
	  	<!-- //display the food description -->
	  	<p class="description mt-2"><?php echo $foodrow['description'] ?></p>
	  </div>
	  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	  	<h6 class="mt-2" style="color: grey;">Comments for <?php echo $foodrow['name']; ?></h6>
	  		<ul class="comment-list">


		<?php 
		//get the comments from the reviews table accoriding to the selected pid
		$comment_query ="SELECT * FROM reviews WHERE pid = $id ORDER BY id DESC LIMIT 3";

		$result_set = mysqli_query($connection, $comment_query);

		//$num_rows = mysqli_num_rows($result);

		while($raw = mysqli_fetch_assoc($result_set)){
		 ?>

	  			<li class="mt-3 mb-3">	
	  				<div class="comment-meta">
	  					<!-- //dispay the customer name --> 
	  					<a href="#"><?php echo $raw['name']; ?></a>
						<span>
						<!-- //display the date and time -->	
						<small><?php echo $raw['timestamp']; ?></small>
						</span>
	  				</div>
	  				<div class="comment">
	  					<p><?php echo $raw['review']; ?></p>
	  				</div>
	  			</li>
	  		<?php }?>	
	  		</ul>

	  	<h6 class="mt-2" style="color: grey;">Add a Comments</h6>
	  		<!-- Display error messages -->
	  		<?php 

		        if (!empty($errors)) {
		          echo "<div class='errmsg'>";
		          echo '<div class="alert alert-danger" role="alert">There were error(s) on your form!</div>';
		          foreach ($errors  as $error) {
		            echo $error."<br>";
		          }
		          echo "</div>";
		        }
		    ?>
	<?php 

	//check whether the user has logged in
	if (!isset($_SESSION['user_id'])) {
	 ?>	
	 <!-- // if the user has not logged in display the warning -->
	 <p style="color: red">*Please Login First before adding comments!</p>
	 <!-- //if the user has not logged in button is disabled -->    
	<button class="btn btn-warning disabled" style="color:white;" data-toggle="modal" data-target=".bd-example-modal-xl disabled">Add a Comment</button>
	<?php }else{ ?>
	<!-- //if the user logged in buuton is enabled -->	
	<button class="btn btn-warning" style="color:white;" data-toggle="modal" data-target=".bd-example-modal-xl ">Add a Comment</button>
	<?php } ?>
	  </div>
	</div>
	</div>	
</section><!-- product-review -->

<!-- //similar food items according to the selected category id -->
<section class="more-foods">
	<div class="container">
		<div class="title-box">
			<h2>Similar Foods</h2>
		</div><!-- title-box -->

		<div class="row">

			<!-- display similar food items -->

			<?php 

			$select_query = "SELECT * FROM foods WHERE cat_id = {$cat_id} AND is_available = 0 ORDER BY id DESC LIMIT 4";
			$food_result = mysqli_query($connection, $select_query);

			//if query success	
			while($row = mysqli_fetch_assoc($food_result)){
			 ?>


			<div class="col-md-3">
				<div class="product-top">
					<img src="img/product/<?php echo $row['thumbnail']; ?>">
					<div class="overlay-right">
						<a type="button" class="btn btn-secondary" title="Quick Shop">
							<i class="fa fa-eye"></i>
						</a>
						<a type="button" class="btn btn-secondary" title="Add to Wish List">
							<i class="fa fa-heart-o"></i>
						</a>
						<a type="button" class="btn btn-secondary" href="product.php?pid=<?php echo $row['id'];?>&cat_id=<?php echo $row['cat_id']; ?>" title="Add to Cart">
							<i class="fa fa-shopping-cart"></i>
						</a>
					</div><!-- overlay-right -->
				</div><!-- product-top -->

				<div class="product-bottom text-center">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-o"></i>
					<h3><?php echo $row['name']; ?></h3>
					<h5>Rs. <?= number_format($row['price'],2)?></h5>
				</div><!-- product-bottom -->

			</div>
		<?php } ?>
			
		</div><!-- row -->
	</div><!-- container -->
</section>


<?php include('inc/footer.php'); ?>

