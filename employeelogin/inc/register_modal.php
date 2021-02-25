
<?php 

$errors = array();

$First_Name = ''; 
$Last_Name = ''; 
$Email = ''; 
$Password = ''; 
$Confirm_Password = ''; 


if (isset($_POST['register_submit'])) {

  $First_Name = $_POST['First_Name'];
  $Last_Name = $_POST['Last_Name'];
  $Email = $_POST['Email'];
  $Password = $_POST['Password'];
  $Confirm_Password = $_POST['Confirm_Password']; 

  //checking required fields
  $req_fields = array('First_Name','Last_Name','Email','Password','Confirm_Password');

  foreach ($req_fields as  $field) {
      if (empty(trim($_POST[$field]))) {
      $errors[] = $field.' is required.';
    }
  }

  //checking max length
  $max_length_fields = array('First_Name'=>50,'Last_Name'=>50,'Email'=>100,'Password'=>40,'Confirm_Password'=>40);

  foreach ($max_length_fields as $field => $max_len) {
    if (strlen(trim($_POST[$field]))>$max_len) {
      $errors[]= $field.' must be less than '.$max_len.' characters.';
    }
  }

  //checking email address

  if (!is_email($_POST['Email'])) {
    $errors[]= 'Email address is invalid.';
  }

  //checking if email address already exist

  $email = mysqli_real_escape_string($connection, $_POST['Email']);

  $query = "SELECT * FROM users WHERE Email = '{$email}' LIMIT 1";

  $result_set = mysqli_query($connection, $query);

  if ($result_set) {
    if (mysqli_num_rows($result_set)==1) {
      $errors[] = 'Email address already exists.';
    }
  }

  //checking if two passwords are matched

  $Password = mysqli_real_escape_string($connection, $_POST['Password']);
  $Confirm_Password = mysqli_real_escape_string($connection, $_POST['Confirm_Password']);

  if (!($Password == $Confirm_Password)) {
    $errors[] = 'Two passwords are not matched.';
  }
  //if no errors, enter data into the DB

  if (empty($errors)) {
    //sanitize the fields
    $first_name = mysqli_real_escape_string($connection, $_POST['First_Name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['Last_Name']);
    //email address already sanitized
    //Password already sanitized
    //Confirm_Password already sanitized
    $hashed_password = sha1($Password);
    $hashed_confirm_password = sha1($Confirm_Password);

    $query = "INSERT INTO users (First_Name, Last_Name, Email, Password, Confirm_Password, is_delete) VALUES('{$first_name}','{$last_name}','{$email}', '{$hashed_password}', '{$hashed_confirm_password}', 0)";

    $result = mysqli_query($connection, $query);

    if ($result) {
      //query successfull...user added true
      $msg = 'successfully Registered! Please login to the system!';
      echo "<script type='text/javascript'>alert('$msg');</script>";
     /* header('Location:index.php');*/
    }else{
      $errors[] = 'Failed to sign up.';
    }

  }

}



 ?>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title  w-100 font-weight-bold" id="exampleModalLabel">Register here!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 

        if (!empty($errors)) {
          echo "<div class='errmsg'>";
          echo '<div class="alert alert-danger" role="alert">There were error(s) on your form!</div>';
          foreach ($errors  as $error) {
            echo $error."<br>";
          }
          echo "</div>";
          $msg = 'There were error(s) on your form please re enter your credentials!';
          echo "<script type='text/javascript'>alert('$msg');</script>";
        }


         ?>
        <form method="post" action="index.php">
          
          <div class="form-row">
    		    <div class="form-group col-md-6">
    		      <!-- <label for="inputEmail4">Password</label> -->
    		      <input type="text" class="" id="userfname" placeholder="First Name" name="First_Name" <?php echo 'value = "'.$First_Name.'"' ?>>
    		    </div>
    		    <div class="form-group col-md-6">
    		      <!-- <label for="inputPassword4">Confirm Password</label> -->
    		      <input type="text" class="" id="userlname" placeholder="Last Name" name="Last_Name" <?php echo 'value = "'.$Last_Name.'"' ?>>
    		    </div>
    		  </div>

        <div class="form-group">
            <!-- <label for="name" class="col-form-label label-name">Email</label> -->
            <input type="email" class="" id="recipient-name" placeholder="Enter email here" name="Email" <?php echo 'value = "'.$Email.'"' ?>>
          </div>
          <div class="form-row">
    		    <div class="form-group col-md-6">
    		      <!-- <label for="inputEmail4">Password</label> -->
    		      <input type="password" class="" id="inputEmail4" placeholder="Password" name="Password">
    		    </div>
    		    <div class="form-group col-md-6">
    		      <!-- <label for="inputPassword4">Confirm Password</label> -->
    		      <input type="password" class="" id="inputPassword4" placeholder="Confirm Password" name="Confirm_Password">
    		    </div>
		      </div>
        <div class="form-group">
        	<button type="submit" name="register_submit">Sign Up</button>  	
        </div>
        </form>
      </div>
    </div>
  </div>
</div>