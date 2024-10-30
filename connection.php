<?php
$servername="localhost";
$username = "root";
$password = "";
$dbname = "resume";
$conn = new mysqli($servername,$username, $password,$dbname);
if ($conn->connect_error) { 
    die("Connection failure: ". $conn->connect_error); 
}
?>