<?php session_start(); ?>
<?php include('inc/connection.php'); ?>
<?php include('inc/connection.php'); ?>

<?php 
//checking if user is registered
	if (!isset($_SESSION['user_id'])) {
	 header('Location:index.php?');
	}
 ?>

<?php include('inc/product_nav.php'); ?>

<!-- side-menu -->
<?php include('inc/side_menu.php'); ?>
<!-- side-menu -->

<section class="contact">
	<div class="row text-center">
		<div class="col-md-12">
			<h1 class="section-title"><span style="color: orange;">My</span> Orders</h1>
		</div>
	</div>

	<div class="container">
		<div class="row">
			
		</div>
	</div>

</section><!-- contact -->

<?php include('inc/footer.php'); ?>