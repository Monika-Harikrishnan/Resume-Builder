<?php
require_once('connection.php');
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
   $username_value=isset($_POST['username']) ? $_POST['username'] : "";
   $password_value=isset($_POST['password']) ? $_POST['password'] : "";
   $email=isset($_POST['email']) ? $_POST['email'] : "";
   $phone_num=isset($_POST['phone']) ? $_POST['phone'] : "";

   $_SESSION['username_value'] = $username_value;
   $_SESSION['password_value'] = $password_value;
   $_SESSION['email'] = $email;
   $_SESSION['phone_num'] = $phone_num;

   $personal = "INSERT INTO users (username_value,password_value,phone_num, email) 
    VALUES ('$username_value','$password_value','$phone_num','$email')";
    if ($conn->query($personal) === TRUE) {
        echo '<script type="text/javascript">',
        'alert("Inserted Successfully");',
        'window.location.href = "', 'login.php', '";',
        '</script>';
    } else {
       echo "Error";
    }

}
?>