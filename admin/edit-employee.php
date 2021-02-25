<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- insert foods items -->
<?php 

$errors = array();

$eid;
$cat_id = '';
$ename = '';
$thumbnail = ''; 
$description = ''; 
$epass = ''; 
$epnumber = ''; 
$uploaded = '';
$file_name = '';
$file_type = '';
$file_size = '';
$temp_name = '';
$upload_to = '';
$employee_item ;


//checking if the employee id has passed
if (isset($_GET['employee_id'])&&($_GET['cat'])) {
  //getting the food item details
  $employee_id = mysqli_real_escape_string($connection, $_GET['employee_id']);
  $cat_id = mysqli_real_escape_string($connection, $_GET['cat']);
  $employee_query = "SELECT * FROM employee WHERE eid = '$employee_id' LIMIT 1";
  $employee_result = mysqli_query($connection, $employee_query);

  if ($employee_result) {
    if (mysqli_num_rows($employee_result)==1) {
      //valid employee item found
      $employee_result_set = mysqli_fetch_assoc($employee_result);
      $eid = $employee_result_set['eid'];
      $ename = $employee_result_set['ename'];
      $description = $employee_result_set['description'];
      $epass = $employee_result_set['epass'];
      $epnumber = $employee_result_set['epnumber'];
      //$file_name = $food_result_set['thumbnail'];

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
    <h1 class="h3 mb-0 text-gray-800">Edit employee Item</h1>
    <a href="employee.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-chevron-circle-left fa-sm text-white-50"></i> Back to employee</a>
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
      <form method="POST" enctype="multipart/form-data" action="edit-employee.php"> 
        <div class="form-group">
          <label for="formGroupExampleInput">Enter Employee ID</label>
          <input type="hidden" name="employee_item" value="<?php echo $employee_id; ?>">
          <input type="text" name="eid" class="form-control" id="formGroupExampleInput" placeholder="Employee ID" <?php echo 'value= "'.$eid.'"'; ?>>
        </div>
        
        <div class="form-group">
          <label for="formGroupExampleInput">Enter Employee Name</label>
          <input type="hidden" name="employee_item" value="<?php echo $ename; ?>">
          <input type="text" name="ename" class="form-control" id="formGroupExampleInput" placeholder="Employee Name" <?php echo 'value= "'.$ename.'"'; ?>>
        </div>
            
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Enter Description</label>
          <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" ><?php echo $description ?></textarea>
        </div>
         
        <div class="form-group">
          <label for="formGroupExampleInput">Enter Employee Password</label>
          <input type="hidden" name="employee_item" value="<?php echo $epass; ?>">
          <input type="text" name="epass" class="form-control" id="formGroupExampleInput" placeholder="Employee PAssword" <?php echo 'value= "'.$epass.'"'; ?>>
        </div>    
            
        <div class="form-group">
          <label for="inputPassword4">Employee Phone Number</label>
          <input type="text" name="epnumber" class="form-control" id="inputPassword4" placeholder="epnumber" <?php echo 'value= "'.$epnumber.'"'; ?>>
        </div>

 
      <button type="submit" name="employee-submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-12 text-center">
      <a href="update-category.php?eid=<?php echo $eid?>" class="btn btn-danger">Update cat-id</a>
      <a href="update-image.php?eid=<?php echo $eid ?>" class="btn btn-danger">Update Image</a>
    </div>
  </div>


<?php
include('inc/scripts.php');
include('inc/footer.php');
?>