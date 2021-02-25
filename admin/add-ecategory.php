<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>



<?php 

$errors = array();

$category_name = ''; 

if (isset($_POST['category_submit'])) {

  $category_name = $_POST['category_name'];

  //checking required fields

  if (empty(trim($_POST['category_name']))) {
    $errors[] = 'Please enter category';
  }


  //checking if category address already exist

  $cat = mysqli_real_escape_string($connection, $_POST['category_name']);

  $query = "SELECT * FROM ecategory WHERE category = '{$cat}' LIMIT 1";

  $result_set = mysqli_query($connection, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set)==1) {
      $errors[] = 'Category already exists.';
    }
  }

  //if no errors, enter data into the DB

  if (empty($errors)) {
    //sanitize the fields
    $cat_name = mysqli_real_escape_string($connection, $_POST['category_name']);
    

    $query = "INSERT INTO ecategory (category) VALUES('{$cat_name}')";

    $result = mysqli_query($connection, $query);

    if ($result) {
      //query successfull...category added true
      $msg = 'Successfully added the ecategory';
      echo "<script type='text/javascript'>alert('$msg');</script>";
      header('Location:ecategory.php?status=true');
    }else{
      $errors[] = 'Failed to add the ecategory!';
    }

  }

}



 ?>



<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Category</h1>
    <a href="category.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-chevron-circle-left fa-sm text-white-50"></i> Back to Categories</a>
      
  </div>

  <div class="row">
    <div class="col-12">
        <form method="POST" action="add-ecategory.php">
        <div class="form-group">
        <label for="exampleInputEmail1">Enter Category Name</label>
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
        <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category Name">
      </div>
      <button type="submit" name="category_submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>


<?php
include('inc/scripts.php');
include('inc/footer.php');
?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
