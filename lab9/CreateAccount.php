<?php 
include("Header.php"); 

session_start(); 
?>

<?php
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $database = "cst8238_25s";
    $username = "cst8238";
    $password = "cst@8238";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO Employee (FirstName, LastName, EmailAddress, TelephoneNumber, SocialInsuranceNumber, Password)
                VALUES (:first, :last, :email, :phone, :sin, :pass)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':first' => $_POST['FirstName'],
            ':last' => $_POST['LastName'],
            ':email' => $_POST['EmailAddress'],
            ':phone' => $_POST['TelephoneNumber'],
            ':sin' => $_POST['SocialInsuranceNumber'],
            ':pass' => $_POST['Password'],
        ]);

        $_SESSION['FirstName'] = $_POST['FirstName'];
        $_SESSION['LastName'] = $_POST['LastName'];
        $_SESSION['EmailAddress'] = $_POST['EmailAddress'];
        $_SESSION['TelephoneNumber'] = $_POST['TelephoneNumber'];
        $_SESSION['SocialInsuranceNumber'] = $_POST['SocialInsuranceNumber'];
        $_SESSION['Password'] = $_POST['Password'];

        header("Location: ViewAllEmployees.php");
        exit();

    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>

<h2>Create Your New Account</h2>
<form method="post">
    First Name: <input type="text" name="FirstName" required><br>
    Last Name: <input type="text" name="LastName" required><br>
    Email Address: <input type="email" name="EmailAddress" required><br>
    Phone: <input type="text" name="TelephoneNumber" required><br>
    SIN: <input type="text" name="SocialInsuranceNumber" required><br>
    Password: <input type="password" name="Password" required><br>
    <input type="submit" value="Submit Information">
</form>

<?php 
if (!empty($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>

<?php include("Footer.php"); ?>
