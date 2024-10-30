<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Builder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin:0;
            padding:0;
            width:100%;
            background-image:url('resumebg.jpg ');
            background-repeat:no-repeat;
            background-size:cover;
        }
        header {
            color:white;
            padding: 15px 0;
            text-align: center;
        }
        header img{
            float:left;
            border-radius: 50%;
            margin-top:-5px;
        }
        header h1{
            margin-top:5px;
            font-family: cusive;
            color:white;
            float:left;
            font-size: 30px;
        }
        header nav {
            margin-right: -25rem;
            margin-top: 10px;
        }
        header nav a {    
            color: darkcyan ;
            text-decoration: none;
            margin: 0 15px;
            font-size: 20px;
            font-weight:bold;
        }
        header nav a:hover {
            color:white;
        }
        .container {
            width: 100%;
            margin: auto;
            overflow: hidden;
            margin-left:20px;
        }
        .logout_button{
            background-color:orange;
            color:white;
            border-radius:10px;
            border:none;
            padding:10px;
        }
        .logout_button:hover{
            background-color:darkorange;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var link = document.getElementById('myLink');
    link.addEventListener('click', function(event) {
        event.preventDefault();
        alert('Are you sure!');
    });
});
    </script>
</head>
<body>
    <header>
        <div class="container">
            <nav>
            <img src="logo.jpg" alt="CV" width="60px" height="60px">
            <h1>Resume Builder</h1>
                <a href="welcome.php">Home</a>
                <a href="index.php">Create</a>
                <a href="view.php">View</a>
                <a href="edit.php">Edit</a>
                <a href="delete.php" id="myLink">Delete</a>
                <a href="logout.php" class="logout_button">Logout</a>
            </nav>
        </div>
    </header>
</body>
</html>
