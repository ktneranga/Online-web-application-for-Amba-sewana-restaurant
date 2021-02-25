<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<?php 

$errors = array();

$supplier_name = ''; 
$supplier_telNo = '';
$supplier_email = '';


if (isset($_POST['supplier_submit'])) {

  $supplier_name = $_POST['supplier_name'];
  $supplier_telNo = $_POST['supplier_telNo'];
  $supplier_email = $_POST['supplier_email'];

  //checking required fields
  $req_fields = array('supplier_name','supplier_telNo','supplier_email');

  foreach ($req_fields as  $field) {
      if (empty(trim($_POST[$field]))) {
      $errors[] = $field.' is required.';
    }
  }

  //checking if supplier address already exist

  $sup = mysqli_real_escape_string($connection, $_POST['supplier_name']);

  $query = "SELECT * FROM supplier WHERE supplier = '{$sup}' LIMIT 1";

  $result_set = mysqli_query($connection, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set)==1) {
      $errors[] = 'Supplier already exists.';
    }
  }

  //if no errors, enter data into the DB

  if (empty($errors)) {
    //sanitize the fields
    $sup_name = mysqli_real_escape_string($connection, $_POST['supplier_name']);
	 $sup_telNo = mysqli_real_escape_string($connection, $_POST['supplier_telNo']);
	  $sup_email = mysqli_real_escape_string($connection, $_POST['supplier_email']);
    

    $query = "INSERT INTO supplier (supplier,telNo,email) VALUES('{$sup_name}','{$sup_telNo}','{$sup_email}')";

    $result = mysqli_query($connection, $query);

    if ($result) {
      //query successfull...supplier added true
      $msg = 'Successfully added the supplier';
      echo "<script type='text/javascript'>alert('$msg');</script>";
      header('Location:supplier.php?status=true');
    }else{
      $errors[] = 'Failed to add the supplier!';
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
    <h1 class="h3 mb-0 text-gray-800">Add Supplier</h1>
    <a href="supplier.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-chevron-circle-left fa-sm text-white-50"></i> Back to supplier</a>
      
  </div>

  <div class="row">
    <div class="col-12">
      <form method="POST" action="add-supplier.php">
        <div class="form-group">
        <label for="exampleInputEmail1">Enter Supplier Name</label>
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
        <input type="text" name="supplier_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Supplier Name">
      </div>
	  
	   <div class="form-group">
        <label for="exampleInputEmail1">Enter Supplier Telephone No</label>
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
        <input type="text" name="supplier_telNo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Supplier Telephone No">
      </div>
	  
	  
	  	   <div class="form-group">
        <label for="exampleInputEmail1">Enter Supplier Email</label>
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
        <input type="text" name="supplier_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Supplier Email">
      </div>
      <button type="submit" name="supplier_submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>


<?php
include('inc/scripts.php');
include('inc/footer.php');
?>