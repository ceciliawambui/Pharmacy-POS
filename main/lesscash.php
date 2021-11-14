<!DOCTYPE html>
<html>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<head>
<?php require_once('auth.php'); ?>
<title>
Sales Receipt
</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<style type="text/css">
	.sidebar-nav {
		padding: 9px 0;
	}
</style>
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script language="javascript">
function Clickheretoprint()
{ 
	var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
		disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
	var content_vlue = document.getElementById("content").innerHTML; 

	var docprint=window.open("","",disp_setting); 
	docprint.document.open(); 
	docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');          
	docprint.document.write(content_vlue); 
	docprint.document.close(); 
	docprint.focus(); 
}
</script>
<?php
$invoice = $_GET['invoice'];
include('../connect.php');
$result = $link->prepare("SELECT * FROM sales WHERE invoice_number= :userid");
$result->bindParam(':userid', $invoice);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
	$cname = $row['name'];
	$invoice = $row['invoice_number'];
	$date = $row['date'];
	$cash = $row['due_date'];
	$cashier = $row['cashier'];

	$pt = $row['type'];
	$am = $row['amount'];
	if ($pt == 'cash') {
		$cash = $row['due_date'];
		$amount = $cash - $am;
	}
}
?>
<?php
function createRandomPassword()
{
	$chars = "003232303232023232023456789";
	srand((double)microtime() * 1000000);
	$i = 0;
	$pass = '';
	while ($i <= 7) {
		$num = rand() % 33;
		$tmp = substr($chars, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}
$finalcode = 'RS-' . createRandomPassword();
?>

<body>

<?php include('navfixed.php'); ?>
		
<div class="container">
<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><button class="btn btn-default"><i class="icon-arrow-left"></i> Back to Sales</button></a>
<div class="pull-right" style="margin-right:100px;">

</div><br/><br/><br/><br/>
<div class="content" id="content">
<div style="margin: 0 auto; padding: 40px; width: 900px; height: 900px; font-weight: normal; border-style: groove;">
<div style="width: 100%; height: 190px;" >
<div style="width: 900px; float: left;">
<center><div style="font:bold 25px 'Aleo';">Payment Error</div>

</center>
<div>
<?php
	if (isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0) {
		foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<div style="color: red; text-align: center;">', $msg, '</div><br>';
		}
		unset($_SESSION['ERRMSG_ARR']);
	}
	
	?>

	
	</div>
	</div>
	
</div>
</div>


