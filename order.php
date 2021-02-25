<?php
    session_start();
?>
<?php 
include('inc/connection.php'); 
include('inc/dbcon.php');
include('inc/component.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Order</title>

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

                <!-- Get food ditails from DB using sessioin 'cart' -->
                <?php

                    
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Order details -->

<div style="top: -220px;position: relative; left: 182px; width: 950px;">
    <div class="pt-4">
        <h6>ORDER DETAILS</h6>
        <hr>
        <div class="row price-details">
            <div class="clear-fix"></div>
            <table border='1' cellspacing='0'>
                <tr>
                    <th width=250>Food dish</th>
                    <th width=80>Amount</th>
                    <th width=100>Unit price</th>
                    <th width=100>Total price</th>
                </tr>
 
                    <?php
                        
                        $total = 0;
                        //get order details into a table using session cart
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
                            
                                        //calculate total price
                                        $total = $total + (int)$productprice*(int)$foodQty;

                                        echo("<tr>");
                                        echo("<td>$productname</td>");
                                        echo("<td class='text-center'>$foodQty</td>");
                                        echo("<td class='text-right'>Rs: $productprice</td>");
                                        echo("<td class='text-right'>Rs: $total</td>");
                                        echo("</tr>");

                                    }
                                }
                            }
                        }
             
                        echo("<tr>");
                        echo("<td colspan='3' class='text-right'><b>TOTAL</b></td>");
                        echo("<td class='text-right'><b>Rs: " . number_format(($total),2) . "</b></td>");
                        echo("</tr>");
                    ?>
            </table>
        </div>
            <div class="col-md-6">
                <a href = "inc/order_scc.php?total=<?php echo $total?>"><button  type="submit"  class="btn btn-danger" name="submit" style="position: relative; left: 410px; top: 45px;">Place the order</button></a>
            </div>
        </div>
    </div>
</div>


</body>

<!--end of shopping cart item table-->
<footer><?php include('inc/footer.php'); ?></footer>
</html>