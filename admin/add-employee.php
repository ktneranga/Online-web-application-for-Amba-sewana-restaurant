<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- insert Employee items -->
<?php 

$errors = array();

$eid = ''; 
$epass = ''; 
$category_id = ''; 
$ename = ''; 
$image = ''; 
$description = ''; 
$epnumber ='';
$uploaded = '';
$file_name = '';
$file_type = '';
$file_size = '';
$temp_name = '';
$upload_to = '';


if (isset($_POST['employee-submit'])) {
 /* echo "<pre>";
  print_r($_FILES);
  echo "</pre>";*/

  $eid = $_POST['eid'];
  $epass = $_POST['epass'];
  $category_id = $_POST['category_id'];
  $ename = $_POST['ename'];
  $description = $_POST['description']; 
  $epnumber = $_POST['epnumber'];
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

  //checking file size
  if ($file_size>500000) {
    $errors[] = 'File size should be less than 500KB';
  }

  //checking required fields
  $req_fields = array('eid','epass','category_id', 'ename','description','epnumber');

  foreach ($req_fields as  $field) {
      if (empty(trim($_POST[$field]))) {
      $errors[] = $field.' is required.';
    }
  }

  //checking if this employee is already exists

  $employee = mysqli_real_escape_string($connection, $_POST['eid']);

  $query = "SELECT * FROM employee WHERE name = '{$employee}' LIMIT 1";

  $result_set = mysqli_query($connection, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set)==1) {
      $errors[] = 'This employee is already exists.';
    }
  }

  //if no errors, enter data into the DB

  if (empty($errors)) {
    //Upload image
    $uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
    //sanitize the fields
    $eid = mysqli_real_escape_string($connection, $_POST['eid']);
    $epass = mysqli_real_escape_string($connection, $_POST['epass']);
    $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
    $ename = mysqli_real_escape_string($connection, $_POST['ename']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $epnumber = mysqli_real_escape_string($connection, $_POST['epnumber']);
    $thumbnail = /*'img/product/'.*/$file_name;
   

    $query = "INSERT INTO employee (eid, cat_id, ename, thumbnail, description ,epass, epnumber) VALUES('{$eid}',{$category_id},'{$ename}','{$thumbnail}', '{$description}', '{$epass}', {$epnumber})";

    $result = mysqli_query($connection, $query);

    if ($result) {
      //query successfull...user added true
      $msg = 'Successfully added the Employee';
      echo "<script type='text/javascript'>alert('$msg');</script>";
      /*header('Location:EmployeeManagement.php?add=true');*/
    }else{
      $errors[] = 'Failed to employee.';
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
    <h1 class="h3 mb-0 text-gray-800">Add Employee</h1>
    <a href="EmployeeManagement.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-chevron-circle-left fa-sm text-white-50"></i> Back to Employee</a>
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
        <form method="POST" enctype="multipart/form-data" action="add-employee.php"> 
        <div class="form-group">
          <label for="formGroupExampleInput">Employee Id</label>
          <input type="text" name="eid" class="form-control" id="formGroupExampleInput" placeholder="Id" <?php echo 'value="'.$eid.'"'; ?>>
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">Employee Password</label>
          <input type="password" name="epass" class="form-control" id="formGroupExampleInput" placeholder="Password" <?php echo 'value="'.$epass.'"'; ?>>
        </div>
            
        <div class="form-group">
          <label for="formGroupExampleInput">Employee Name</label>
          <input type="text" name="ename" class="form-control" id="formGroupExampleInput" placeholder="Name" <?php echo 'value="'.$ename.'"'; ?>>
        </div>
            
        <div class="form-group">
          <label for="formGroupExampleInput">Employee Phone Number</label>
          <input type="number" name="epnumber" class="form-control" id="formGroupExampleInput" placeholder="Phone Number" <?php echo 'value="'.$epnumber.'"'; ?>>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Enter Description</label>
          <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" <?php echo 'value="'.$description.'"'; ?>></textarea>
        </div>
        <div class="form-row">


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
      <button type="submit" name="employee-submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>


<?php
include('inc/scripts.php');
include('inc/footer.php');
?>