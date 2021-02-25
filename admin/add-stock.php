<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<?php 

$errors = array();

$stock_name= '';
$materials_id = ''; 
$price = ''; 
$qty ='';

if (isset($_POST['stock_submit'])) {
	
  $stock_name = $_POST['stock_name'];
  $materials_id = $_POST['materials_id'];
  $price = $_POST['price']; 
  $qty = $_POST['qty'];

  //checking required fields
  $req_fields = array('stock_name','materials_id', 'price','qty');

  foreach ($req_fields as  $field) {
      if (empty(trim($_POST[$field]))) {
      $errors[] = $field.' is required.';
    }
  }

  //checking if stock item address already exist

  $stock = mysqli_real_escape_string($connection, $_POST['stock_name']);

  $query = "SELECT * FROM stock WHERE stock = '{$stock}' LIMIT 1";

  $result_set = mysqli_query($connection, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set)==1) {
      $errors[] = 'Stock item already exists.';
    }
  }

  //if no errors, enter data into the DB

  if (empty($errors)) {
    //sanitize the fields
    $stock_name = mysqli_real_escape_string($connection, $_POST['stock_name']);
    $materials_id = mysqli_real_escape_string($connection, $_POST['materials_id']);
    $stock_price = mysqli_real_escape_string($connection, $_POST['price']);
    $stock_qty = mysqli_real_escape_string($connection, $_POST['qty']);
   

    $query = "INSERT INTO stock (stock, mat_id, price,qty) VALUES('{$stock_name}',{$materials_id},'{$price}', {$qty})";

    $result = mysqli_query($connection, $query);

    if ($result) {
      //query successfull...user added true
      $msg = 'Successfully added the stock';
      echo "<script type='text/javascript'>alert('$msg');</script>";
      header('Location:stock.php?add=true');
    }else{
      $errors[] = 'Failed to add stock item.';
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
    <h1 class="h3 mb-0 text-gray-800">Add Stock Items</h1>
    <a href="stock.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-chevron-circle-left fa-sm text-white-50"></i> Back to Stock</a>
  </div>


  <div class="row">
    <div class="col-12">
      <form method="POST" enctype="multipart/form-data" action="add-stock.php"> 
        <div class="form-group">
          <label for="formGroupExampleInput">Enter stock Item Name</label>
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
          <input type="text" name="stock_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Stock Name">
        </div>
		
        <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Price</label>
		   <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">Rs. </div>
            </div>
		  
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
		 
          <!-- <input type="text" class="form-control" id="inputEmail4" placeholder="Price"> -->
         
            <input type="text" name="price" class="form-control" id="inlineFormInputGroup" placeholder="Price" <?php echo 'value="'.$price.'"'; ?>>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Quantity</label>
		  
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
		 
          <input type="text" name="qty" class="form-control" id="inputPassword4" placeholder="Quantity" <?php echo 'value="'.$qty.'"'; ?>>
        </div>

        <label for="inputPassword4">Select the materials</label>
		
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
		 
        <div class="input-group">
          <select class="custom-select" name="materials_id" id="inputGroupSelect04" aria-label="Example select with button addon">
            <option value=" " >No Materials</option>
            <?php echo $materials_list; ?>
          </select>
        </div>
      </div>
      <button type="submit" name="stock_submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  
<?php
include('inc/scripts.php');
include('inc/footer.php');
?>
