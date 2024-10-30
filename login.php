<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        .logincontainer {
            font-family: Arial, sans-serif;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }
        .login-container {
            background-color: #388992 ;
            opacity: 0.9;
            color: white;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            margin-top:-60px;
        }
        .login-container h2 {
            color: white;
            margin-bottom: 20px;
            text-decoration: underline;
        }
        .login-container input {
            width: calc(100% - 22px); 
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container .input-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            text-align: left;
        }
        .login-container .input-group label {
            flex: 1;
            margin-right: 10px; 
        }
        .login-container .input-group input {
            flex: 2; 
        }
        .login-container button {
            width: 80%;
            padding: 10px;
            background-color:#af5902;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #ab350f;
        }
        .login-container .error {
            color: red;
            margin-top: 10px;
        }
        .login-container a {
            color: yellow;
        }
        .login-container a:hover {
            color: orange;
        }
        label{
            font-size:18px;
        }
    </style>
</head>
<body>
    <?php include("loginheader.php"); ?>

    <div class="logincontainer">
        <form action="welcome.php" method="post" autocomplete="off" enctype='multipart/form-data'>
            <div class="login-container">
                <h2>Login</h2>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" autocomplete="off" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" autocomplete="off" placeholder="Password" required>
                </div>
                <button type="submit">Login</button>
                <p>Not a member? &nbsp <a href="register.php">REGISTER HERE</a></p>
            </div>
        </form>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>
