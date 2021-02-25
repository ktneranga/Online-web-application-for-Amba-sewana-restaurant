<?php include('inc/connection.php'); ?>

<?php 



$name = "Noodles(Dinner)";
$cat_id = 3;
$price = "180";
$thumbnail = "img/product/p1.jpg";
$description = "hjewvfhj efyvfuhewvfu guegwy efugfy hedwu ewygduwfdu iuoq udwegiuwg ";
$qty = 20;

$query = "INSERT INTO foods (name, cat_id, price, thumbnail, description, qty) VALUES ('{$name}', {$cat_id}, '{$price}', '{$thumbnail}', '{$description}', $qty)";

$result = mysqli_query($connection, $query);

if($result){
	echo "record added";
}else{
	echo "Insert query failed";
}


 ?>