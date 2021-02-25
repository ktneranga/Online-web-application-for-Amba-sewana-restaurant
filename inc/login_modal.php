
<!-- login modal start -->

<?php 

  //Create the cart session
  if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
  }
  //check for submission

  if (isset($_POST['submit'])) {

    $errors = array();

      //check if the username and password has been entered
      if (!isset($_POST['email']) || strlen(trim($_POST['email']))<1) {
        $errors[] = 'Username is Missing / invalid';
      }

      if (!isset($_POST['password']) || strlen(trim($_POST['password']))<1) {
        $errors[] = 'Password is Missing / invalid';
      }

      //check if there are any errors

      if (empty($errors)) {
      //save username and password into variables
        //mysqli_real_escape_string()=>avoid sql injections
         $email = mysqli_real_escape_string($connection, $_POST['email']);
         $password = mysqli_real_escape_string($connection, $_POST['password']);
         $hashed_password = sha1($password);
          //prepare database query

         $query = "SELECT * FROM users WHERE Email = '{$email}' AND Password = '{$hashed_password}' LIMIT 1";

         $result_set = mysqli_query($connection, $query);

         if($result_set){
          //query successful
          //check if the user is valid
          if (mysqli_num_rows($result_set) == 1) {

            //valid user  found
            $user = mysqli_fetch_assoc($result_set);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['First_Name'];
            $_SESSION['email'] = $user['Email'];

            //updating last login
            $query = "UPDATE users SET Last_Login = NOW() WHERE id = {$_SESSION['user_id']} LIMIT 1";

            $result_set = mysqli_query($connection, $query);

            if(!$result_set){
              die('Database query failed'. mysqli_error());
            }

            //redirect to index.php
           if($_SESSION['first_name'] == "Ranjith"){
              session_destroy();
              header('Location:../restaurant_edit/admin/index.php');
            }else{
              header('Location:index.php');
            }
            
          }else{
             //username or password invalid
             $errors[]='Username or Password invalid';
          }


      }else{
        $errors[] = 'Database query failed';
      }



        
      }

    
  }


   ?>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
			<h5 class="modal-title  w-100 font-weight-bold" id="exampleModalLabel">Sign in</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <?php 

        if (isset($errors) && !empty($errors)) {
          $msg = 'Invalid Username or Password!';
          echo "<script type='text/javascript'>alert('$msg');</script>";
          echo '<div class="alert alert-danger" role="alert">Invalid Username or Password!</div>';
        }

         ?>
        

        <form action="index.php" method="post" >
          <div class="form-group">
            <input type="Email" class="" id="recipient-name" placeholder="Enter email here" name="email">
          </div>
          
          <div class="form-group">
            <input type="Password" class="" id="recipient-name" placeholder="Enter password here" name="password">
          </div>
          <div class="form-group">
        	<button type="submit" name="submit">Log in</button>  	
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- login modal end -->