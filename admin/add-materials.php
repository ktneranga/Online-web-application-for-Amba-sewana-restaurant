<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>



<?php 

$errors = array();

$materials_name = ''; 

if (isset($_POST['materials_submit'])) {

  $materials_name = $_POST['materials_name'];

  //checking required fields

  if (empty(trim($_POST['materials_name']))) {
    $errors[] = 'Please enter materials';
  }


  //checking if materials address already exist

  $mat = mysqli_real_escape_string($connection, $_POST['materials_name']);

  $query = "SELECT * FROM materials WHERE materials = '{$mat}' LIMIT 1";

  $result_set = mysqli_query($connection, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set)==1) {
      $errors[] = 'Materials already exists.';
    }
  }

  //if no errors, enter data into the DB

  if (empty($errors)) {
    //sanitize the fields
    $mat_name = mysqli_real_escape_string($connection, $_POST['materials_name']);
    

    $query = "INSERT INTO materials (materials) VALUES('{$mat_name}')";

    $result = mysqli_query($connection, $query);

    if ($result) {
      //query successfull...materials added true
      $msg = 'Successfully added the materials';
      echo "<script type='text/javascript'>alert('$msg');</script>";
      header('Location:materials.php?status=true');
    }else{
      $errors[] = 'Failed to add the materials!';
    }

  }

}



 ?>



<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Materials</h1>
    <a href="supplier.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-chevron-circle-left fa-sm text-white-50"></i> Go to supplier</a>
      
  </div>

  <div class="row">
    <div class="col-12">
      <form method="POST" action="add-materials.php">
        <div class="form-group">
        <label for="exampleInputEmail1">Enter Materials Name</label>
        <?php 

        if (!empty($errors)) {
          echo "<div class='errmsg' style='color:red;'>";
          echo '<div class="alert alert-danger" role="alert">There were error(s)</div>';
          foreach ($errors  as $error) {
            echo "- ".$error."<br>";
          }
          echo "</div>";
          /*$msg = 'There were error(s) on your form please re enter your credentials!';
          echo "<script type='text/javascript'>alert('$msg');</script>";*/
        }


         ?>
        <input type="text" name="materials_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="materials Name">
      </div>
      <button type="submit" name="materials_submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>


<?php
include('inc/scripts.php');
include('inc/footer.php');
?>