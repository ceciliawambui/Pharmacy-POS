<html>
<?php
require_once('auth.php');
?>

<head>
	<title>
		POS
	</title>
	<link href="css/bootstrap.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<style type="text/css">
		body {
			padding-top: 60px;
			padding-bottom: 40px;
		}

		.sidebar-nav {
			padding: 9px 0;
		}
	</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">


	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="tcal.css" />
	<script type="text/javascript" src="tcal.js"></script>
	<script language="javascript">
		function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>



</head>
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
		<div class="contentheader">
			<i class="icon-bar-chart"></i> Sales Report
		</div>
		<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Sales Report</li>
		</ul>

		<div class="dash-links container">
			<a href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-dashboard icon-2x"></i>
					DashBoard</button></a>
			<a href="products.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-list-alt icon-2x"></i>
					Drugs</button></a>
			<a href="customer.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-group icon-2x"></i>
					Customers</button></a>
			<a href="supplier.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-group icon-2x"></i>
					Suppliers</button></a>
			<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><button class="btn btn-default btn-large" style="float: none;"><i
					class="icon-shopping-cart icon-2x"></i> Sales</button></a>
			<a href="salesreport.php?d1=0&d2=0"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-bar-chart icon-2x"></i>
					Sales Report</button></a>
			<a href="javascript:Clickheretoprint()"><button class="btn btn-default btn-large" style="float: right;"><i class=""></i>
					Print</button></a>

		</div>
		<form action="salesreport.php" method="get">
			<center><strong>From : <input type="text" style="width: 223px; padding:14px;" name="d1" class="tcal" value="" /> To:
					<input type="text" style="width: 223px; padding:14px;" name="d2" class="tcal" value="" />
					<button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit"><i
						class="icon icon-search icon-large"></i> Search</button>
				</strong></center>
		</form>
		<div class="content" id="content">
			<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
				Sales Report from&nbsp;
				<?php echo $_GET['d1'] ?>&nbsp;to&nbsp;
				<?php echo $_GET['d2'] ?>
			</div>
			<div class="table-container">
			<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
				<thead>
					<tr>
						<th width="13%"> Transaction ID </th>
						<th width="13%"> Transaction Date </th>
						<th width="20%"> Customer Name </th>
						<th width="20%"> Customer Notes </th>
						<th width="16%"> Invoice Number </th>
						<th width="18%"> Amount </th>
						<th width="13%"> Profit </th>
					</tr>
				</thead>
				<tbody>

					<?php
				include('../connect.php');
				$d1 = $_GET['d1'];
				$d2 = $_GET['d2'];
				$result = $link->prepare("SELECT * FROM sales WHERE date BETWEEN :a AND :b ORDER by transaction_id DESC ");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				for ($i = 0; $row = $result->fetch(); $i++) {
					?>
					<tr class="record">
						<td>STI-00
							<?php echo $row['transaction_id']; ?>
						</td>
						<td>
							<?php echo $row['date']; ?>
						</td>
						<td>
							<?php echo $row['name']; ?>
						</td>
						<td>
							<?php echo $row['note']; ?>
						</td>
						<td>
							<?php echo $row['invoice_number']; ?>
						</td>
						<td>
							<?php
						$dsdsd = $row['amount'];
						echo formatMoney($dsdsd, true);
						?>
						</td>
						<td>
							<?php
						$zxc = $row['profit'];
						echo formatMoney($zxc, true);
						?>
						</td>
					</tr>
					<?php

			}
			?>

				</tbody>
				<thead>
					<tr>
						<th colspan="5" style="border-top:1px solid #999999"> Total: </th>
						<th colspan="1" style="border-top:1px solid #999999">
							<?php
						function formatMoney($number, $fractional = false)
						{
							if ($fractional) {
								$number = sprintf('%.2f', $number);
							}
							while (true) {
								$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
								if ($replaced != $number) {
									$number = $replaced;
								} else {
									break;
								}
							}
							return $number;
						}
						$d1 = $_GET['d1'];
						$d2 = $_GET['d2'];
						$results = $link->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN :a AND :b");
						$results->bindParam(':a', $d1);
						$results->bindParam(':b', $d2);
						$results->execute();
						for ($i = 0; $rows = $results->fetch(); $i++) {
							$dsdsd = $rows['sum(amount)'];
							echo formatMoney($dsdsd, true);
						}
						?>
						</th>
						<th colspan="1" style="border-top:1px solid #999999">
							<?php 
						$resultia = $link->prepare("SELECT sum(profit) FROM sales WHERE date BETWEEN :c AND :d");
						$resultia->bindParam(':c', $d1);
						$resultia->bindParam(':d', $d2);
						$resultia->execute();
						for ($i = 0; $cxz = $resultia->fetch(); $i++) {
							$zxc = $cxz['sum(profit)'];
							echo formatMoney($zxc, true);
						}
						?>

						</th>
					</tr>
				</thead>
			</table>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	</div>
	</div>

</body>
<script src="js/jquery.js"></script>
<script type="text/javascript">
	$(function () {


		$(".delbutton").click(function () {

			//Save the link in a variable called element
			var element = $(this);

			//Find the id of the link that was clicked
			var del_id = element.attr("id");

			//Built a url to send
			var info = 'id=' + del_id;
			if (confirm("Sure you want to delete this update? There is NO undo!")) {

				$.ajax({
					type: "GET",
					url: "deletesales.php",
					data: info,
					success: function () {

					}
				});
				$(this).parents(".record").animate({
						backgroundColor: "#fbc7c7"
					}, "fast")
					.animate({
						opacity: "hide"
					}, "slow");

			}

			return false;

		});

	});
</script>
<?php include('footer.php'); ?>

</html>