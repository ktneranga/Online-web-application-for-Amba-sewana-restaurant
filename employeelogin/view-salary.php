<?php session_start(); ?>

<?php include('inc/connection.php'); ?>

<?php include('inc/functions.php'); ?>

<?php include('inc/nav.php'); ?>



<table class="table">
    <thead class="thead-dark">
        <tr>

            <th scope="col">EMPLOYEE ID</th>
            <th scope="col">NAME</th>
            <th scope="col">BASIC SALARY</th>
            <th scope="col">WORKING HOURS</th>
            <th scope="col">OT RATE</th>
            <th scope="col">OT HOURS</th>
            <th scope="col">TOTAL SALARY</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $title = '';

        $title = $_GET['employeeid'];



        $employee = "SELECT *from employeesalary where eid= '$title' ";

        $result = mysqli_query($connection, $employee);

        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>

                <td><?php echo $row['eid']; ?></td>
                <td><?php echo $row['ename']; ?></td>
                <td><?php echo $row['bsal']; ?></td>
                <td><?php echo $row['workhr']; ?></td>
                <td><?php echo $row['otrate']; ?></td>
                <td><?php echo $row['othr']; ?></td>
                <td><?php echo $row['totsal']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="container">
    <div class="row" style="margin: 50px 50px 295px 50px">
        <input type="button" class="pull-right" value="Download pdf">
    </div>
</div>
<!-------------------footer------------------->

<?php include('inc/footer.php'); ?>