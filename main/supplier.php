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
function createRandomPassword() {
	$chars = "003232303232023232023456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= 7) {

		$num = rand() % 33;

		$tmp = substr($chars, $num, 1);

		$pass = $pass . $tmp;

		$i++;

	}
	return $pass;
}
$finalcode='RS-'.createRandomPassword();
?>


<body>
<?php include('navfixed.php');?>

	<div class="container">
	<div class="contentheader">
			<i class="icon-group"></i> Suppliers
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Suppliers</li>
			</ul>


		<div class="dash-links container">
			<a  href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-dashboard icon-2x"></i> DashBoard</button></a>
			<a  href="products.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-list-alt icon-2x"></i> Drugs</button></a>
			<a  href="customer.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-group icon-2x"></i> Customers</button></a>
			<a  href="supplier.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-group icon-2x"></i> Suppliers</button></a>
			<a  href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-shopping-cart icon-2x"></i> Sales</button></a>
			<a  href="salesreport.php?d1=0&d2=0"><button class="btn btn-default btn-large" style="float: none;"><i class="icon-bar-chart icon-2x"></i> Sales Report</button></a>

		</div>	
		<div>
		<?php 
			include('../connect.php');
				$result = $link->prepare("SELECT * FROM supliers ORDER BY suplier_id DESC");
				$result->execute();
				$rowcount = $result->rowcount();
			?>
			<div style="text-align:center; margin-bottom: 10px;">
			Total Number of Suppliers: <span style="color: #fff; font-size: 12pt; background:#388E3C; width:200px; margin: auto; padding: 5px; border-radius: 10px;" class="badge"><?php echo $rowcount;?></span>
			</div>
</div>
<input type="text" name="filter" style="height:35px; margin-top: -1px;" value="" id="filter" placeholder="Search Supplier..." autocomplete="off" />
<a rel="facebox" href="addsupplier.php"><Button type="submit" class="btn btn-info" style="float:right; width:230px; height:35px;" /><i class="icon-plus-sign icon-large"></i> Add Supplier</button></a><br><br>

<div class="table-container">
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th> Supplier </th>
			<th> Contact No. </th>
			<th> Address </th>
			<th> Contact Name</th>
			<th> Note</th>
			<th width="120"> Action </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$result = $link->prepare("SELECT * FROM supliers ORDER BY suplier_id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td><?php echo $row['suplier_name']; ?></td>
			<td><?php echo $row['contact_person']; ?></td>
			<td><?php echo $row['suplier_address']; ?></td>
			<td><?php echo $row['suplier_contact']; ?></td>
			<td><?php echo $row['note']; ?></td>
			<td><a rel="facebox" href="editsupplier.php?id=<?php echo $row['suplier_id']; ?>"><button class="btn btn-warning btn-mini"><i class="icon-edit"></i> Edit </button></a>
			<a href="#" id="<?php echo $row['suplier_id']; ?>" class="delbutton" title="Click To Delete"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Delete</button></a></td>
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
 if(confirm("Are you sure want to delete? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deletesupplier.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
</body>
<?php include('footer.php');?>

</html>