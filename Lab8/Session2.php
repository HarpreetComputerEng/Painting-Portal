<?php
session_start();
include 'Header.php';
?>

<div style="padding: 10px;">
    <h4>Session Data</h4>
    <?php
    if (isset($_SESSION['first_name'])) {
        echo "First Name: " . $_SESSION['first_name'] . "<br>";
        echo "Last Name: " . $_SESSION['last_name'] . "<br>";
        echo "Phone: " . $_SESSION['phone'] . "<br>";
        echo "Type: " . $_SESSION['type'] . "<br>";
        echo "Game: " . $_SESSION['game'] . "<br>";
    } else {
        echo "No session data found.";
    }
    ?>
</div>

<?php include 'Footer.php'; ?>
