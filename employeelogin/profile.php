<?php session_start(); ?>

<?php include('inc/connection.php'); ?>

<?php include('inc/functions.php'); ?>

<?php include('inc/nav.php'); ?>



<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Image</th>
            <th scope="col">EMPLOYEE ID</th>
            <th scope="col">NAME</th>
            <th scope="col">Password</th>
            <th scope="col">Phone Number</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $title = '';

        $title = $_GET['employeeid'];



        $employee = "SELECT *from employee where eid= '$title' ";

        $result = mysqli_query($connection, $employee);

        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><img src="../img/employee/<?php echo $row['thumbnail']; ?>" style="width: 100px; height: 100px;"></td>
                <td><?php echo $row['eid']; ?></td>
                <td><?php echo $row['ename']; ?></td>
                <td><?php echo $row['epass']; ?></td>
                <td><?php echo $row['epnumber']; ?></td>

            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="container">
    <div class="row" style="margin: 50px 50px 295px 50px">
        <input type="button" class="pull-right" value="Download pdf" style=" display: none;">
    </div>
</div>
<!-------------------footer------------------->

<?php include('inc/footer.php'); ?>