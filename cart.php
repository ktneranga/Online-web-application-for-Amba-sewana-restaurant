<?php
    session_start();
?>


<?php 
include('inc/connection.php'); 
include('inc/dbcon.php');
include('inc/component.php');

//Remove Item from cart
if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value['id'] == $_POST['id']){
            unset($_SESSION['cart'][$key]);
            echo "<script>alert('Dish is removed from the cart..!')</script>";
            echo "<script>window.location = 'cart.php'</script>";
          }
      }
  }
}
?>

<!-- Create Session 'cart' -->
<?php
if (isset($_GET["add"])){
    $productId = $_GET["id"];
    $productQty = $_GET["quantity"];

    $itemIds = [];
    foreach ($_SESSION['cart'] as $key => $value) {
        $foodId = $value['id'];
        array_push($itemIds, $foodId);
    }

    if (in_array($productId, $itemIds)) {
        echo "<script>alert('This Dish is already in the cart..!')</script>";
        echo "<script>window.location = 'foods.php'</script>";
    }
    else{
        array_push($_SESSION['cart'], array('id' => $productId , 'qty' => $productQty));
        echo "<script>alert('Your Dish is now in the cart..!')</script>";
        echo "<script>window.location = 'foods.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Food Cart</title>

	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- custom css -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/form-style.css">
	<link rel="stylesheet" type="text/css" href="css/style_shoping_table.css">
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
		<li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart

        <!-- add indicator to show how many items in the cart -->
            <?php
                if(!empty($_SESSION['cart'])){
                    $count = count($_SESSION['cart']);
                    echo "<span id='cart_count' class='text-danger bg-light' style='border-radius: 3px;padding:1px;margin-left: 4px;'>$count</span>";
                }else{
                    echo " ";
                }
            ?>
        </a></li>
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

<!-- side-menu -->
<?php include('inc/side_menu.php'); ?>
<!-- side-menu -->

<!-- Shopping cart item table-->

<div class="container-fluid" style="
    padding-bottom: 212px;">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6>My Cart</h6>
                <hr>
                <!-- Get food ditails from DB using sessioin 'cart' -->
                <?php

                    if(!empty($_SESSION['cart'])){
                        
                        $total = 0;
                        
                        if(isset($_SESSION['cart'])){
                            foreach ($_SESSION['cart'] as $key=>$value) {
                                $foodId = $value['id'];
                                $foodQty = $value['qty'];
                                $sql = "SELECT * FROM foods WHERE id = $foodId;";
                                $result = mysqli_query($connection, $sql);
                                $resultCheck = mysqli_num_rows($result);

                                if($resultCheck > 0){
                                    while ($row = mysqli_fetch_assoc($result)){

                                        $productid = $row['id'];
                                        $productname = $row['name'];
                                        $productprice = $row['price'];
                                        $productimg = $row['thumbnail'];
                            
                                        echo "<form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                                                <div class=\"border rounded\">
                                                    <div class=\"row bg-white\">
                                                        <div class=\"col-md-3 pl-0\">
                                                            <img src=img/product/$productimg alt=\"Image1\" class=\"img-fluid\">
                                                        </div>
                                                        <div class=\"col-md-6\">
                                                            <h5 class=\"pt-2\">$productname</h5>
                                                            <small class=\"text-secondary\">Rs. $productprice</small><br/>
                                                            <small class=\"text-secondary\">Quantity : $foodQty</small>
                                                            <input type=\"hidden\" name=\"id\" id=\"id\" value=\"$productid\">
                                                            <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\" style = \"position: relative; left: 340px; bottom: -22px; \">Remove</button>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </form> ";

                                        //calculate total price
                                        $total = $total + (int)$productprice*(int)$foodQty;

                                    }
                                }
                            }
                        }
                    }else{
                        echo "<h3 style = \"margin-left: 379px; margin-top: 80px; \">Cart is empty!</h3>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Display the total price -->
<div style="position: absolute;top: 120px;left: 930px;">

    <?php
        if(!empty($_SESSION['cart'])){
    ?>
    <div class="pt-4">
        <h6>PRICE DETAILS</h6>
        <hr>
        <div class="row price-details">
            <div class="col-md-6">
                <?php
                    if (isset($_SESSION['cart'])){
                        $count  = count($_SESSION['cart']);
                        echo "<h6>Price ($foodQty items)</h6>";
                    }else{
                        echo "<h6>Price (0 items)</h6>";
                    }
                ?>

                <hr><h6>Discount</h6>
                <hr>
                <h6>Amount Payable</h6>

            </div>
            <div class="col-md-6">
                <h6>Rs.   <?php echo $total; ?></h6>
                <hr><h6>Rs.   0</h6>
                <hr>
                <h6>Rs.   <?php echo $total; ?></h6>
            </div>
            <div class="col-md-6"><?php if(!empty($_SESSION['user_id'])){ ?>
                <a href="order.php"><button type="submit" class="btn btn-warning" name="submit" style="position: relative; left: 200px; top: 20px;">Proceed</button></a>              
                <?php }else{ ?>
                <button type="submit" data-toggle="modal" data-target="#loginModal" class="btn btn-warning" name="submit" style="position: relative; left: 200px; top: 20px;">Proceed</button>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php }else 
        echo "<p> </p>";
    ?>
</div>
</body>

<!--end of shopping cart item table-->
<footer><?php include('inc/footer.php'); ?></footer>

</html>