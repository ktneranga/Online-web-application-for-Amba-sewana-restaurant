<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- insert Employee items -->
<?php 

$errors = array();

$eid = ''; 
$bsal = ''; 
$category_id = ''; 
$ename = ''; 
$image = ''; 
$workhr = ''; 
$otrate ='';
$othr = ''; 
$totsal ='';
$uploaded = '';
$file_name = '';
$file_type = '';
$file_size = '';
$temp_name = '';
$upload_to = '';


//checking if the employee id has passed
if (isset($_GET['employee_id'])) {
  //getting the Employee item details
  $employee_id = mysqli_real_escape_string($connection, $_GET['employee_id']);

  $employee_query = "SELECT * FROM employeesalary WHERE eid = '$employee_id' LIMIT 1";
  $employee_result = mysqli_query($connection, $employee_query);

  if ($employee_result) {
    if (mysqli_num_rows($employee_result)==1) {
      //valid employee item found
      $employeesal_result_set = mysqli_fetch_assoc($employee_result);
            $eid = $employeesal_result_set['eid'];
       $bsal = $employeesal_result_set['bsal'];
      $workhr = $employeesal_result_set['workhr'];
      $ename = $employeesal_result_set['ename'];
      $othr = $employeesal_result_set['othr'];
      $otrate = $employeesal_result_set['otrate'];
      $totsal = $employeesal_result_set['totsal'];

    }
  }
  
}

if (isset($_POST['employeesal-submit'])) {
 /* echo "<pre>";
  print_r($_FILES);
  echo "</pre>";*/
  $employee_item = $_POST['employee_item'];
  $eid = $_POST['eid'];
  $bsal= $_POST['bsal'];
  $workhr = $_POST['workhr'];
  //$category_id = $_POST['category_id'];
  $ename = $_POST['ename'];
  $totsal = $_POST['totsal']; 
  $othr = $_POST['othr'];
  $otrate = $_POST['otrate'];

  //checking required fields
  $req_fields = array('eid','bsal','ename','workhr','totsal','otrate','othr');

  foreach ($req_fields as  $field) {
      if (empty(trim($_POST[$field]))) {
      $errors[] = $field.' is required.';
    }
  }

  //checking if Employee item address already exist
  $empsalary = mysqli_real_escape_string($connection, $_POST['eid']);
  $query = "SELECT * FROM employeesalary WHERE name = '{$empsalary}' AND id != {$employee_item} LIMIT 1";

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
    $eid = mysqli_real_escape_string($connection, $_POST['eid']);
    $bsal = mysqli_real_escape_string($connection, $_POST['bsal']);
    
    $ename = mysqli_real_escape_string($connection, $_POST['ename']);
    $workhr = mysqli_real_escape_string($connection, $_POST['workhr']);
    $othr = mysqli_real_escape_string($connection, $_POST['othr']);
    $otrate = mysqli_real_escape_string($connection, $_POST['otrate']);
    $totsal = mysqli_real_escape_string($connection, $_POST['totsal']); 

    $query = "UPDATE employeesalary SET ";
    $query .= "eid = '{$eid}', ";
    $query .= "bsal = '{$bsal}', "; 
    $query .= "ename = '{$ename}', "; 
    $query .= "workhr = '{$workhr}', "; 
    $query .= "othr = '{$othr}',  "; 
    $query .= "otrate = '{$otrate}', "; 
    $query .= "totsal = '{$totsal}', "; 
    $query .= "WHERE id = {$employee_item} LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {
      //query successfull...user added true
      header('Location:employeesalary.php?update=true');
    }else{
      $errors[] = 'Failed to edit employee item.';
    }

  }

}



 ?>

<!-- getting category details -->
<?php 
   $query = "SELECT id, category FROM ecategory";
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
    <h1 class="h3 mb-0 text-gray-800">Edit Employee Salary</h1>
    <a href="employeesalary.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-chevron-circle-left fa-sm text-white-50"></i> Back to Employee Salary</a>
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
        <form method="POST" enctype="multipart/form-data" action="edit-emsalarey.php"> 
        <div class="form-group">
          <label for="formGroupExampleInput">Enter Employee Id</label>
          <input type="hidden" name="employee_item" value="<?php echo $employee_id; ?>">
          <input type="text" name="eid" class="form-control" id="formGroupExampleInput" placeholder="Food Name" <?php echo 'value= "'.$eid.'"'; ?>>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Employee Password</label>
          <input type="text" name="bsal" class="form-control" id="formGroupExampleInput" placeholder="Employee Password" <?php echo 'value= "'.$bsal.'"'; ?>>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Employee Name</label>
          <input type="text" name="ename" class="form-control" id="formGroupExampleInput" placeholder="Employee Name" <?php echo 'value= "'.$ename.'"'; ?>>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Employee Phone Number</label>
          <input type="text" name="workhr" class="form-control" id="formGroupExampleInput" placeholder="Employee Phone Number" <?php echo 'value= "'.$workhr.'"'; ?>>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Employee Name</label>
          <input type="text" name="othr" class="form-control" id="formGroupExampleInput" placeholder="Employee Name" <?php echo 'value= "'.$othr.'"'; ?>>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Employee Phone Number</label>
          <input type="text" name="otrate" class="form-control" id="formGroupExampleInput" placeholder="Employee Phone Number" <?php echo 'value= "'.$otrate.'"'; ?>>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Employee Phone Number</label>
          <input type="text" name="totsal" class="form-control" id="formGroupExampleInput" placeholder="Employee Phone Number" <?php echo 'value= "'.$totsal.'"'; ?>>
        </div>

      <button type="submit" name="employeesal-submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-12 text-center">
      <a href="update-category.php?employee_id=<?php echo $food_id?>" class="btn btn-danger">Update category</a>
      <a href="update-image.php?employee_id=<?php echo $food_id ?>" class="btn btn-danger">Update Image</a>
    </div>
  </div>


<?php
include('inc/scripts.php');
include('inc/footer.php');
?>