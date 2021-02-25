<?php
include('inc/connection.php');
include('inc/header.php'); 
include('inc/navbar.php'); 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

   <?php 
   $query = "SELECT id, category FROM ecategory";
   $result_set = mysqli_query($connection, $query);

   $category_list='';

   while ($row = mysqli_fetch_assoc($result_set)) {
     $category_list .= "<option value=\"{$row['id']}\" >{$row['category']}</option>";
   }
    ?>

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Employee Management</h1>
    <a href="add-employee.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i>Add Employee</a>
  </div>



<div class="row">
  <div class="col-12">
    <?php 

    //add message
      if (isset($_GET['delete_com'])) {
        if ($_GET['delete_com']) {
          echo '<div class="alert alert-success" role="alert">Comment deleted!</div>';
        }else{
          echo '<div class="alert alert-success" role="alert">Comment deleted!</div>';
        }
      }

      if (isset($_GET['delete_food'])) {
        if ($_GET['delete_food']) {
          echo '<div class="alert alert-success" role="alert">Employee is removed successful!</div>';
        }else{
          echo '<div class="alert alert-success" role="alert">Employee is removed fail!</div>';
        }
      }

      //add message
      if (isset($_GET['add'])) {
        echo '<div class="alert alert-success" role="alert">Employee is added successful!</div>';
      }

      //edit message
      if (isset($_GET['update'])) {
        echo '<div class="alert alert-success" role="alert">Employee is edited successful!</div>';
      }

      if (isset($_GET['update_image'])) {
        echo '<div class="alert alert-success" role="alert">Employee is image updated successful!</div>';
      }

      //edit message
       if (isset($_GET['update_cat'])) {
        echo '<div class="alert alert-success" role="alert">Employee category update successful!</div>';
      }

      if (isset($_GET['update_fail'])) {
        echo '<div class="alert alert-danger" role="alert">Employee category update failed!</div>';
      }



      //delete message
      /*if (isset($_GET['delete'])) {
       echo '<div class="alert alert-success" role="alert">Category deleted successful!</div>';
      }*/

     ?>
     <small class="mb-0 text-gray-800"><p style="color: red;">Total number of employee: </p></small> 
    <table class="table table-striped">
      <thead>
        <tr>
          <!-- <th scope="col">#</th> -->
          <th scope="col">Employee Id</th>
          <th scope="col">Password</th>
          <th scope="col">Employee Image</th>
          <th scope="col">Category</th>
          <th scope="col">Employee Name</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Description</th>
          <th scope="col">Operation</th>
         
        </tr>
      </thead>
      <tbody>
        <?php
        
        
         $employee = "SELECT employee.id ,employee.eid, employee.ename, ecategory.category, employee.thumbnail, employee.description, employee.epass, employee.epnumber ";
        /*$Employee = "SELECT * ";*/
         $employee .= "FROM employee ";
         $employee .= "JOIN ecategory ";
         $employee .= "ON employee.cat_id = ecategory.id";
         $result = mysqli_query($connection, $employee);

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Food Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <?php echo $row['description']; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <tr>
          
          <td><?php echo $row['eid']; ?></td>
          <td><?php echo $row['epass']; ?></td>
          <td><img src="../img/employee/<?php echo $row['thumbnail']; ?>" style="width: 60px; height: 50px;"></td>
          <td><?php echo $row['category']; ?></td>
          <td><?php echo $row['ename']; ?></td>
          <td><?php echo $row['epnumber']; ?></td>
          <td><a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row['id']; ?>">Desc:</a></td>
          <td><a href="edit-employee.php?employee_id=<?php echo $row['eid']; ?>&cat=<?php echo $row['category']; ?>" class="btn btn-warning ">Edit</a> | <a href="delete-employee.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Remove</a></td>
         
        </tr>
        

        <?php } ?>
      </tbody>
    </table>
  </div>
</div>



  <?php
include('inc/scripts.php');
include('inc/footer.php');
?>