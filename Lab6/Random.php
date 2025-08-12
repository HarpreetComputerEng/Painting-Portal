<?php
include("Header.php");
?>

<div class="card">
    <div class="card-header bg-info text-white">
        <h3>Random Numbers Histogram</h3>
    </div>
    <div class="card-body">
        <?php
        // initialize counters for the code
        $r1 = $r2 = $r3 = $r4 = $r5 = 0;

        // generated any   500 randm numbers
        for ($i = 0; $i < 500; $i++) {
            $num = rand(1, 50);
            
            if ($num >= 1 && $num <= 10) $r1++;
            else if ($num >= 11 && $num <= 20) $r2++;
            else if ($num >= 21 && $num <= 30) $r3++;
            else if ($num >= 31 && $num <= 40) $r4++;
            else $r5++;
        }

        // show totals on screen
        echo "$r1 numbers are randomly generated in the range between 01 - 10.<br>";
        echo "$r2 numbers are randomly generated in the range between 11 - 20<br>";
        echo "$r3 numbers are randomly generated in the range between 21 - 30<br>";
        echo "$r4 numbers are randomly generated in  range between 31 - 40.<br>";
        echo "$r5 numbers are randomly generated in the range between 41 - 50<br><br>";

        echo "Histogram of stars as a percentag of number of values are displayed below .<br>";

        // percentage formuale
        function drawStars($count) {
            $percent = ($count * 100) / 500;
            $stars = round($percent / 2); 
            return str_repeat("*", $stars);
        }

        echo "01 - 10: " . drawStars($r1) . "<br>";
        echo "11 - 20: " . drawStars($r2) . "<br>";
        echo "21 - 30: " . drawStars($r3) . "<br>";
        echo "31 - 40: " . drawStars($r4) . "<br>";
        echo "41 - 50: " . drawStars($r5) . "<br>";
        ?>
        
</div>
<?php
include("Footer.php");
?>
