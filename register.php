<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
       .formcontainer {
            font-family: Arial, sans-serif;
            background-image: url('background_image.jpg');
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            margin-top:50px;
        }
        .form-container {
            background-color: #2a2727 ;
            opacity:0.9;
            color:white;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .form-container h2 {
            color: #1c7d76;
            margin-bottom: 20px;
            text-decoration: underline;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container button {
            width: 50%;
            padding: 10px;
            background-color: #36b1a7 ;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #1c7d76;
        }
        .form-container .error {
            color: red;
            margin-top: 10px;
        }
        .form-container a{
            color:yellow;
        }
        .form-container a:hover{
            color:orange;
        }
        img{
            float:left;
            border-radius: 50%;
            margin-top:-5px;
        }
        h1{
            color:white;
            margin-top:5px;
            font-family: cusive;
            float:left;
            font-size: 30px;
        }
    </style>
</head>
<body class="formcontainer">
    <div class="form-container">
    <img src="logo.jpg" alt="CV" width="60px" height="60px">
    <h1>Resume Builder</h1>
        <h2>Register</h2>
        <form action="register_validate.php" method="post" enctype='multipart/form-data'>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required>
            
            <button type="submit">Register</button>
        </form>
    </div>
</body>
<?php
include("footer.php");
?>
</html>
