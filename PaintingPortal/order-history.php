<?php 
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['login']) == 0) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>Order History</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">

	</head>
    <body class="cnt-home">
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>
</header>

<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="index.php">Home</a></li>
				<li class='active'>Order History</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row inner-bottom-sm">
			<div class="shopping-cart">
				<div class="col-md-12 col-sm-12 shopping-cart-table ">
					<div class="table-responsive">
						<h4>Order History</h4>
						<?php
						$query = mysqli_query($con, "SELECT orders.*, paintings.paintingImage, paintings.paintingTitle, paintings.artistName, paintings.paintingPrice 
						                             FROM orders 
						                             JOIN paintings ON orders.paintingId = paintings.pid 
						                             WHERE orders.userId = '".$_SESSION['uid']."' 
						                             ORDER BY orders.orderDate DESC");
						$num = mysqli_num_rows($query);
						if($num > 0) {
						?>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Order Date</th>
									<th>Image</th>
									<th>Painting Title</th>
									<th>Artist</th>
									<th>Quantity</th>
									<th>Price Per Unit</th>
									<th>Shipping Charge</th>
									<th>Grand Total</th>
									<th>Payment Method</th>
									<th>Order Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
								while($row = mysqli_fetch_array($query)) {
									$grandTotal = ($row['paintingPrice'] * $row['quantity']) + 5; // Adding $5 shipping
								?>
								<tr>
									<td><?php echo htmlentities($row['orderDate']); ?></td>
									<td>
										<img src="admin/paintingImages/<?php echo htmlentities($row['paintingImage']); ?>" alt="" width="80" height="100">
									</td>
									<td><?php echo htmlentities($row['paintingTitle']); ?></td>
									<td><?php echo htmlentities($row['artistName']); ?></td>
									<td><?php echo htmlentities($row['quantity']); ?></td>
									<td>$<?php echo htmlentities($row['paintingPrice']); ?></td>
									<td>$5.00</td>
									<td>$<?php echo $grandTotal; ?></td>
									<td><?php echo htmlentities($row['paymentMethod']); ?></td>
									<td>
										<?php 
										$status = htmlentities($row['orderStatus']);
										if($status == 'Order Placed') {
											echo '<span class="label label-success">Order Placed</span>';
										} else if($status == 'In Process') {
											echo '<span class="label label-warning">In Process</span>';
										} else if($status == 'Delivered') {
											echo '<span class="label label-info">Delivered</span>';
										} else {
											echo '<span class="label label-default">' . $status . '</span>';
										}
										?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<?php } else { ?>
						<div class="col-md-12">
							<h3>No orders found!</h3>
							<p><a href="index.php">Click here to start shopping</a></p>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('includes/footer.php');?>

	<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	<script src="switchstylesheet/switchstylesheet.js"></script>
	
	<script>
		$(document).ready(function(){ 
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
		
</body>
</html>