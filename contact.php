<?php session_start(); ?>
<?php include('inc/connection.php'); ?>
<?php include('inc/product_nav.php'); ?>

<!-- side-menu -->
<?php include('inc/side_menu.php'); ?>
<!-- side-menu -->

<section class="contact">
	<div class="row text-center">
		<div class="col-md-12">
			<h1 class="section-title mb-4"><span style="color: orange;">Contact</span> Us</h1>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="row">
						<div class="col-md-8">
							<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3967.3015797444173!2d80.476825!3d6.090014!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x154c2430abe6c51b!2sAmba%20Sewana!5e0!3m2!1sen!2slk!4v1581934357409!5m2!1sen!2slk" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
						</div>
						<div class="col-md-4">
							<form class="mr-4">
							  <div class="form-group">
							  	<input type="text" name="name" class="form-control" placeholder="Name">
							  </div>
							  <div class="form-group">
							  	<input type="Email" name="Email" class="form-control" placeholder="Email">
							  </div>
							 <div class="form-group mt-4">
							  <textarea style="background-color: #e6e6e6; border: none;" class="form-control" rows="5" placeholder="Enter Your Message Here..."></textarea>
							 </div>
							 <button type="submit" class="btn btn-warning" style="color: white;">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section><!-- contact -->

<?php include('inc/footer.php'); ?>