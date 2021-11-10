<?php
	include('../connect.php');
	$id=$_GET['id'];
	$c=$_GET['invoice'];
	$qty=$_GET['qty'];
	$wapak=$_GET['code'];
	//edit qty
	$sql = "UPDATE products 
			SET qty=qty-?
			WHERE product_code=?";
	$q = $link->prepare($sql);
	$q->execute(array($qty,$wapak));

	$result = $link->prepare("DELETE FROM purchases_item WHERE id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
	header("location: purchasesportal.php?iv=$c");
?>