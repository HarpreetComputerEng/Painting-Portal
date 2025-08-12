<?php 
include("Header.php"); 
include("Menu.php");
?>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST['EmailAddress'];
    $password = $_POST['Password'];

    $host = "localhost";
    $databaseName = "cst8238_25s";
    $username = "cst8238";
    $databasePassword = "cst@8238";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$databaseName", $username, $databasePassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sqlQuery = "SELECT * FROM Employee WHERE EmailAddress = :email AND Password = :password";
        $stmt = $pdo->prepare($sqlQuery);
        $stmt->execute([':email' => $email, ':password' => $password]);
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($employee) {
            $_SESSION['EmployeeID'] = $employee['EmployeeID'];
            $_SESSION['FirstName'] = $employee['FirstName'];
            $_SESSION['LastName'] = $employee['LastName'];
            $_SESSION['EmailAddress'] = $employee['EmailAddress'];
            $_SESSION['TelephoneNumber'] = $employee['TelephoneNumber'];
            $_SESSION['SocialInsuranceNumber'] = $employee['SocialInsuranceNumber'];
            $_SESSION['Password'] = $employee['Password'];
            
            header("Location: ViewAllEmployees.php");
            exit();
        } else {
            $error = "Invalid email address or password.";
        }
    } catch (PDOException $error) {
        $error = "Database error: " . $error->getMessage();
    }
    
}
?>

<h2>Login</h2>
<form method="post">
    Email Address: <input type="email" name="EmailAddress"><br>
    Password: <input type="password" name="Password"><br>
    <input type="submit" value="Login">
</form>
<?php
if (!empty($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>
<?php include("Footer.php"); ?>
