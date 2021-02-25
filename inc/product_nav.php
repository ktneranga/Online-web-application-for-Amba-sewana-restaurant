<!DOCTYPE html>
<html>
<head>
	<title>Product Page</title>

	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- custom css -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/form-style.css">

	<!-- bootstrap css links -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- font awesome cdn -->
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- slick css -->
  	<link rel="stylesheet" type="text/css" href="css/slick.css">

	<style type="text/css">
		#menu-btn{
			display: inline;
		}
		.side-menu{
			z-index: 20;
			/*top: 133px;*/
			position: fixed;
			/*font-size: 12px;*/
			display: none;
			box-shadow: 1px 1px 4px 1px rgba(0,0,0,0.9);
		}
	</style>

</head>
<body>

<?php 

      ob_start();
      $_PERINTAH = shell_exec('ipconfig /all');
      ob_clean();

      $_PECAH = strpos($_PERINTAH, "Physical");
      $mac = substr($_PERINTAH, ($_PECAH+36),17);
      $mac_address = str_replace('-', ':', $mac);

     ?>


<div class="top-nav-bar">
	<div class="search-box">
		<i class="fa fa-bars" aria-hidden="true" id="menu-btn" onclick="openmenu()"></i>
		<i class="fa fa-times" aria-hidden="true" id="close-btn" onclick="closemenu()"></i>
		<a href="index.php" title="Home"><img src="img/logo/logo1.png" class="logo"></a>
		<!-- <h2 class="logo">Amba Sewana</h2> -->
		<!-- <input type="text" name="search-box" class="form-control">
		</a><span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span> -->
	</div><!-- search-box -->
<div class="menu-bar">
	<ul>
		<li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a></li>
    <?php if (!empty($_SESSION['user_id'])) { ?>
      <!-- loged in user items go here -->
      <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i> Hi <?php echo $_SESSION['first_name']; ?></a></li>
    <?php } else{ ?>
      <!-- non logged in user items go here -->  
		  <li><a href="#" data-toggle="modal" data-target="#loginModal"><i class="fa fa-sign-in" aria-hidden="true"></i> Log In</a></li>
     <?php } ?>

     <?php if (!empty($_SESSION['user_id'])) { ?>
      <!-- loged in user items go here -->
      <li><a href="logout.php" data-toggle="modal" data-target="#error_modal"><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</a></li> 
    <?php } else{ ?>
      <!-- non logged in user items go here -->  
      <li><a href="#" data-toggle="modal" data-target="#registerModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up</a></li>
     <?php } ?>

		
	</ul>
</div><!-- menu-bar -->
</div><!-- top-nav-bar -->

<!-- login modal start -->
<?php include('inc/login_modal.php'); ?>
<!-- login modal end -->

<?php include('inc/logout_error.php'); ?>

<!-- sign up modal start -->
<?php include('inc/register_modal.php'); ?>
<!-- sign up moda end -->

