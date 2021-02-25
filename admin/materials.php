<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <?php 

      $numrows = "SELECT * FROM materials";
      $numrows_result = mysqli_query($connection, $numrows);

      if ($numrows_result) {
        $rows = mysqli_num_rows($numrows_result);
      }

   ?>

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Food Materials</h1>
    <a href="add-materials.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Add Materials</a>
  </div>


<div class="row">
  <div class="col-12">
    <?php 

      //add message
      if (isset($_GET['status'])) {
        echo '<div class="alert alert-success" role="alert">Materials added successful!</div>';
      }

      //edit message
      if (isset($_GET['update'])) {
        echo '<div class="alert alert-success" role="alert">Materials edited successful!</div>';
      }

      //delete message
      if (isset($_GET['delete'])) {
       echo '<div class="alert alert-success" role="alert">Materials deleted successful!</div>';
      }

     ?>
     <small class="mb-0 text-gray-800"><p style="color: red;">Total number of materials : <?php echo $rows; ?></p></small> 
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Materials Name</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>
    <?php 

    $materials = "SELECT * FROM materials";
    $result = mysqli_query($connection, $materials);

    while ($row = mysqli_fetch_assoc($result)) {
    

    ?>
    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['materials']; ?></td>
      <td><a href="edit-materials.php?mat_id=<?php echo $row['id']; ?>" class="btn btn-warning ">Edit</a> | <a href="delete-materials.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
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