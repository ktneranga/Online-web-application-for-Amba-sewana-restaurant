<!-- delete the order info from db -->

<?php
include('connection.php');

if( !isset($_GET['order_id']) == 0){

  //get the order id from the GET method
  $orderId = $_GET['order_id'];

  //the query for delete the order info where orderid equal to the value that gets from the GET method
  $done = "DELETE FROM orders WHERE orderid = $orderId;";
  $result = mysqli_query($connection, $done);
  
  if($result){

    //if the query ran successfully show the message and prompt the Canceled orders page
    echo "<script>alert('The order deleted')</script>";
    echo "<script>window.location = '../canceled_orders.php'</script>";
  
}
}
?>