<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wtproject";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo "Received Username: $username<br>";
    echo "Received Password: $password<br>"; 
    $sql = "SELECT password FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        echo "Query Executed Successfully<br>"; 
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($stored_password);
            $stmt->fetch();
            echo "User Found! Checking password...<br>"; 
            echo "Stored Password: $stored_password<br>"; 
            if ($password === $stored_password) {
                echo "Password Matched! Redirecting...<br>";
                header("Location: index.html");
                exit();
            } else {
                echo "Invalid password.<br>";
            }
        } else {
            echo "Username not found.<br>";
        }
        $stmt->close();
    } else {
        echo "Query Preparation Failed: " . $conn->error . "<br>";
    }
}
$conn->close();
?>
