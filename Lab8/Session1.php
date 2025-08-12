<?php
session_start();
include 'Header.php';

// Initialize variables
$errors = array();
$first_name = '';
$last_name = '';
$phone = '';
$type = '';
$game = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : '';
    $last_name = isset($_POST["last_name"]) ? $_POST["last_name"] : '';
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : '';
    $type = isset($_POST["type"]) ? $_POST["type"] : '';
    $game = isset($_POST["game"]) ? $_POST["game"] : '';
    
    // Validation
    if (empty($type)) {
        $errors[] = "Please select a type (Staff, Student, Faculty).";
    }
    
    if (empty($game)) {
        $errors[] = "Please select a game.";
    }
    
    // If no errors, store in session and redirect
    if (empty($errors)) {
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['phone'] = $phone;
        $_SESSION['type'] = $type;
        $_SESSION['game'] = $game;
        
        header("Location: Session2.php");
        exit();
    }
}
?>

<div style="float: left; width: 45%;">
    <form method="post" action="Session1.php">
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
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($errors)) {
        echo "<h4 style='color:red;'>Please fix the following:</h4>";
        echo "<ul style='color:red;'>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    }
    ?>
</div>

<?php include 'Footer.php'; ?>
