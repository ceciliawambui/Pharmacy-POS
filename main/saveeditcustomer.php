<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['name'];
$b = $_POST['address'];
$c = $_POST['contact'];
// $d = $_POST['memno'];
// $e = $_POST['prod_name'];
// $f = $_POST['note'];
// $g = $_POST['date'];
// query
$sql = "UPDATE customer 
        SET customer_name=?, address=?, contact=?, membership_number=?
		WHERE customer_id=?";
$q = $link->prepare($sql);
$q->execute(array($a,$b,$c,$d,$id));
header("location: customer.php");

?>