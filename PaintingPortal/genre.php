<?php
/**
 * Genre Page - Display paintings by specific genre
 * Shows all paintings belonging to a selected art genre
 */
session_start();
error_reporting(0);
include('includes/config.php');

// Get genre ID from URL parameter first
$cid = intval($_GET['genre']);

// Handle add to cart functionality
if(isset($_POST['pid'])) {
    $paintingId = $_POST['pid'];
    
    // Fetch painting details first
    $sql_p = "SELECT * FROM paintings WHERE pid={$paintingId}";
    $query_p = mysqli_query($con, $sql_p);
    
    if(mysqli_num_rows($query_p) != 0) {
        $row_p = mysqli_fetch_array($query_p);
        
        // Check if painting already exists in cart
        if(isset($_SESSION['cart'][$paintingId])) {
            // Increment quantity if already in cart
            $_SESSION['cart'][$paintingId]['qty']++;
        } else {
            // Add new painting to cart
            $_SESSION['cart'][$row_p['pid']] = array(
                "qty" => 1,
                "price" => $row_p['paintingPrice']
            );
        }
        echo "<script>alert('Painting has been added to cart');</script>";
        echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
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

	    <title>Painting Genre</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
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
	
<header class="header-style-1">

	<!-- ============================================== TOP MENU ============================================== -->
<?php include('includes/top-header.php');?>
<!-- ============================================== TOP MENU : END ============================================== -->
<?php include('includes/main-header.php');?>
	<!-- ============================================== NAVBAR ============================================== -->
<?php include('includes/menu-bar.php');?>
<!-- ============================================== NAVBAR : END ============================================== -->

</header>
<!-- ============================================== HEADER : END ============================================== -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row outer-bottom-sm'>
			<div class='col-md-3 sidebar'>
	            
     
<!-- /.side-menu -->
           <div class="sidebar-module-container">
	            	<h3 class="section-title">shop by</h3>
	            	<div class="sidebar-filter">
<!-- ============================================== SIDEBAR CATEGORY ============================================== -->
<div class="sidebar-widget wow fadeInUp outer-bottom-xs ">
	
	<div class="sidebar-widget-body m-t-10">
	
		<div class="accordion">
	    	<div class="accordion-group">
	            <div class="accordion-heading">
	                <?php include('includes/side-menu.php');?>	
	            </div>  
	        </div>
	    </div>
	   
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->

	            	</div><!-- /.sidebar-filter -->
	            </div><!-- /.sidebar-module-container -->
            </div><!-- /.sidebar -->
			<div class='col-md-9'>

	<div id="category" class="category-carousel hidden-xs">
		<div class="item">	
			<div class="image">
				<img src="assets/images/banners/cat-banner-1.jpg" alt="" class="img-responsive">
			</div>
			<div class="container-fluid">
				<div class="caption vertical-top text-left">
					<div class="big-text">
						<br />
					</div>
					
					<div class="excerpt hidden-sm hidden-md">
						<?php
						$ret = mysqli_query($con, "SELECT genreName FROM genre WHERE id='$cid'");
						$row = mysqli_fetch_array($ret);
						echo htmlentities($row['genreName']);
						?>
					</div>
			
				</div><!-- /.caption -->
			</div><!-- /.container-fluid -->
		</div>
</div>

				<div class="search-result-container">
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane active " id="grid-container">
							<div class="category-product  inner-top-vs">
								<div class="row">		
								<?php
								$ret = mysqli_query($con, "SELECT * FROM paintings WHERE genreID='$cid'");
								$num = mysqli_num_rows($ret);
								if($num > 0) {
									while($row = mysqli_fetch_array($ret)) {
								?>							
		<div class="col-sm-6 col-md-4 wow fadeInUp">
			<div class="products">				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<img src="admin/paintingImages/<?php echo htmlentities($row['paintingImage']); ?>" alt="<?php echo htmlentities($row['paintingTitle']); ?>">
			</div><!-- /.image -->			                      		   
		</div><!-- /.painting-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><?php echo htmlentities($row['paintingTitle']); ?></h3>
			<h3 class="name"> Artist: <?php echo htmlentities($row['artistName']); ?></h3>
			

			<div class="product-price">	
				<span class="price">$<?php echo htmlentities($row['paintingPrice']); ?></span>
										     
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">							
							<form name="addtocart" method="post">
							<input type="hidden" name="pid" value="<?php echo htmlentities($row['pid']);?>" />
							<button class="btn btn-primary" type="submit">Add to cart</button>
							</form>
													
						</li>                
		               						
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div>
			</div>
		</div> 		
		<?php } } else { ?>
			<div class="col-md-12">
				<h3>No paintings found for this genre</h3>
			</div>
		<?php } ?>
										</div><!-- /.row -->
							</div><!-- /.category-painting -->
						
						</div><!-- /.tab-pane -->
						
				

				

			</div><!-- /.col -->
		</div></div>
		
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