<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select eid from employee where eid = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['eid'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   }
?>