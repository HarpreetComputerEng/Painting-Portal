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

        $sql = "SELECT * FROM Employee WHERE EmailAddress = :email AND Password = :pass";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $_POST['EmailAddress'],
            ':pass' => $_POST['Password'],
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['EmployeeID'] = $user['EmployeeID'];
            $_SESSION['FirstName'] = $user['FirstName'];
            $_SESSION['LastName'] = $user['LastName'];
            $_SESSION['EmailAddress'] = $user['EmailAddress'];
            $_SESSION['TelephoneNumber'] = $user['TelephoneNumber'];
            $_SESSION['SocialInsuranceNumber'] = $user['SocialInsuranceNumber'];
            $_SESSION['Password'] = $user['Password'];

            header("Location: ViewAllEmployees.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }

    } catch (PDOException $e) {
        $error = "Connection failed: " . $e->getMessage();
    }
}
?>

<h2>Login</h2>
<form method="post">
    Email Address: <input type="email" name="EmailAddress" required><br>
    Password: <input type="password" name="Password" required><br>
    <input type="submit" value="Login">
</form>

<?php
if (!empty($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>

<?php include("Footer.php"); ?>
