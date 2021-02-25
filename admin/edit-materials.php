<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<?php 

$errors = array();

$materials_id = '';
$materials_name = '';


//check if the mat id has passed
if (isset($_GET['mat_id'])) {
   //getting the materials information
    $materials_id = mysqli_real_escape_string($connection, $_GET['mat_id']);
    $query = "SELECT * FROM materials WHERE id = {$materials_id} LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if($result_set){
      if (mysqli_num_rows($result_set)==1) {
        //materials found
        $result = mysqli_fetch_assoc($result_set);
        $materials_name = $result['materials'];
      }else{
        //materials not found
        header('Location:materials.php?err=materials_not_found');
      }
    }else{
      //query failed
      header('Location:materials.php?err=query_failed');
    }

} 
/*-------------------------------------------------------------*/
if (isset($_POST['materials_submit'])) {
  $mat_id = $_POST['mat_id'];
  $materials_name = $_POST['materials_name'];

  //checking required fields
  if (empty(trim($_POST['materials_name']))) {
    $errors[] = 'Please enter materials';
  }

  //checking if materials address already exist
  $mat = mysqli_real_escape_string($connection, $_POST['materials_name']);
  $query = "SELECT * FROM materials WHERE materials = '{$mat}' /*AND id != {$mat_id}*/ LIMIT 1";

  $result_set = mysqli_query($connection, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set)==1) {
      $errors[] = 'materials already exists.';
    }
  }

  //if no errors, enter data into the DB

  if (empty($errors)) {
    //sanitize the fields
    $mat_name = mysqli_real_escape_string($connection, $_POST['materials_name']);
    
    //query goes here
    $update_mat = "UPDATE materials SET materials = '{$mat_name}' WHERE id = {$mat_id} LIMIT 1";


    $result = mysqli_query($connection, $update_mat);

    if ($result) {
      //query successfull...materials added true
      $msg = 'Successfully Edited the materials';
      echo "<script type='text/javascript'>alert('$msg');</script>";
      header('Location:materials.php?update=true');
    }else{
      $errors[] = 'Failed to edit the materials!';
    }

  }

}

 ?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Materials</h1>
    <a href="supplier.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-chevron-circle-left fa-sm text-white-50"></i> Go to supplier</a>
  </div>

  <div class="row">
    <div class="col-12">
      <form method="POST" action="edit-materials.php">
        <input type="hidden" name="mat_id" value=" <?php echo $materials_id; ?> ">
        <div class="form-group">
        <label for="exampleInputEmail1">Edit Materials Name</label>

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

        <input type="text" class="form-control" name="materials_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Materials Name" <?php echo 'value= "'.$materials_name.'"'; ?>>
        </div>
        <button type="submit" name="materials_submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>

<?php
include('inc/scripts.php');
include('inc/footer.php');
?>