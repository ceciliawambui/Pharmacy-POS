<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $link->prepare("DELETE FROM supliers WHERE suplier_id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>