<?php 
    require '../../config/includes.php';
    require 'session.php';

	my_notify("Logout", $tabs_user_email, "auth");
	session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
	    <meta http-equiv="refresh" content="1;url=../../">
        <title>Logout</title>
        <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="../../css/custom/main.css">
        <link rel="shortcut icon" href="../../images/logo.png" />
    </head>
<?php include '_head.php'; ?>
<body>
	<div class="row" style="margin-top: 10%;">
		<div class="col-lg-12 text-center">
			<div class="bar-loader">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
			<span class="text-uppercase" style="font-size: 27px;">&nbsp;Saving Logs</span>
			<p>please wait.</p>
		</div>
	</div>
    <?php include '_scripts.php'; ?>
</body>
</html>