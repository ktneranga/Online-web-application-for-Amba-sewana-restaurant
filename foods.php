<?php session_start(); ?>
<?php include('inc/connection.php'); ?>
<?php include('inc/product_nav.php'); ?>
<!-- side-menu -->
<?php include('inc/side_menu.php'); ?>
<!-- side-menu -->

<!-------------------popular foods---------------------->



<section class="on-sale">
	<div class="container">
		<div class="title-box">
			<?php 
			//check whether the category name has passed
			if(isset($_GET['name']) && !empty($_GET['name'])){

			 ?>
			 <!-- display the category name -->
			<h2><?php echo $_GET['name']; ?></h2>

		<?php }else{ ?>
			<!-- if the category name has not passed display All foods -->
			<h2>All Foods</h2>
		<?php } ?>
		</div><!-- title-box -->

		<div class="row">
		<?php 

			if (isset($_GET['id']) && !empty($_GET['id'])) {
				$id = $_GET['id'];
				//get food items under category id
				$query = "SELECT * FROM foods WHERE cat_id = $id AND is_available = 0";
			}else{
				//get all food items
				$query = "SELECT * FROM foods WHERE is_available = 0";
			}

			$result_set = mysqli_query($connection, $query);
			while ($row = mysqli_fetch_assoc($result_set)):

		?>
		<!-- food items to be displayed -->
			<div class="col-md-3 mt-3">
				<div class="product-top">
					<img src="img/product/<?=$row['thumbnail']?>" style="width: 250px; height: 200px;">
					<div class="overlay-right">
						<a type="button" class="btn btn-secondary" title="Quick Shop">
							<i class="fa fa-eye"></i>
						</a>
						<a type="button" class="btn btn-secondary" title="Add to Wish List">
							<i class="fa fa-heart-o"></i>
						</a>
						<!-- when the button clicked redirect to the single product page -->
						<!-- pass food id and the category id -->
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
					<h3><?=$row['name']?></h3>
					<h5>Rs. <?= number_format($row['price'],2)?></h5>
				</div><!-- product-bottom -->
			</div>
		<?php endwhile; ?>
		<!-- food items to be displayed -->

		</div><!-- row -->

		<!-- if there are no food items display message -->
		<div class="row text-center">
			<div class="col-12">
				<div class="col-12">
				
				<?php 

					if($result_set){
						$num_rows = mysqli_num_rows($result_set);
						if ($num_rows == 0) {
							echo "<h1 style=\"color : orange; font-size : 60px;\" class=\"mt-5 mb-5\">Sorry No food Items !</h1>";
						}
					}

				 ?>
			</div>
			</div>
		</div>
	</div><!-- container -->
</section>

<?php include('inc/footer.php'); ?>