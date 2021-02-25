<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Foods Management</h1>
    <a href="add-food.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i>Add Foods</a>
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
          echo '<div class="alert alert-success" role="alert">Food item was permenently removed!</div>';
        }else{
          echo '<div class="alert alert-danger" role="alert">Food item removed fail!</div>';
        }
      }

      //available message
      if (isset($_GET['available_food'])) {
        if ($_GET['available_food']) {
          echo '<div class="alert alert-success" role="alert">The food item was restored!</div>';
        }else{
          echo '<div class="alert alert-danger" role="alert">Food item restored fail!</div>';
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

     ?>
     <small class="mb-0 text-gray-800"><p style="color: red;">Total number of foods :</p></small> 
     
    <!-- food search form-->
    <?php 
      $search = '';
     ?>
     <div class="search col-12">
      <div class="row mb-3"> 
       <form method="GET" action="foods.php" class="col-md-11">
          <input type="text" name="search" class="form-control" value="<?php echo $search; ?>" placeholder="Enter food name or category and press enter" autofocus>
       </form>
       <a href="foods.php" class="col-md-1 btn btn-primary">Refresh</a>
      </div>
     </div>
     <!-- food search form-->

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
          <th scope="col">Comments</th>
        </tr>
      </thead>
      <tbody>
        <?php

        //search function
        if (isset($_GET['search'])) {
          $search = mysqli_real_escape_string($connection, $_GET['search']);

          $foods = "SELECT foods.id, foods.name, category.category, foods.price, foods.thumbnail, foods.description, foods.qty, foods.is_available ";
          $foods .= "FROM foods ";
          $foods .= "JOIN category ";
          $foods .= "ON foods.cat_id = category.id ";
          $foods .= "WHERE (foods.name LIKE '%{$search}%' OR category.category LIKE '%{$search}%') AND is_available = 0";
        }else{

          $foods = "SELECT foods.id, foods.name, category.category, foods.price, foods.thumbnail, foods.description, foods.qty, foods.is_available ";
          $foods .= "FROM foods ";
          $foods .= "JOIN category ";
          $foods .= "ON foods.cat_id = category.id ";
          $foods .= "WHERE is_available = 0";
        }
        
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
          <td><a href="edit-food.php?food_id=<?php echo $row['id']; ?>&cat=<?php echo $row['category']; ?>" class="btn btn-warning ">Edit</a> | <a href="is_available_food.php?unavailable_id=<?php echo $row['id']; ?>" class="btn btn-danger">Unavailable</a></td>
          <td><a href="comments.php?food_id=<?php echo $row['id']; ?>" class="btn btn-dark">Check <span class="badge badge-danger">
            
            <?php 


              $comment_query = "SELECT * FROM reviews WHERE pid = {$row['id']}";
              $comment_result = mysqli_query($connection, $comment_query);

              if ($comment_result) {
                echo mysqli_num_rows($comment_result);
              }
              
             ?>

          </span></a></td>
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