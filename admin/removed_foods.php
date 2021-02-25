<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

   <?php 
   $query = "SELECT id, category FROM category";
   $result_set = mysqli_query($connection, $query);

   $category_list='';

   while ($row = mysqli_fetch_assoc($result_set)) {
     $category_list .= "<option value=\"{$row['id']}\" >{$row['category']}</option>";
   }
    ?>

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Foods Management</h1>
    <a href="add-food.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i>Add Foods</a>
  </div>

<div class="row">
  <div class="col-md-6 mb-4">
    <small>Sort foods by category</small>
    <form method="POST" action="foods.php">
    <div class="input-group">
      <select class="custom-select" name="category_id" id="inputGroupSelect04" aria-label="Example select with button addon">
        <?php echo $category_list; ?>
      </select>
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" name="cat_button" type="submit">Search</button>
      </div>
    </div>
    </form>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <?php 

    //add message
      if (isset($_GET['delete_com'])) {
        if ($_GET['delete_com']) {
          echo '<div class="alert alert-success" role="alert">Comment deleted!</div>';
        }else{
          echo '<div class="alert alert-danger" role="alert">Comment deleted failed!</div>';
        }
      }

      if (isset($_GET['delete_food'])) {
        if ($_GET['delete_food']) {
          echo '<div class="alert alert-success" role="alert">Food item removed successful!</div>';
        }else{
          echo '<div class="alert alert-danger" role="alert">Food item removed fail!</div>';
        }
      }

      //unavailable message
      if (isset($_GET['unavailable_food'])) {
        if ($_GET['unavailable_food']) {
          echo '<div class="alert alert-success" role="alert">The food item was temporarily removed!</div>';
        }else{
          echo '<div class="alert alert-danger" role="alert">Food item removed fail!</div>';
        }
      }

      //add message
      if (isset($_GET['add'])) {
        echo '<div class="alert alert-success" role="alert">Food item added successful!</div>';
      }

      //edit message
      if (isset($_GET['update'])) {
        echo '<div class="alert alert-success" role="alert">Food item edited successful!</div>';
      }

      if (isset($_GET['update_image'])) {
        echo '<div class="alert alert-success" role="alert">Food item image updated successful!</div>';
      }

      //edit message
       if (isset($_GET['update_cat'])) {
        echo '<div class="alert alert-success" role="alert">Food item category update successful!</div>';
      }

      if (isset($_GET['update_fail'])) {
        echo '<div class="alert alert-danger" role="alert">Food item category update failed!</div>';
      }



      //delete message
      /*if (isset($_GET['delete'])) {
       echo '<div class="alert alert-success" role="alert">Category deleted successful!</div>';
      }*/

     ?>
     <small class="mb-0 text-gray-800"><p style="color: red;">Total number of foods : </p></small> 
    <table class="table table-striped">
      <thead>
        <tr>
          <!-- <th scope="col">#</th> -->
          <th scope="col">Food Name</th>
          <th scope="col">Food Image</th>
          <th scope="col">Category</th>
          <th scope="col">Price</th>
          <th scope="col">Qty</th>
          <th scope="col">Description</th>
          <th scope="col">Operation</th>
        </tr>
      </thead>
      <tbody>
        <?php
        
        $foods = "SELECT foods.id, foods.name, category.category, foods.price, foods.thumbnail, foods.description, foods.qty, foods.is_available ";
        /*$foods = "SELECT * ";*/
        $foods .= "FROM foods ";
        $foods .= "JOIN category ";
        $foods .= "ON foods.cat_id = category.id ";
        $foods .= "WHERE is_available = 1";
        $result = mysqli_query($connection, $foods);

        while ($row = mysqli_fetch_assoc($result)) {

        ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Food Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <?php echo $row['description']; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <tr>
          
          <td><?php echo $row['name']; ?></td>
          <td><img src="../img/product/<?php echo $row['thumbnail']; ?>" style="width: 60px; height: 50px;"></td>
          <td><?php echo $row['category']; ?></td>
          <td>Rs.<?php echo $row['price']; ?></td>
          <td><?php echo $row['qty']; ?></td>
          <td><a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row['id']; ?>">Desc:</a></td>
          <td><a href="delete-food.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a> | <a href="is_available_food.php?available_id=<?php echo $row['id']; ?>" class="btn btn-success">Restore</a></td>
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