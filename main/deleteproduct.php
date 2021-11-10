<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $link->prepare("DELETE FROM products WHERE product_id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>