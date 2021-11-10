<?php
session_start();
include('../connect.php');
$a = $_POST['name'];
$b = $_POST['address'];
$c = $_POST['contact'];
// $d = $_POST['memno'];
// $e = $_POST['prod_name'];
// $f = $_POST['note'];
// $g = $_POST['date'];
// query
$sql = "INSERT INTO customer (customer_name,address,contact) VALUES (:a,:b,:c)";
$q = $link->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c));
header("location: customer.php");


?>