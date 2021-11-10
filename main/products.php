<html>
<head>
<title>
POS
</title>

<?php 
require_once('auth.php');
?>
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
<!--sa poip up-->
<script src="jeffartagame.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
$('a[rel*=facebox]').facebox({
	loadingImage : 'src/loading.gif',
	closeImage   : 'src/closelabel.png'
})
})
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

<script>
function sum() {
	var txtFirstNumberValue = document.getElementById('txt1').value;
	var txtSecondNumberValue = document.getElementById('txt2').value;
	var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
	if (!isNaN(result)) {
		document.getElementById('txt3').value = result;
		
	}
	
	var txtFirstNumberValue = document.getElementById('txt11').value;
	var result = parseInt(txtFirstNumberValue);
	if (!isNaN(result)) {
		document.getElementById('txt22').value = result;				
	}

	var txtFirstNumberValue = document.getElementById('txt11').value;
	var txtSecondNumberValue = document.getElementById('txt33').value;
	var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
	if (!isNaN(result)) {
		document.getElementById('txt55').value = result;
	}

	var txtFirstNumberValue = document.getElementById('txt4').value;
	var result = parseInt(txtFirstNumberValue);
	if (!isNaN(result)) {
		document.getElementById('txt5').value = result;
	}

}
</script>

<body>
	<?php include('navfixed.php'); ?>
	<div class="container">
		<div class="contentheader">
			<i class="icon-table"></i> Products
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Products</li>
			</ul>


			<div class="dash-links container">
				<a  href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-dashboard icon-2x"></i> DashBoard</button></a>
				<a  href="products.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-list-alt icon-2x"></i> Drugs</button></a>
				<a  href="customer.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-group icon-2x"></i> Patients</button></a>
				<a  href="supplier.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-group icon-2x"></i> Suppliers</button></a>
				<a  href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-shopping-cart icon-2x"></i> Sales</button></a>
				<a  href="salesreport.php?d1=0&d2=0"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-bar-chart icon-2x"></i> Sales Report</button></a>

			</div>
			<div>	
			<?php 
		include('../connect.php');
		$result = $link->prepare("SELECT * FROM products ORDER BY qty_sold DESC");
		$result->execute();
		$rowcount = $result->rowcount();
		?>

			<?php 
		include('../connect.php');
		$result = $link->prepare("SELECT * FROM products WHERE expiry_date <= now() ORDER BY expiry_date DESC");
		$result->execute();
		$rowcount_expiry = $result->rowcount();
		?>
				
			<?php 
		include('../connect.php');
		$result = $link->prepare("SELECT * FROM products where qty < 10 ORDER BY product_id DESC");
		$result->execute();
		$rowcount123 = $result->rowcount();
		?>
			
			<div style="text-align:center;">
				<span>Total Number of Drugs: <span style="color: #fff; font-size: 12pt; background:#388E3C; width:200px; margin: auto; padding: 5px; border-radius: 10px;" class="badge"><?php echo $rowcount; ?></span></span>&nbsp;
				<span>Drugs below 10: <span style="color: #fff; font-size: 12pt; background:#F57C00; width:200px; margin: auto; padding: 5px; border-radius: 10px;" class="badge"><?php echo $rowcount123; ?></span></span>&nbsp;
				<span>Expired Drugs: <span style="color: #fff; font-size: 12pt; background:#FF3030; width:200px; margin: auto; padding: 5px; border-radius: 10px;" class="badge"><?php echo $rowcount_expiry; ?></span></span>
			</div>
			<br>
	</div>

	<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Search Drug..." autocomplete="off" />
	<a rel="facebox" href="addproduct.php"><Button type="submit" class="btn btn-info" style="float:right; width:230px; height:35px;" /><i class="icon-plus-sign icon-large"></i> Add Product</button></a><br><br>
	<div class="table-container">
	<table class="hoverTable" id="resultTable" data-responsive="table" style="text-align: left;">
		<thead>
			<tr>
				<th> Name </th>
				<th> Generic Name </th>
				<th> Category</th>
				<th> Supplier </th>
				<th> Received </th>
				<th> Expiry Date </th>
				<th> Original Price </th>
				<th> Selling Price </th>
				<th> QTY </th>
				<th> Qty Left </th>
				<th> Total </th>
				<th> Action </th>
			</tr>
		</thead>
		<tbody>
			
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
		include('../connect.php');
		$result = $link->prepare("SELECT *, price * qty as total FROM products ORDER BY product_id DESC");
		$result->execute();
		for ($i = 0; $row = $result->fetch(); $i++) {
			$total = $row['total'];
			$availableqty = $row['qty'];
			$expirydte = strtotime($row['expiry_date']);
			$now = strtotime(date('Y-m-d'));

			if ($availableqty < 10) {
				echo '<tr class="alert alert-warning record" style="color: #fff; background:#F57C00;">';
			} else if ($expirydte <= $now) {
				echo '<tr class="alert alert-warning record" style="color: #fff; background:#FF3030;">';
			} else {
				echo '<tr class="record">';
			}
			?>
				
					<td><?php echo $row['product_code']; ?></td>
					<td><?php echo $row['gen_name']; ?></td>
					<td><?php echo $row['product_name']; ?></td>
					<td class="supplier-drug-table"><?php echo $row['supplier']; ?></td>
					<td><?php echo $row['date_arrival']; ?></td>
					<td><?php echo $row['expiry_date']; ?></td>
					<td class="price-drug-table">
						<?php
					$oprice = $row['o_price'];
					echo formatMoney($oprice, true);
					?></td>
					<td class="price-drug-table">
						<?php
					$pprice = $row['price'];
					echo formatMoney($pprice, true);
					?></td>
					<td><?php echo $row['qty_sold']; ?></td>
					<td><?php echo $row['qty']; ?></td>
					<td>
					<?php
				$total = $row['total'];
				echo formatMoney($total, true);
				?>
					</td>
					<td>
						<a rel="facebox" title="Click to edit the product" href="editproduct.php?id=<?php echo $row['product_id']; ?>"><button class="btn btn-warning btn-mini"><i class="icon-edit"></i></button></a>&nbsp;<a href="#" id="<?php echo $row['product_id']; ?>" class="delbutton" title="Click to Delete the product"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i></button></a>
					</td>
					</tr>
					<?php

			}
			?>
			</tbody>
		</table>
		</div>
		<div class="clearfix"></div>
		</div>
		</div>
	</div>

	<script src="js/jquery.js"></script>
	<script type="text/javascript">
		$(function() {
			$(".delbutton").click(function(){

			//Save the link in a variable called element
			var element = $(this);

			//Find the id of the link that was clicked
			var del_id = element.attr("id");

			//Built a url to send
			var info = 'id=' + del_id;
			if(confirm("Sure you want to delete this Product? This cannot be undone!")){
				$.ajax({
				type: "GET",
				url: "deleteproduct.php",
				data: info,
				success: function(){
			}
			});
				$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
			}
			return false;
			});
		});
	</script>
</body>
<?php include('footer.php'); ?>
</html>