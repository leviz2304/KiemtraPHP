<?php
$servername = "localhost";
$username   = "root";
$password   = "Tu@n1111"; 
$database   = "Test1";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
