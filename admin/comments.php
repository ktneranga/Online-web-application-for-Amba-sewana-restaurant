<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<?php 

$food_id = '';

if (isset($_GET['food_id'])) {
  $food_id = $_GET['food_id'];
}

 ?>

<!-- Begin Page Content -->
<div class="container-fluid">


  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Comments Management</h1>
    <a href="foods.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-chevron-circle-left fa-sm text-white-50"></i>Back to foods</a>
  </div>

<div class="row">
  <div class="col-12">
    <?php 

     //delete comment
      if (isset($_GET['delete_com'])) {
        if ($_GET['delete_com']) {
          echo '<div class="alert alert-success" role="alert">Comment deleted!</div>';
        }else{
          echo '<div class="alert alert-success" role="alert">Comment deleted!</div>';
        }
      }

     ?>
     <small class="mb-0 text-gray-800"><p style="color: red;">Total number of foods : </p></small> 
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Customer Name</th>
          <th scope="col">Comments</th>
          <th scope="col">Date & Time</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $comment_query = "SELECT * FROM reviews WHERE pid = '{$food_id}'";
        $result_set = mysqli_query($connection, $comment_query);         
        while ($row = mysqli_fetch_assoc($result_set)) {

        ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Read Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <?php echo $row['review']; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->

          <th scope="row"><?php echo $row['id']; ?></th>
          <td><?php echo $row['name']; ?></td>
          <td><a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row['id']; ?>">Read</a></td>
          <td><?php echo $row['timestamp']; ?></td>
          <!-- <td>Rs.<?php /*echo $row['price'];*/ ?></td> -->
         <!--  <td><?php /*echo $row['qty'];*/ ?></td> -->
          <td><a href="delete-comment.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
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