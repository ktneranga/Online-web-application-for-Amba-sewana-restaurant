<?php
session_start();

include('inc/connection.php'); 
include('inc/dbcon.php');
include('inc/component.php');

$productId = $_POST["id"];
$productQty = $_POST["quantity"];

array_push($_SESSION['cart'], array('id' => $productId , 'qty' => $productQty));

foreach ($_SESSION['cart'] as $key => $value) {
	echo $key." - ".$value;
}
?>