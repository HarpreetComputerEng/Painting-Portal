<?php 
include("Header.php"); 
include("Menu.php");
?>
<?php
session_start();

if (!isset($_SESSION['EmailAddress'])) {
    header("Location: Login.php");
    exit();
}

$host = "localhost";
$username = "cst8238";
$password = "cst@8238";
$database = "cst8238_25s";

try {
    
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View All Employees</title>
</head>
<body>

    <div class="section">
        <h1>Session State Data</h1>
        <p><strong>First Name:</strong> <?php echo ($_SESSION['FirstName']) ?></p>
        <p><strong>Last Name:</strong> <?php echo ($_SESSION['LastName']) ?></p>
        <p><strong>Email:</strong> <?php echo ($_SESSION['EmailAddress']) ?></p>
        <p><strong>Phone Number:</strong> <?php echo ($_SESSION['TelephoneNumber']) ?></p>
        <p><strong>SIN:</strong> <?php echo ($_SESSION['SocialInsuranceNumber']) ?></p>
        <p><strong>Password:</strong> <?php echo ($_SESSION['Password']) ?></p>
    </div>

    <div class="table">
        <h1>Database Data</h1>

        <?php
        try {
            $sqlquery = "SELECT * FROM Employee";
            $result = $pdo->query( $sqlquery );
            
            if ($result) {
                echo "<table>";
                
                echo "<tr>";
                
                    echo "<th>Employee Id</th>";
                    echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>Email Address</th>";
                    echo "<th>Phone Number</th>";
                    echo "<th>SIN</th>";
                    echo "<th>Password</th>";
                
                echo "</tr>";

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No employee records found.</p>";
            }

        } catch (PDOException $e) {
            echo "Error fetching data: " . $e->getMessage();
        }
        ?>

    </div>

</body>
</html>

<?php include("Footer.php"); ?>
