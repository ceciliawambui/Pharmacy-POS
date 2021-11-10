<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $link->prepare("DELETE FROM sales WHERE transaction_id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>