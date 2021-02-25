<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- insert foods items -->
<?php 

$errors = array();

$food_id;
$food_cat = '';
$food_category = '';
$category_id = ''; 
$price = ''; 
$image = ''; 
$description = ''; 
$qty ;
$uploaded = '';
$file_name = '';
$file_type = '';
$file_size = '';
$temp_name = '';
$upload_to = '';
$food_item ;


//checking if the food id has passed
if (isset($_GET['food_id'])&&($_GET['cat'])) {
  //getting the food item details
  $food_id = mysqli_real_escape_string($connection, $_GET['food_id']);
  $food_cat = mysqli_real_escape_string($connection, $_GET['cat']);
  $food_query = "SELECT * FROM foods WHERE id = {$food_id} LIMIT 1";
  $food_result = mysqli_query($connection, $food_query);

  if ($food_result) {
    if (mysqli_num_rows($food_result)==1) {
      //valid food item found
      $food_result_set = mysqli_fetch_assoc($food_result);
      $food_name = $food_result_set['name'];
      $description = $food_result_set['description'];
      $price = $food_result_set['price'];
      $qty = $food_result_set['qty'];
      //$file_name = $food_result_set['thumbnail'];

    }
  }

}

if (isset($_POST['food-submit'])) {
 /* echo "<pre>";
  print_r($_FILES);
  echo "</pre>";*/
  $food_item = $_POST['food_item'];
  $food_name = $_POST['food_name'];
  //$category_id = $_POST['category_id'];
  $price = $_POST['price'];
  $description = $_POST['description']; 
  $qty = $_POST['qty'];

  //checking required fields
  $req_fields = array('food_name', 'price','description','qty');

  foreach ($req_fields as  $field) {
      if (empty(trim($_POST[$field]))) {
      $errors[] = $field.' is required.';
    }
  }

  //checking if food item address already exist
  $food = mysqli_real_escape_string($connection, $_POST['food_name']);
  $query = "SELECT * FROM foods WHERE name = '{$food}' AND id != {$food_item} LIMIT 1";

  $result_set = mysqli_query($connection, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set)==1) {
      $errors[] = 'Updated food item already exists.';
    }
  }

  //if no errors, enter data into the DB

  if (empty($errors)) {
    //Upload image
    //$uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
    //sanitize the fields
    $food_name = mysqli_real_escape_string($connection, $_POST['food_name']);
    $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $qty = mysqli_real_escape_string($connection, $_POST['qty']);
   

    $query = "UPDATE foods SET ";
    $query .= "name = '{$food_name}', ";  
    $query .= "price = '{$price}', ";  
    $query .= "description = '{$description}', "; 
    $query .= "qty = {$qty} "; 
    $query .= "WHERE id = {$food_item} LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {
      //query successfull...user added true
      header('Location:foods.php?update=true');
    }else{
      $errors[] = 'Failed to edit food item.';
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
    <h1 class="h3 mb-0 text-gray-800">Edit Food Item</h1>
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
      <form method="POST" enctype="multipart/form-data" action="edit-food.php"> 
        <div class="form-group">
          <label for="formGroupExampleInput">Enter Food Name</label>
          <input type="hidden" name="food_item" value="<?php echo $food_id; ?>">
          <input type="text" name="food_name" class="form-control" id="formGroupExampleInput" placeholder="Food Name" <?php echo 'value= "'.$food_name.'"'; ?>>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Enter Description</label>
          <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" ><?php echo $description ?></textarea>
        </div>
        <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Price</label>
          <!-- <input type="text" class="form-control" id="inputEmail4" placeholder="Price"> -->
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Rs. </div>
            </div>
            <input type="text" name="price" class="form-control" id="inlineFormInputGroup" placeholder="Price" <?php echo 'value= "'.$price.'"'; ?>>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Quantity</label>
          <input type="text" name="qty" class="form-control" id="inputPassword4" placeholder="Quantity" <?php echo 'value= "'.$qty.'"'; ?>>
        </div>

        <!-- <label for="inputPassword4">Select the category</label>
        <div class="input-group">
          <select class="custom-select" name="category_id" id="inputGroupSelect04" aria-label="Example select with button addon"> -->
            <!-- <option value=" " ><?php/* echo $food_cat;*/ ?></option> -->
           <!--  <?php /*echo $category_list;*/ ?>
          </select>
        </div> -->

        <!-- <div class="form-group col-md-6">
          <br>
          <label for="exampleFormControlFile1">Upload Food Image (Note : Jpeg files less than 500kb only)</label>
          <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1"> 
        </div>
        <div class="col-md-6">
          <?php 

            /*if ($uploaded) {
              
              echo '<img src = "'.$upload_to . $file_name.'" style="width: 250px; height: 200px;" class="m-5">';
            }
*/
           ?>
        </div> -->

      </div>
      <button type="submit" name="food-submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-12 text-center">
      <a href="update-category.php?food_id=<?php echo $food_id?>" class="btn btn-danger">Update category</a>
      <a href="update-image.php?food_id=<?php echo $food_id ?>" class="btn btn-danger">Update Image</a>
    </div>
  </div>


<?php
include('inc/scripts.php');
include('inc/footer.php');
?>