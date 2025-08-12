<?php 
include("Header.php"); 
include("Menu.php");
?>
<?php 
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $host = "localhost";
    $username = "cst8238";
    $password = "cst@8238";
    $database = "cst8238_25s";
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $fName = $pdo->quote($_POST['FirstName']);
        $lName = $pdo->quote($_POST['LastName']);
        $emailAddress = $pdo->quote($_POST['EmailAddress']);
        $phoneNumber = $pdo->quote($_POST['TelephoneNumber']);
        $sinNumber = $pdo->quote($_POST['SocialInsuranceNumber']);
        $emailPassword = $pdo->quote($_POST['Password']);
        
        $sqlquery = "INSERT INTO Employee (FirstName, LastName, EmailAddress, TelephoneNumber, SocialInsuranceNumber, Password)
                     VALUES ($fName, $lName, $emailAddress, $phoneNumber, $sinNumber, $emailPassword)";
        
        $result = $pdo->query($sqlquery);
    
        if ($result) {
            $_SESSION['FirstName'] = $_POST['FirstName'];
            $_SESSION['LastName'] = $_POST['LastName'];
            $_SESSION['EmailAddress'] = $_POST['EmailAddress'];
            $_SESSION['TelephoneNumber'] = $_POST['TelephoneNumber'];
            $_SESSION['SocialInsuranceNumber'] = $_POST['SocialInsuranceNumber'];
            $_SESSION['Password'] = $_POST['Password'];
            
                header("Location: ViewAllEmployees.php");
                exit();
            } else {
                echo "Error: " . $sqlquery->error;
            }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

?>

<h2>Create your new account</h2>
<form method="post">
    First Name: <input type="text" name="FirstName"><br>
    Last Name: <input type="text" name="LastName"><br>
    Email Address: <input type="email" name="EmailAddress"><br>
    Phone: <input type="text" name="TelephoneNumber"><br>
    SIN: <input type="text" name="SocialInsuranceNumber"><br>
    Password: <input type="password" name="Password"><br>
    <input type="submit" value="Submit Information">
</form>

<?php include("Footer.php"); ?>
