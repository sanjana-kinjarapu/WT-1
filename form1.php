<?php
$Name=$_POST["name"];
$Email=$_POST["email"];
$Phone=$_POST["phone"];
$City=$_POST["city"];
$State=$_POST["state"];
$Guests=$_POST["guests"];
$conn=new mysqli('localhost', 'root', '', 'wtproject');
if($conn->connect_error){
    die('Connection Failed:'.$conn->connect_error);
}
else{
    $stmt=$conn->prepare("insert into basic(Name, Email, Phone, City, State, Guests)
    values(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss",$Name, $Email, $Phone, $City, $State, $Guests);
    $stmt->execute();
    echo "<script>alert('Your booking has been done successfully!');</script>";
    echo "We received your booking,THANK YOU for choosing us.We will get back to you soon...";
    $stmt->close();
    $conn->close();
}
?>