<?php
include("Header.php");
?>

<div class="card">
    <div class="card-header bg-info text-white">
        <h3>Even/Odd Guests Bottles Song ..</h3>
    </div>
    <div class="card-body">
        <?php
        for ($i = 99; $i >= 1; $i--) {
            if ($i % 2 == 0) {
                echo "<p>$i bottles of beer can serve <strong>even</strong> number of guests</p>";
            } else {
                echo "<p>$i bottles of beer can serve <strong>odd</strong> number of guests.</p>";
            }
        }
        ?>
    </div>
</div>

<?php
include("Footer.php");
?>
