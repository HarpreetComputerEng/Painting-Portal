<?php 
/**
 * Payment Method Page
 * Allows users to select payment method and complete their order
 */
session_start();
error_reporting(0);
include('includes/config.php');

// Process order submission if form is submitted
if(isset($_POST['submit'])) {
    // Ensure user is logged in before processing
    if(strlen($_SESSION['login']) == 0) {
        header('location:login.php');
        exit();
    }
    
    // Get payment method selection
    $paymentmethod = $_POST['paymentmethod'];
    $userId = $_SESSION['uid'];
    
    // Create order records for each item in cart
    if(isset($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $key => $qty) {
            $insertorder = "INSERT INTO orders(userId,paintingId,quantity,orderDate,paymentMethod,orderStatus) VALUES('$userId','$key','".$qty['qty']."',NOW(),'$paymentmethod','Order Placed')";
            mysqli_query($con, $insertorder);
        }
        
        // Clear shopping cart after successful order
        unset($_SESSION['cart']);
        echo "<script>alert('Your order has been placed successfully. Order details have been sent to your registered email ID');</script>";
        echo "<script type='text/javascript'> document.location ='order-history.php'; </script>";
    }
}

// Check if user is logged in for page access
if(strlen($_SESSION['login']) == 0) {
    header('location:login.php');
    exit();
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

	    <title>Payment Method</title>

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
				<li><a href="my-cart.php">Shopping Cart</a></li>
				<li class='active'>Payment Method</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="checkout-box inner-bottom-sm">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
						<div class="panel panel-default checkout-step-01">
							<div class="panel-heading">
								<h4 class="unicase-checkout-title">
									<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
										<span>1</span>Choose Payment Method
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in">
								<div class="panel-body">
									<form name="payment" method="post">
										<div class="payment-methods">
											<div class="payment-method">
												<label class="radio">
													<input type="radio" name="paymentmethod" value="Debit Card" checked> Debit Card / Master Card / Visa Card
												</label>
											</div>
											<div class="payment-method">
												<label class="radio">
													<input type="radio" name="paymentmethod" value="Credit Card"> Credit Card
												</label>
											</div>
											<div class="payment-method">
												<label class="radio">
													<input type="radio" name="paymentmethod" value="PayPal"> PayPal
												</label>
											</div>
											<div class="payment-method">
												<label class="radio">
													<input type="radio" name="paymentmethod" value="Cash on Delivery"> Cash on Delivery
												</label>
											</div>
										</div>
										<div class="clearfix"></div>
										<button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button">SUBMIT</button>
									</form>
								</div>
							</div>
						</div>
						<!-- checkout-step-01  -->
					</div><!-- /.checkout-steps -->
				</div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
					<div class="checkout-progress-sidebar">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title">Your Checkout Progress</h4>
								</div>
								<div class="">
									<ul class="nav nav-checkout-progress list-unstyled">
										<li><a href="my-cart.php">Shopping Cart</a></li>
										<li class="active"><a href="#">Payment Method</a></li>
										<li><a href="#">Order Confirmation</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- checkout-progress-sidebar -->

					<div class="checkout-progress-sidebar">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title">Order Summary</h4>
								</div>
								<div class="">
									<ul class="nav nav-checkout-progress list-unstyled">
										<?php
										if(!empty($_SESSION['cart'])) {
											$pdtid = array();
											$sql = "SELECT * FROM paintings WHERE pid IN(";
											foreach($_SESSION['cart'] as $id => $value) {
												$sql .= $id . ",";
											}
											$sql = substr($sql, 0, -1) . ") ORDER BY pid ASC";
											$query = mysqli_query($con, $sql);
											$totalprice = 0;
											$totalqty = 0;
											while($row = mysqli_fetch_array($query)) {
												$subtotal = $_SESSION['cart'][$row['pid']]['qty'] * $row['paintingPrice'];
												$totalprice += $subtotal;
												$totalqty += $_SESSION['cart'][$row['pid']]['qty'];
										?>
										<li><?php echo htmlentities($row['paintingTitle']); ?> (Qty: <?php echo $_SESSION['cart'][$row['pid']]['qty']; ?>) - $<?php echo $subtotal; ?></li>
										<?php } ?>
										<li style="border-top:1px solid #ccc;margin-top:10px;padding-top:10px;"><strong>Total: $<?php echo $totalprice + ($totalqty * 5); ?> (including shipping)</strong></li>
										<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
	</div><!-- /.container -->
</div><!-- /.body-content -->

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