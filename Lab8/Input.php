<?php include 'Header.php'; ?>

<?php
// Define variables
$errors = array();
$first_name = '';
$last_name = '';
$phone = '';
$type = '';
$game = '';

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : '';
    $last_name = isset($_POST["last_name"]) ? $_POST["last_name"] : '';
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : '';
    $type = isset($_POST["type"]) ? $_POST["type"] : '';
    $game = isset($_POST["game"]) ? $_POST["game"] : '';

    // Validation
    if (empty($type)) {
        $errors[] = "Mandatory! Please select a type (Staff, Student, Faculty).";
    }

    if (empty($game)) {
        $errors[] = "Mandatory!Please select a game.";
    }
}
?>

<div style="float: left; width: 45%;">
    <form method="post" action="Input.php">
        <p>First Name: <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>"></p>
        <p>Last Name: <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>"></p>
        <p>Phone Number: <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"></p>
        
        <p>Type:
            Staff <input type="radio" name="type" value="Staff" <?php if ($type == 'Staff') echo 'checked'; ?>>
            Student <input type="radio" name="type" value="Student" <?php if ($type == 'Student') echo 'checked'; ?>>
            Faculty <input type="radio" name="type" value="Faculty" <?php if ($type == 'Faculty') echo 'checked'; ?>>
        </p>

        <p>
            Game:
            <select name="game">
                <option value="">--Select--</option>
                <option value="Hockey" <?php if ($game == 'Hockey') echo 'selected'; ?>>Hockey</option>
                <option value="Basketball" <?php if ($game == 'Basketball') echo 'selected'; ?>>Basketball</option>
                <option value="Soccer" <?php if ($game == 'Soccer') echo 'selected'; ?>>Soccer</option>
                <option value="Tennis" <?php if ($game == 'Tennis') echo 'selected'; ?>>Tennis</option>
            </select>
        </p>

        <input type="submit" value="Submit Information">
    </form>  
</div>

<div style="float: left; width: 45%; padding-left: 20px;">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($errors)) {
            echo "<h4 style='color:black;'>Please check the following:</h4>";
            echo "<ul style='color:b;ack;'>";
            foreach ($errors as $error) {
                echo "<li>" . $error . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<h4>Submitted Information</h4>";
            echo "First Name: " . htmlspecialchars($first_name) . "<br>";
            echo "Last Name: " . htmlspecialchars($last_name) . "<br>";
            echo "Phone: " . htmlspecialchars($phone) . "<br>";
            echo "Type: " . htmlspecialchars($type) . "<br>";
            echo "Game: " . htmlspecialchars($game) . "<br>";
        }
    }
    ?>
</div>

<?php include 'Footer.php'; ?>
