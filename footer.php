<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Builder</title>
    <style>
        footer {
            color: darkorange;
            padding: 15px 0;
            text-align: center;
            position:fixed;
            bottom: 0;
            width: 100%;
            height : 5%;
            margin-left:-100px;
            background:none;
        }
        footer a {
            color: black;
            text-decoration: none;
            margin: 0 5px;
        }
        footer a:hover {
            color:red;
            text-decoration: none;
        }
        footer p{
            margin-left:250px;
        }
    </style>
</head>
<body>
    <div class="container">
    </div>
    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Resume Builder. All rights reserved.  
                <a href="privacy_policy.php">Privacy Policy</a> |
                <a href="contact.php">Contact us</a>
            </p>
        </div>
    </footer>
</body>
</html>
