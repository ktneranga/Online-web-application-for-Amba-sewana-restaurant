<!-- Insert the order details into db -->
<?php
session_start();
include('connection.php');
include('dbcon.php');
if(isset($_GET['total'])){
  
  $user = $_SESSION['user_id'];
  $price = $_GET['total'];

if(isset($_SESSION['cart'])){

  foreach ($_SESSION['cart'] as $key=>$value) {
    $foodId = $value['id'];
    $foodQty = $value['qty'];
    $sql = "INSERT INTO orders(userid, fid, qty, price, complete, cancel) VALUES ($user, $foodId, $foodQty, $price, 0, 0);";
    $result = mysqli_query($connection, $sql);

    if($result){
      echo "<script>alert('Your foods are on the way')</script>";
      echo "<script>window.location = '../foods.php'</script>";
      unset ($_SESSION['cart']);
      

    }
  }
}else{
  echo "Error in session";
}
}
?>