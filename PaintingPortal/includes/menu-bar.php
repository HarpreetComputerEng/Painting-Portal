<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
	<div class="nav-outer">
		<ul class="nav navbar-nav">
			<li class="active dropdown yamm-fw">
				<a href="index.php" data-hover="dropdown" class="dropdown-toggle">Home</a>
				
			</li>
              <?php
              // Database access code to retrieve genre from the database
              $ret = mysqli_query($con, "SELECT * FROM genre");
              while($row = mysqli_fetch_array($ret)) {
              ?>
			<li class="dropdown yamm">
				<a href="genre.php?genre=<?php echo $row['id']; ?>" data-hover="dropdown" class="dropdown-toggle">
					<?php echo htmlentities($row['genreName']); ?>
				</a>
			</li>
			<?php } ?>
			

			
		</ul><!-- /.navbar-nav -->
		<div class="clearfix"></div>				
	</div>
</div>


            </div>
        </div>
    </div>
</div>