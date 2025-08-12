	<div class="top-bar animate-dropdown">
		<div class="container">
			<div class="header-top-inner">
				<div class="cnt-account">
					<ul class="list-unstyled">
						<?php if(strlen($_SESSION['login']) == 0) { ?>
						<li><a href="login.php"><i class="icon fa fa-user"></i>Login</a></li>
						<?php } else { ?>
						<li><a href="my-cart.php"><i class="icon fa fa-user"></i>Welcome <?php echo htmlentities($_SESSION['username']); ?></a></li>
						<li><a href="logout.php"><i class="icon fa fa-sign-out"></i>Logout</a></li>
						<?php } ?>
						<li><a href="order-history.php"><i class="icon fa fa-heart"></i>Order History</a></li>
						
						<li><a href="my-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
						
					</ul>
				</div><!-- /.cnt-account -->

				
				<!-- /.cnt-cart -->
				<div class="clearfix"></div>
			</div><!-- /.header-top-inner -->
		</div><!-- /.container -->
	</div><!-- /.header-top -->