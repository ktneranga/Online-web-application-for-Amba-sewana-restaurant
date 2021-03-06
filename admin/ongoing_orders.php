<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ongoing Orders</h1>
    
  </div>

<div class="row">
  <div class="col-12">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Order ID</th>
      <th scope="col">User ID</th>
      <th scope="col">Total Price</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>
    <?php 

    $ord = "SELECT * FROM orders";
    $result = mysqli_query($connection, $ord);

    while ($row = mysqli_fetch_assoc($result)) {

      if($row['complete'] == 0 && $row['cancel'] == 0){
    ?>
    <tr>
      <th scope="row"><?php echo $row['orderid']; ?></th>
      <td><?php echo $row['userid']; ?></td>
      <td>Rs. <?php echo number_format(($row['price']),2); ?></td>
      <td><a href="inc/order_done.php?order_id=<?php echo $row['orderid'] ?>" class="btn btn-warning " >Mark as Done</a> | <button data-toggle="modal" data-target="#orderModal<?php echo $row['orderid'] ?>" class="btn btn-facebook" >More</button></td>
    </tr>
    <?php include('inc/orderinfo_modal.php'); ?>

   
</div>
    <?php } } ?>
  </tbody>
</table>
  </div>
</div>




  <?php
include('inc/scripts.php');
include('inc/footer.php');
?>