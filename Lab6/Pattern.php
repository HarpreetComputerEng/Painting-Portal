<?php
include("Header.php");
?>

<div class="card">
    <div class="card-header bg-success text-white">
        <h3>Pattern Drawing</h3>
    </div>
    <div class="card-body bg-light">
        <pre>
<?php
// Top part of patternss
for ($i = 1; $i <= 15; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "\n";
}

// Bottom part of pattern which is reverse
for ($i = 14; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "\n";
}
?>
        </pre>
    </div>
</div>

<?php
include("Footer.php");
?>
