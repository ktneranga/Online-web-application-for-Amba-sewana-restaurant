<!-- update the complete -->
<?php
include('connection.php');

if( !isset($_GET['order_id']) == 0){

  //get the order id from the GET method
  $orderId = $_GET['order_id'];

  //the query for update the 'complete' boolean value to TRUE in order to show that particular order was mark as done
  $done = "UPDATE orders SET complete = 1 WHERE orderid = $orderId;";
  $result = mysqli_query($connection, $done);
  
  if($result){
    //if the query ran successfully show the message and prompt the ongoing orders page
    echo "<script>alert('Order is mark as done')</script>";
    echo "<script>window.location = '../ongoing_orders.php'</script>";
  
}
}
?>


