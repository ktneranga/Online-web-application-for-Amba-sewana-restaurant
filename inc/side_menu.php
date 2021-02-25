<section class="header">
	<div class="side-menu" id="side-menu">
		<ul>
			<li><a href="index.php">Home <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
			<li><a href="">Food Categories <i class="fa fa-angle-right" aria-hidden="true"></a></i>
				<ul>
					<li><a href="foods.php?">All</a></li>
					<?php 
					//get the categories from category table
					$cat_query = "SELECT * FROM category";
					$cat_result = mysqli_query($connection, $cat_query);

					while($row = mysqli_fetch_assoc($cat_result)){

					 ?>
					 <!-- display categories and pass the id and the category name -->
					<li><a href="foods.php?id=<?php echo $row['id'];?>&name=<?php echo $row['category']; ?>"><?php echo $row['category']; ?></a></li>

				<?php } ?>
				</ul>
			</li>
			<li><a href="">My Account <i class="fa fa-angle-right" aria-hidden="true"></i></a>
				<ul>
					<li><a href="myorders.php">My Orders</a></li>
					<li><a href="logout.php" data-toggle="modal" data-target="#error_modal">Log Out</a></li>
				</ul>
			</li>
			<li><a href="track.php">Track Order <i class="fa fa-angle-right" aria-hidden="true"></i></a>
				
			</li>

			<li><a href="reserve.php">Reserve Tables <i class="fa fa-angle-right" aria-hidden="true"></i></a>
				
			</li>

			<li><a href="cart.php">Cart <i class="fa fa-angle-right" aria-hidden="true"></i></a>
				
			</li>

			<li><a href="employeelogin/index.php">Employee Login <i class="fa fa-angle-right" aria-hidden="true"></i></a>
				
			</li>

			<li><a href="contact.php">Contact <i class="fa fa-angle-right" aria-hidden="true"></i></a>
				
			</li>
		</ul>

	</div><!-- side-menu -->
</section>