<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Ambasewana Restaurant | Admin Panel</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- <link rel="stylesheet" href="css/croppie.css" />
  <script src="js/croppie.js"></script> -->

</head>

<body id="page-top">
    <?php 

      ob_start();
      $_PERINTAH = shell_exec('ipconfig /all');
      ob_clean();

      $_PECAH = strpos($_PERINTAH, "Physical");
      $mac = substr($_PERINTAH, ($_PECAH+36),17);
      $mac_address = str_replace('-', ':', $mac);

     ?>

  <!-- Page Wrapper -->
  <div id="wrapper">
