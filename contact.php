<?php
$Name=$_POST["name"];
$Email=$_POST["email"];
$Phone=$_POST["phone"];
$Services=$_POST["services"];
$Messages=$_POST["message"];
$conn=new mysqli('localhost', 'root', '', 'wtproject');
if($conn->connect_error){
    die('Connection Failed:'.$conn->connect_error);
}
else{
    $stmt=$conn->prepare("insert into contact(Name, Email, Phone, Services, Messages)
    values(?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss",$Name, $Email, $Phone, $Services, $Messages);
    $stmt->execute();
    echo "<script>alert('Your details have been received successfully!');</script>";
    echo "We received your details, go BACK to continue...";
    $stmt->close();
    $conn->close();
}
?>
