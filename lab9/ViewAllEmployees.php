<?php 
include("Header.php"); 

session_start();

// Redirect if not logged in
if (!isset($_SESSION['EmailAddress'])) {
    header("Location: Login.php");
    exit();
}

// Database credentials
$host = "localhost";
$username = "cst8238";
$password = "cst@8238";
$database = "cst8238_25s";

// Connect to database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<h2>Session State Data</h2>
<p><strong>First Name:</strong> <?php echo $_SESSION['FirstName']; ?></p>
<p><strong>Last Name:</strong> <?php echo $_SESSION['LastName']; ?></p>
<p><strong>Email:</strong> <?php echo $_SESSION['EmailAddress']; ?></p>
<p><strong>Phone Number:</strong> <?php echo $_SESSION['TelephoneNumber']; ?></p>
<p><strong>SIN:</strong> <?php echo $_SESSION['SocialInsuranceNumber']; ?></p>
<p><strong>Password:</strong> <?php echo $_SESSION['Password']; ?></p>

<h2>All Employee Records</h2>
<?php
try {
    $sql = "SELECT * FROM Employee";
    $result = $pdo->query($sql);

    if ($result->rowCount() > 0) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr>";

        // Get column names
        for ($i = 0; $i < $result->columnCount(); $i++) {
            $columnMeta = $result->getColumnMeta($i);
            echo "<th>" . htmlspecialchars($columnMeta['name']) . "</th>";
        }

        echo "</tr>";

        // Print rows
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No employees found in the database.</p>";
    }
} catch (PDOException $e) {
    echo "Error retrieving employees: " . $e->getMessage();
}
?>

<?php include("Footer.php"); ?>
