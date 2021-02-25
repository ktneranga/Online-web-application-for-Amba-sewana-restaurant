<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<?php 

$errors = array();
$category_id = '';
$category_name = '';

//check if the cat id has passed
if (isset($_GET['cat_id'])) {
   //getting the category information
    $category_id = mysqli_real_escape_string($connection, $_GET['cat_id']);
    $query = "SELECT * FROM category WHERE id = {$category_id} LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if($result_set){
      if (mysqli_num_rows($result_set)==1) {
        //category found
        $result = mysqli_fetch_assoc($result_set);
        $category_name = $result['category'];
      }else{
        //category not found
        header('Location:category.php?err=category_not_found');
      }
    }else{
      //query failed
      header('Location:category.php?err=query_failed');
    }

} 
/*-------------------------------------------------------------*/
if (isset($_POST['category_submit'])) {
  $cat_id = $_POST['cat_id'];
  $category_name = $_POST['category_name'];

  //checking required fields
  if (empty(trim($_POST['category_name']))) {
    $errors[] = 'Please enter category';
  }

  //checking if category address already exist
  $cat = mysqli_real_escape_string($connection, $_POST['category_name']);
  $query = "SELECT * FROM category WHERE category = '{$cat}' /*AND id != {$cat_id}*/ LIMIT 1";

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
    
    //query goes here
    $update_cat = "UPDATE category SET category = '{$cat_name}' WHERE id = {$cat_id} LIMIT 1";


    $result = mysqli_query($connection, $update_cat);

    if ($result) {
      //query successfull...category added true
      $msg = 'Successfully Edited the category';
      echo "<script type='text/javascript'>alert('$msg');</script>";
      header('Location:category.php?update=true');
    }else{
      $errors[] = 'Failed to edit the category!';
    }

  }

}

 ?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
    <a href="category.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-chevron-circle-left fa-sm text-white-50"></i> Back to Categories</a>
  </div>

  <div class="row">
    <div class="col-12">
      <form method="POST" action="edit-category.php">
        <input type="hidden" name="cat_id" value=" <?php echo $category_id; ?> ">
        <div class="form-group">
        <label for="exampleInputEmail1">Edit Category Name</label>

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

        <input type="text" class="form-control" name="category_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category Name" <?php echo 'value= "'.$category_name.'"'; ?>>
        </div>
        <button type="submit" name="category_submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>

<?php
include('inc/scripts.php');
include('inc/footer.php');
?>