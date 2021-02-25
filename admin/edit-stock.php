<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- insert foods items -->
<?php 

$errors = array();

$stock_name= ''; 
$materials_id = ''; 
$price = ''; 
$qty ='';
$stock_item;

//checking if the stock id has passed
if (isset($_GET['stock_id'])&&($_GET['mat'])) {
  //getting the stock item details
  $stock_id = mysqli_real_escape_string($connection, $_GET['stock_id']);
  $stock_query = "SELECT * FROM stock WHERE id = {$stock_id} LIMIT 1";
  $stock_result = mysqli_query($connection, $stock_query);

  if ($stock_result) {
    if (mysqli_num_rows($stock_result)==1) {
      //valid stock item found
      $stock_result_set = mysqli_fetch_assoc($stock_result);
      $stock_name = $stock_result_set['stock'];
      $price = $stock_result_set['price'];
      $qty = $stock_result_set['qty'];

    }
  }

}

if (isset($_POST['stock-submit'])) {
 /* echo "<pre>";
  print_r($_FILES);
  echo "</pre>";*/
  $stock_item = $_POST['stock_item'];
  $stock_name = $_POST['stock_name'];
  $price = $_POST['price']; 
  $qty = $_POST['qty'];
 
  //checking required fields
  $req_fields = array('stock_name',/*'materials_id',*/ 'price','qty');

  foreach ($req_fields as  $field) {
      if (empty(trim($_POST[$field]))) {
      $errors[] = $field.' is required.';
    }
  }

  //checking if stock item address already exist
  $stock = mysqli_real_escape_string($connection, $_POST['stock_name']);
  $query = "SELECT * FROM stock WHERE stock = '{$stock}' AND id != {$stock_item} LIMIT 1";

  $result_set = mysqli_query($connection, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set)==1) {
      $errors[] = 'Updated stock item already exists.';
    }
  }

  //if no errors, enter data into the DB

  if (empty($errors)) {
 
    $stock_name = mysqli_real_escape_string($connection, $_POST['stock_name']);
   
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $qty = mysqli_real_escape_string($connection, $_POST['qty']);

   

    /*$query = "INSERT INTO stock (stock, mat_id, price,qty) VALUES('{$stock_stock}',{$category_id},'{$price}', {$qty})";*/

    $query = "UPDATE stock SET ";
    $query .= "stock = '{$stock_name}', "; 
    //$query .= "mat_id = {$materials_id}, "; 
    $query .= "price = '{$price}', ";  
    $query .= "qty = {$qty} "; 
    $query .= "WHERE id = {$stock_item} LIMIT 1";

    $result = mysqli_query($connection, $query);
    if ($result) {
      //query successfull...stock update true
      $msg = 'Successfully edited the stock';
      echo "<script type='text/javascript'>alert('$msg');</script>";
      header('Location:stock.php?update=true');
    }else{
      $errors[] = 'Failed to edit stock item.';
    }

  }

}



 ?>

<!-- getting materials details -->
<?php 
   $query = "SELECT id, materials FROM materials";
   $result_set = mysqli_query($connection, $query);

   $materials_list='';

   while ($row = mysqli_fetch_assoc($result_set)) {
     $materials_list .= "<option value=\"{$row['id']}\" >{$row['materials']}</option>";
   }

?>


<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Stock Item</h1>
    <a href="stock.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-chevron-circle-left fa-sm text-white-50"></i> Back to stock</a>
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
      <form method="POST" enctype="multipart/form-data" action="edit-stock.php"> 
        <div class="form-group">
          <label for="formGroupExampleInput">Enter Stock Name</label>
          <input type="hidden" name="stock_item" value="<?php echo $stock_id; ?>">
          <input type="text" name="stock_name" class="form-control" id="formGroupExampleInput" placeholder="stock Name" <?php echo 'value= "'.$stock_name.'"'; ?>>
        </div>
        <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Price</label>
          
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Rs. </div>
            </div>
            <input type="text" name="price" class="form-control" id="formGroupExampleInput" placeholder="Price" <?php echo 'value= "'.$price.'"'; ?>>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="formGroupExampleInput">Quantity</label>
          <input type="text" name="qty" class="form-control" id="formGroupExampleInput" placeholder="Quantity" <?php echo 'value= "'.$qty.'"'; ?>>
        </div>

        </div>

      </div>
      <button type="submit" name="stock-submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>


<?php
include('inc/scripts.php');
include('inc/footer.php');
?>