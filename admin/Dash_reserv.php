<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Table reservation Management</h1>
   <a href="add-table.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Add Table</a>
		
	<a href="deleteall.php?id=<?php echo $row['reserve_id']; ?>" class="btn btn-danger">Delete</a>
  </div>

	
		
<!--dash from-->
<div class="row">
  <div class="col-12">
  
		<?php
		//delete message
		if (isset($_GET['delete'])) {
		echo '<div class="alert alert-success" role="alert"> deleted successful!</div>';
		}

?>
		
   <div class="table-responsive text-nowrap">
    <table class="table table-striped  table-fixed" >
  <thead>
    <tr>
      <th scope="col">Reservation_id</th>
      <th scope="col">No.Of.Guest</th>
	  <th scope="col">Email</th>
	  <th scope="col">phone</th>
	  <th scope="col">Date of reservation</th>
	  <th scope="col">Time</th>
	  <th scope="col">Suggestions</th>
	  <th scope="col">Category</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>
  
	
    <?php 
	
	require "inc/connection.php";
    $category = "SELECT * FROM reservation";
    $result = mysqli_query($connection, $category);

	
		while ($row = mysqli_fetch_assoc($result)) {
    ?>
	
    <tr>
      <th scope="row"><?php echo $row['reserve_id']; ?></th>
      <td><?php echo $row['no_of_guest']; ?></td>
	  <td><?php echo $row['email']; ?></td>
	  <td><?php echo $row['phone']; ?></td>
	  <td><?php echo $row['date_res']; ?></td>
	  <td><?php echo $row['time']; ?></td>
	  <td><?php echo $row['suggestions']; ?></td>
	  <td><?php echo $row['category']; ?></td>
	  <td><a href="edit-reserv.php?id=<?php echo $row['reserve_id']; ?>" class="btn btn-warning ">Edit</a> | <a href="delete-reserv.php?id=<?php echo $row['reserve_id']; ?>" class="btn btn-danger">Delete</a></td>
    </tr>
	<?php
     } ?>
   </tbody>
   </table>
   </div>
  </div>
</div>

  <?php
include('inc/scripts.php');
include('inc/footer.php');
?>