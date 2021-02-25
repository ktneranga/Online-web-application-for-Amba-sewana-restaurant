<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- insert foods items -->
<?php 

$errors = array();

$food_name = ''; 
$category_id = ''; 
$price = ''; 
$image = ''; 
$description = ''; 
$qty ='';
$uploaded = '';
$file_name = '';
$file_type = '';
$file_size = '';
$temp_name = '';
$upload_to = '';


if (isset($_POST['food-submit'])) {
 /* echo "<pre>";
  print_r($_FILES);
  echo "</pre>";*/

  $food_name = $_POST['food_name'];
  $category_id = $_POST['category_id'];
  $price = $_POST['price'];
  $description = $_POST['description']; 
  $qty = $_POST['qty'];
  $image = $_FILES['image'];

  $file_name = $_FILES['image']['name'];
  $file_type = $_FILES['image']['type'];
  $file_size = $_FILES['image']['size'];
  $temp_name = $_FILES['image']['tmp_name'];

  $upload_to = '../img/product/';

 /* $image_upload = 'img/product/';*/

  //checking the file type
  if ($file_type != 'image/jpeg') {
    $errors[] = 'Only JPEG files are allowed';
  }

  //checking file soize
  if ($file_size>500000) {
    $errors[] = 'File size should be less than 500KB';
  }

  //checking required fields
  $req_fields = array('food_name','category_id', 'price','description','qty');

  foreach ($req_fields as  $field) {
      if (empty(trim($_POST[$field]))) {
      $errors[] = $field.' is required.';
    }
  }

  //checking if food item address already exist

  $food = mysqli_real_escape_string($connection, $_POST['food_name']);

  $query = "SELECT * FROM foods WHERE name = '{$food}' LIMIT 1";

  $result_set = mysqli_query($connection, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set)==1) {
      $errors[] = 'Food item already exists.';
    }
  }

  //if no errors, enter data into the DB

  if (empty($errors)) {
    //Upload image
    $uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
    //sanitize the fields
    $food_name = mysqli_real_escape_string($connection, $_POST['food_name']);
    $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $qty = mysqli_real_escape_string($connection, $_POST['qty']);
    $thumbnail = /*'img/product/'.*/$file_name;
   

    $query = "INSERT INTO foods (name, cat_id, price, thumbnail, description, qty) VALUES('{$food_name}',{$category_id},'{$price}','{$thumbnail}', '{$description}', {$qty})";

    $result = mysqli_query($connection, $query);

    if ($result) {
      //query successfull...user added true
      $msg = 'Successfully added the food';
      echo "<script type='text/javascript'>alert('$msg');</script>";
      /*header('Location:foods.php?add=true');*/
    }else{
      $errors[] = 'Failed to add food item.';
    }

  }

}



 ?>

<!-- getting category details -->
<?php 
   $query = "SELECT id, category FROM category";
   $result_set = mysqli_query($connection, $query);

   $category_list='';

   while ($row = mysqli_fetch_assoc($result_set)) {
     $category_list .= "<option value=\"{$row['id']}\" >{$row['category']}</option>";
   }
?>


<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Foods</h1>
    <a href="foods.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-chevron-circle-left fa-sm text-white-50"></i> Back to Foods</a>
  </div>


  <div class="row">
    <div class="col-12">
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
      <form method="POST" enctype="multipart/form-data" action="add-food.php"> 
        <div class="form-group">
          <label for="formGroupExampleInput">Enter Food Name</label>
          <input type="text" name="food_name" class="form-control" id="formGroupExampleInput" placeholder="Food Name" <?php echo 'value="'.$food_name.'"'; ?>>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Enter Description</label>
          <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" <?php echo 'value="'.$description.'"'; ?>></textarea>
        </div>
        <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Price</label>
          <!-- <input type="text" class="form-control" id="inputEmail4" placeholder="Price"> -->
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Rs. </div>
            </div>
            <input type="text" name="price" class="form-control" id="inlineFormInputGroup" placeholder="Price" <?php echo 'value="'.$price.'"'; ?>>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Quantity</label>
          <input type="text" name="qty" class="form-control" id="inputPassword4" placeholder="Quantity" <?php echo 'value="'.$qty.'"'; ?>>
        </div>

        <label for="inputPassword4">Select the category</label>
        <div class="input-group">
          <select class="custom-select" name="category_id" id="inputGroupSelect04" aria-label="Example select with button addon">
            <option value=" " >No category</option>
            <?php echo $category_list; ?>
          </select>
        </div>

        <div class="form-group col-md-6">
          <br>
          <label for="exampleFormControlFile1">Upload Food Image (Note : Jpeg files less than 500kb only)</label>
          <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1"> 
        </div>
        <div class="col-md-6">
          <?php 

            if ($uploaded) {
              echo '<img src = "'.$upload_to . $file_name.'" style="width: 250px; height: 200px;" class="m-5">';
            }

           ?>
        </div>

      </div>
      <button type="submit" name="food-submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>


<?php
include('inc/scripts.php');
include('inc/footer.php');
?>