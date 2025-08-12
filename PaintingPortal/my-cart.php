<?php 
/**
 * Shopping Cart Page - Display and manage cart items
 * Allows users to view, update quantities, and remove items from cart
 */
session_start();
error_reporting(0);
include('includes/config.php');

// Handle checkout process first
if(isset($_POST['ordersubmit'])) {
    // Check if user is logged in before proceeding to checkout
    if(strlen($_SESSION['login']) == 0) {
        header('location:login.php');
    } else {
        header('location:payment-method.php');
    }
}

// Handle cart updates and item removal
if(isset($_POST['submit'])) {
    // First update quantities for cart items
    if(isset($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $key => $val) {
            if(isset($_POST["qty$key"])) {
                $_SESSION['cart'][$key]['qty'] = $_POST["qty$key"];
            }
        }
    }
    
    // Then remove selected items from cart
    if(!empty($_POST['remove_code'])) {
        foreach($_POST['remove_code'] as $key) {
            unset($_SESSION['cart'][$key]);
        }
        echo "<script>alert('Painting removed from cart');</script>";
    }
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

	    <title>My Cart</title>
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<!-- Demo Purpose Only. Should be removed in production : END -->

		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">

		<!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

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
				<li><a href="#">Home</a></li>
				<li class='active'>Shopping Cart</li>
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
<form name="cart" method="post">	
<?php
if(!empty($_SESSION['cart'])) {
?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="cart-romove item">Remove</th>
					<th class="cart-description item">Image</th>
					<th class="cart-product-name item">Painting Title</th>
			
					<th class="cart-qty item">Quantity</th>
					<th class="cart-sub-total item">Price Per unit</th>
					<th class="cart-sub-total item">Shipping Charge</th>
					<th class="cart-total last-item">Grand Total</th>
				</tr>
			</thead><!-- /thead -->
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							<span class="">
								<a href="index.php" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
								<input type="submit" name="submit" value="Update shopping cart" class="btn btn-upper btn-primary pull-right outer-right-xs">
							</span>
						</div><!-- /.shopping-cart-btn -->
					</td>
				</tr>
			</tfoot>
			<tbody>
 <?php
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
    array_push($pdtid, $row['pid']);
?>

				<tr>
					<td class="romove-item"><input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['pid']); ?>" /></td>
					<td class="cart-image">
						<img src="admin/paintingImages/<?php echo htmlentities($row['paintingImage']); ?>" alt="" width="114" height="146">						
					</td>
					<td class="cart-product-name-info">
						<h4 class='cart-product-description'>
						<?php echo htmlentities($row['paintingTitle']); ?>
						</h4>
						
						
					</td>
					<td class="cart-product-quantity">
						<div class="quant-input">
				                <div class="arrows">
				                  <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
				                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
				                </div>
				             <input type="text" value="<?php echo $_SESSION['cart'][$row['pid']]['qty']; ?>" name="qty<?php echo htmlentities($row['pid']); ?>">
				             
			              </div>
		            </td>
					<td class="cart-product-sub-total"><span class="cart-sub-total-price">
					$<?php echo $row['paintingPrice']; ?>.00</span>
					</td>
                    <td class="cart-product-sub-total"><span class="cart-sub-total-price">
                    $5.00</span>
                    </td>

					<td class="cart-product-grand-total"><span class="cart-grand-total-price">
					$<?php echo ($subtotal+5); ?>.00</span>
					</td>
				</tr>

				<?php 
				$_SESSION['qnty'] = $totalqty;
}
?>
				
			</tbody><!-- /tbody -->
		</table><!-- /table -->
		
	</div>
</div><!-- /.shopping-cart-table -->			
<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Shipping Address</span>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
						<?php 
						if(strlen($_SESSION['login']) == 0) {
						    echo "You need to login to see shipping address";
						} else {
						    $query = mysqli_query($con, "SELECT shippingAddress FROM users WHERE emailId='".$_SESSION['login']."'");
						    $row = mysqli_fetch_array($query);
						    echo htmlentities($row['shippingAddress']);
						}
						?>
		
						</div>
					
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div>

<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Billing Address</span>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
						<?php 
						if(strlen($_SESSION['login']) == 0) {
						    echo "You need to login to see billing address";
						} else {
						    $query = mysqli_query($con, "SELECT billingAddress FROM users WHERE emailId='".$_SESSION['login']."'");
						    $row = mysqli_fetch_array($query);
						    echo htmlentities($row['billingAddress']);
						}
						?>
		
						</div>
					
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div>
<div class="col-md-4 col-sm-12 cart-shopping-total">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					
					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md">$<?php echo ($totalprice+(5*$totalqty)); ?>.00</span>
					</div>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
							<button type="submit" name="ordersubmit" class="btn btn-primary">PROCCED TO CHECKOUT</button>
						
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table>
	<?php 
	$_SESSION['tp'] = $totalprice+(5*$totalqty);
	?>
</div>			
<?php } else { ?>
<div class="col-md-12">
    <h3>Your shopping cart is empty!</h3>
    <p><a href="index.php">Click here to continue shopping</a></p>
</div>
<?php } ?>
</div>
</div> 
</form>

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