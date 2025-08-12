<?php
include("Header.php");
?>

<div class="card">
    <div class="card-header bg-info text-white">
        <h3>99 Bottles of Beer</h3>
    </div>
    <div class="card-body">
        <?php
        for ($i = 99; $i >= 0; $i--) {
            if ($i > 1) {
                echo "<p>$i bottles of beer on the wall...<br>
                You take one down, you pass it around...<br>
                " . ($i - 1) . " bottle" . (($i - 1) > 1 ? "s" : "") . " of beer on wall.</p>";
            } elseif ($i === 1) {
                echo "<p>1 bottle of beer on the wall...<br><br>
                You take one down, you pass it around...<br><br>
                0 bottle of beer on the wall.</p>";
            } else {
                echo "<p> no more bottles of beer here.</p>";
            }
        }
        ?>
    </div>
</div>

<?php
include("Footer.php");
?>
