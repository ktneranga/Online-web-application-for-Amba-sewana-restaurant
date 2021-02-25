
<?php 

$pid = '';

if (isset($_GET['pid'])) {
  $pid = $_GET['pid'];
}
//empty array for store error messages
$errors = array();

//variables for store form details
$Customer_Name = '';
$Email = '';
$Comment = '';

//check whether the comment form submit button has clicked
if (isset($_POST['comment_submit'])) {

//get the values from the comment form
  $Customer_Name = $_POST['name'];
  $Email = $_POST['email'];
  $Comment = $_POST['comment'];

  //checking required fields
  if (empty(trim($_POST['name']))) {
    $errors[] = 'Name is required';
  }

  if (empty(trim($_POST['email']))) {
    $errors[] = 'Email is required';
  }

  if (empty(trim($_POST['comment']))) {
    $errors[] = 'Pleae enter the comment';
  }

  //checking email address
  if (!is_email($_POST['email'])) {
    $errors[] = 'Email address is invalid';
  }

  if (empty($_POST['customer_id'])) {
    $errors[] = 'Please login first';
  }

if (empty($errors)) {
  $pid = $_POST['food_id'];
  $uid = $_POST['customer_id'];
  //get the sanitized values from input fields of comment form
  $customer_name = mysqli_real_escape_string($connection, $_POST['name']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $comment = mysqli_real_escape_string($connection, $_POST['comment']);

  //insert comment details into the review table
  $query = "INSERT INTO reviews(pid, uid, name, email, review) VALUES({$pid}, {$uid},'{$customer_name}', '{$email}', '{$comment}')";

  $result = mysqli_query($connection, $query);

  if ($result) {
    //query successfull
    $msg = 'successfully added the comment!';
    //display the success message
    echo "<script type='text/javascript'>alert('$msg');</script>";
  }else{
    //query failed
    $errors[] = 'Failed to add the comment!';
  }

}
  
}

 ?> 

<!-- //add comment pop up modal form -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title  w-100 font-weight-bold" id="exampleModalLabel">Enter your comment here!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
        //display errors if there are errors on the form
        if (!empty($errors)) {
          echo "<div class='errmsg'>";
          echo '<div class="alert alert-danger" role="alert">There were error(s) on your form!</div>';
          foreach ($errors  as $error) {
            echo $error."<br>";
          }
          echo "</div>";
          $msg = 'There were error(s) on your form please re enter your comment!';
          echo "<script type='text/javascript'>alert('$msg');</script>";
        }
         ?>
        <!-- html form -->
        <form method="post" action="">
        <div class="form-row">
          <!-- //display the name and email of the logged in user using sessions --> 
          <div class="col">
            <input type="text" name="name" class=" form-control" placeholder="First name" <?php echo 'value="'.$_SESSION['first_name'].'"'; ?> required>
          </div>
          <div class="col">
            <input type="email" name="email" class=" form-control" placeholder="Email" <?php echo 'value="'.$_SESSION['email'].'"'; ?> required>
          </div>
        </div>
       <div class="form-group mt-4">
        <textarea class="form-control" name="comment" rows="5" placeholder="Enter Your Review Here..."></textarea>
       </div>
       <div class="form-group">
            <!-- //use the product id to store the comment relevent food item -->
          <input type="hidden" class="" id="recipient-name"  name="food_id" <?php echo 'value = "'.$pid.'"' ?>>
        </div>
        <div class="form-group">
            <!-- //use user_id to store the comment with the user_id -->
          <input type="hidden" class="" id="recipient-name"  name="customer_id" <?php echo 'value = "'.$_SESSION['user_id'].'"' ?>>
        </div>
       <button type="submit" name="comment_submit" class="btn btn-warning" style="color: white;">Submit</button>
      </form>
        <!-- html form -->
      </div>
    </div>
  </div>
</div>