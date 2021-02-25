<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

   <?php 
   $query = "SELECT id, materials FROM materials";
   $result_set = mysqli_query($connection, $query);

   $materials_list='';

   while ($row = mysqli_fetch_assoc($result_set)) {
     $materials_list .= "<option value=\"{$row['id']}\" >{$row['materials']}</option>";
   }
    ?>

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Stock Items</h1>
    <a href="add-stock.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i>Add Items</a>
  </div>

<div class="row">
  <div class="col-md-6 mb-4">
    <small>Sort stock by materials</small>
    <form method="POST" action="stock.php">
    <div class="input-group">
      <select class="custom-select" name="materials_id" id="inputGroupSelect04" aria-label="Example select with button addon">
        <?php echo $materials_list; ?>
      </select>
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" name="mat_button" type="submit">Search</button>
      </div>
    </div>
    </form>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <?php 

    //add message

      if (isset($_GET['delete_stock'])) {
        if ($_GET['delete_stock']) {
          echo '<div class="alert alert-success" role="alert">Stock item deleted successful!</div>';
        }else{
          echo '<div class="alert alert-success" role="alert">Stock item deleted fail!</div>';
        }
      }

      //add message
      if (isset($_GET['add'])) {
        echo '<div class="alert alert-success" role="alert">Stock item added successful!</div>';
      }

      //edit message
      if (isset($_GET['update'])) {
        echo '<div class="alert alert-success" role="alert">Stock item edited successful!</div>';
      }

      //edit message
       if (isset($_GET['update_mat'])) {
        echo '<div class="alert alert-success" role="alert">Stock item materials update successful!</div>';
      }

      if (isset($_GET['update_fail'])) {
        echo '<div class="alert alert-danger" role="alert">Stock item materials update failed!</div>';
      }
      //delete message
      /*if (isset($_GET['delete'])) {
       echo '<div class="alert alert-success" role="alert">materials deleted successful!</div>';
      }*/

     ?>
     <small class="mb-0 text-gray-800"><p style="color: red;">Total number of Stocks : </p></small> 
    <table class="table table-striped">
      <thead>
        <tr>
          <!-- <th scope="col">#</th> -->
          <th scope="col">Stock Name</th>
          <th scope="col">Materials Id</th>
          <th scope="col">Price</th>
          <th scope="col">Qty</th>
          <th scope="col">Operation</th>

        </tr>
      </thead>
      <tbody>
        <?php
        
        $stock = "SELECT stock.id, stock.stock, materials.materials, stock.price,  stock.qty ";
        /*$stock = "SELECT * ";*/
        $stock .= "FROM stock ";
        $stock .= "JOIN materials ";
        $stock .= "ON stock.mat_id = materials.id";
        $result = mysqli_query($connection, $stock);

        while ($row = mysqli_fetch_assoc($result)) {

        ?>
 
        <tr>
          
          <td><?php echo $row['stock']; ?></td>
          <td><?php echo $row['materials']; ?></td>
          <td>Rs.<?php echo $row['price']; ?></td>
          <td><?php echo $row['qty']; ?></td>
          <td><a href="edit-stock.php?stock_id=<?php echo $row['id']; ?>&mat=<?php echo $row['materials']; ?>" class="btn btn-warning ">Edit</a> | <a href="delete-stock.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        

        <?php } ?>
      </tbody>
    </table>
  </div>
</div>



  <?php
include('inc/scripts.php');
include('inc/footer.php');
?>