<?php
require('connection.php');
$user_id = $_POST['user_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$date_of_birth = $_POST['date_of_birth'];
$phone_num = $_POST['phone_num'];
$email = $_POST['email'];
$father_name = $_POST['father_name'];
$father_occupation = $_POST['father_occupation'];
$mother_name = $_POST['mother_name'];
$mother_occupation = $_POST['mother_occupation'];
$marital_status = $_POST['marital_status'];
$gender = $_POST['gender'];
$skills = $_POST['skills'];

$sql = "UPDATE users SET first_name='$first_name',last_name='$last_name',date_of_birth='$date_of_birth', phone_num='$phone_num', email='$email', father_name='$father_name', father_occupation='$father_occupation', mother_name='$mother_name',mother_occupation='$mother_occupation',marital_status='$marital_status',gender='$gender', skills='$skills'
 WHERE user_id=$user_id";

if ($conn->query($sql) === TRUE) {
  include('list.php');
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>