<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Genre</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            <?php
            // Database access code to retrieve genre from the database
            $genreQuery = "SELECT * FROM genre ORDER BY genreName";
            $ret = mysqli_query($con, $genreQuery);
            
            if(mysqli_num_rows($ret) > 0) {
                while($row = mysqli_fetch_array($ret)) {
            ?>
            <li class="dropdown menu-item">
                <a href="genre.php?genre=<?php echo $row['id']; ?>" class="dropdown-toggle">
                    <?php echo htmlentities($row['genreName']); ?>
                </a>
            </li>
            <?php 
                }
            }
            ?>
        </ul>
    </nav>
</div>