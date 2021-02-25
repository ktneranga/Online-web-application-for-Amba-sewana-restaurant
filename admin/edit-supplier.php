<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<?php 

$errors = array();

$suppler_id;
$supplier_name='';
$telNo = ''; 
$email = ''; 
$supplier_item ;


//checking if the supplier id has passed
if (isset($_GET['sup_id'])) {
  //getting the supplier item details
  $supplier_id = mysqli_real_escape_string($connection, $_GET['sup_id']);
  $query = "SELECT * FROM supplier WHERE id = {$supplier_id} LIMIT 1";
  
  $supplier_result = mysqli_query($connection, $query);

  if ($supplier_result) {
    if (mysqli_num_rows($supplier_result)==1) {
      //valid supplier item found
      $supplier_result_set = mysqli_fetch_assoc($supplier_result);
      $supplier_name = $supplier_result_set['supplier'];
      $telNo = $supplier_result_set['telNo'];
      $email = $supplier_result_set['email'];

      }else{
        //supplier not found
        header('Location:supplier.php?err=supplier_not_found');
      }
    }else{
      //query failed
      header('Location:supplier.php?err=query_failed');
    }

} 

if (isset($_POST['supplier_submit'])) {

  $supplier_item = $_POST['supplier_item'];
  $supplier_name = $_POST['supplier_name'];
  $telNo = $_POST['supplier_telNo'];
  $email = $_POST['supplier_email']; 

  $req_fields = array('supplier_name','supplier_telNo','supplier_email');

  foreach ($req_fields as  $field) {
      if (empty(trim($_POST[$field]))) {
      $errors[] = $field.' is required.';
    }
  }

  //checking if supplier item address already exist
  $sup = mysqli_real_escape_string($connection, $_POST['supplier_name']);
  $query = "SELECT * FROM supplier WHERE supplier = '{$sup}' AND id != {$supplier_item} LIMIT 1";

  $result_set = mysqli_query($connection, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set)==1) {
      $errors[] = 'Updated supplier item already exists.';
    }
  }

  //if no errors, enter data into the DB

  if (empty($errors)) {
    $sup_name = mysqli_real_escape_string($connection, $_POST['supplier_name']);
    $telNo = mysqli_real_escape_string($connection, $_POST['supplier_telNo']);
    $email = mysqli_real_escape_string($connection, $_POST['supplier_email']);

    $query = "UPDATE supplier SET ";
    $query .= "supplier = '{$supplier_name}', "; 
    $query .= "telNo = '{$telNo}', ";  
    $query .= "email = '{$email}' "; 
    $query .= "WHERE id = {$supplier_item} LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {
      //query successfull...supplier update true
      $msg = 'Successfully edited the supplier';
      echo "<script type='text/javascript'>alert('$msg');</script>";
      header('Location:supplier.php?update=true');
    }else{
      $errors[] = 'Failed to edit supplier item.';
    }

  }

}



 ?>


<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Supplier Details</h1>
    <a href="supplier.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-chevron-circle-left fa-sm text-white-50"></i> Back to Supplier</a>
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
      <form method="POST" enctype="multipart/form-data" action="edit-supplier.php"> 
        <div class="form-group">
          <label for="formGroupExampleInput">Enter Supplier Name</label>
          <input type="hidden" name="supplier_item" value="<?php echo $supplier_id; ?>">
          <input type="text" name="supplier_name" class="form-control" id="formGroupExampleInput" placeholder="Supplier Name" <?php echo 'value= "'.$supplier_name.'"'; ?>>
        </div>
		<div class="form-group">
          <label for="formGroupExampleInput">Enter Supplier Telphone Number</label>
          <input type="text" name="supplier_telNo" class="form-control" id="formGroupExampleInput" placeholder="Supplier telNo" <?php echo 'value= "'.$telNo.'"'; ?>>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Enter Supplier Email</label>
          <input type="text" name="supplier_email" class="form-control" id="formGroupExampleInput" placeholder="Supplier email" <?php echo 'value= "'.$email.'"'; ?>>
        </div>

      </div>
      <button type="submit" name="supplier_submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>


<?php
include('inc/scripts.php');
include('inc/footer.php');
?>