<?php include('servers.php') ?>

<html>

<head>
	<title>Pharmacy</title>
	<link rel="shortcut icon" href="main/images/pos.jpg">
	<link href="main/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="main/css/DT_bootstrap.css">
	<link rel="stylesheet" href="main/css/font-awesome.min.css">
	<!--  -->
	<link href="main/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="container-fluid">
	<div class="row-fluid">
		<div class="span4">
			
		</div>

	</div>
	<div id="login">
	<?php
	if (isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0) {
		foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<div style="color: red; text-align: center;">', $msg, '</div><br>';
		}
		unset($_SESSION['ERRMSG_ARR']);
	}
	
	?>
		<form action="register.php" method="post">
        

			<font style=" font:bold 24px 'Aleo'; color:#0084ff">
				<center>CHEBU PHARMACEUTICAL LIMITED</center>
			</font>
			<br>


			<div class="input-prepend">
				<span style="height:30px; width:25px;" class="add-on"><i class="icon-user icon-2x"></i></span><input style="height:40px;" type="text" name="username" Placeholder="Username" required value="<?php echo $username; ?>" /><br>
			</div>
            
			<div class="input-prepend">
				<span style="height:30px; width:25px;" class="add-on"><i class="icon-envelope icon-2x"></i></span><input style="height:40px;" type="email" name="email" Placeholder="Email" required value="<?php echo $email; ?>" /><br>
			</div>
			<div class="input-prepend">
				<span style="height:30px; width:25px;" class="add-on"><i class="icon-lock icon-2x"></i></span><input type="password" style="height:40px;" name="password_1" Placeholder="Password" required /><br>
			</div>
            <div class="input-prepend">
				<span style="height:30px; width:25px;" class="add-on"><i class="icon-lock icon-2x"></i></span><input type="password" style="height:40px;" name="password_2" Placeholder="Confirm Password" required /><br>
			</div>
			<div class="qwe">
			<button class="btn btn-large btn-primary btn-block pull-right"  type="submit" name="reg_user"><i class="icon-signup icon-large"></i>
					Register</button>
					<button class="btn btn-large btn-success btn-block pull-right" ><i class="icon-s icon-large"></i>
					<a href="index.php">Have account?Login </a></button>
					

			</div>
			
		</form>
		
	</div>
	</div>
	
</body>

</html>