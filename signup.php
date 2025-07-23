<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wtproject";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user = $_POST['username'];
$pass = $_POST['password'];
$user = mysqli_real_escape_string($conn, $user);
$pass = mysqli_real_escape_string($conn, $pass);
$sql = "SELECT * FROM users WHERE username='$user'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Username already taken";
} else {
    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! Welcome, ". $user;
        header('location:index.html');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
