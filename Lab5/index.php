<?php
// Set time zone to Canada 
date_default_timezone_set('America/Toronto'); 

// Include the header
include 'header.php';
?>

<div class="container my-5">
    <?php
    // Declare name variables
    $first_name = "Harpreet";
    $last_name = "Singh";

    // Declare student number as constant
    define("STUDENT_NUMBER", "41127993");

    // Display full name
    echo "<p><strong>Name:</strong> $first_name $last_name</p>";

    // Display student number
    echo "<p><strong>Student Number:</strong> " . STUDENT_NUMBER . "</p>";

    // Concatenate and display message
    $part1 = "Hello World!! ";
    $part2 = "This is the first time I am using PHP!!";
    $message = $part1 . $part2;
    echo "<p>$message</p>";

    // Display current date and time
    echo "<p><strong>Today is:</strong> " . date("Y/m/d") . "</p>";
    echo "<p><strong>The current time is:</strong> " . date("h:i:s A") . "</p>";

    // Display yesterday and last Friday
    echo "<p><strong>Yesterday was:</strong> " . date("Y-m-d", strtotime("-1 day")) . "</p>";
    echo "<p><strong>Last Friday was:</strong> " . date("Y-m-d", strtotime("last Friday")) . "</p>";

    // Use specified numbers for min/max
    $numbers = [0, 150, -50, 100, -150];
    echo "<p><strong>Minimum value of (0, 150, -50, 100, -150) is:</strong> " . min($numbers) . "</p>";
    echo "<p><strong>Maximum value of (0, 150, -50, 100, -150) is:</strong> " . max($numbers) . "</p>";

    // Calculate area of circle with radius 5 cm
    $radius = 5;
    $area = pi() * pow($radius, 2);
    echo "<p><strong>The area of a circle with radius 5 cm is:</strong> " . number_format($area, 2) . " cm²</p>";
    ?>
</div>

<?php
// Include footer
include 'footer.php';
?>
