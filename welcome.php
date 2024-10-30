<style>
    table{
        /* margin:auto;
        background-color: #2a2727 ; */
        padding:50px;
        margin-top:30px;
        color:white;
    }
    b{
        color:darkcyan;
    }
    h1{
        font-family: "Henk-Work", serif;
    }
</style>
<?php
session_start();
include('header.php');
require('connection.php'); 
if (!isset($_POST['username'])&&!isset($_POST['password'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";
    $stmt = $conn->prepare("SELECT * FROM users WHERE username_value = ?");

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password == $user['password_value']){
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['user_id']=$user['user_id'];
            if(!empty($_SESSION['first_name'])){
            echo "<table>
            <tr><td><h1 style='color:white;font-size:70px;letter-spacing:2px;'>WELCOME<br> BACK!</h1></td></tr>
            <tr><td><h2 style='color:yellow;font-size:30px'>" . htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']) . "</h2></td></tr>
            <tr></tr>
           <tr><td><b>YOUR USER ID:</b>".htmlspecialchars($user['user_id'])."</td></tr>
</table>";
            }
            else{
                echo "<table>
            <tr><td><h1 style='color:white;font-size:70px;'>WELCOME <br>NEW USER!</h1></td></tr>
               <tr><td><b>YOUR NEW USER ID:  </b>".htmlspecialchars($user['user_id'])."<br><br>Please provide your details</td></tr>
</table>";
            }
        }
    else {
            echo '<script type="text/javascript">',
            'alert("This is wrong password!");',
            'window.location.href = "', 'login.php', '";',
            '</script>';                //invalid password
        }
    } else {
        echo '<script type="text/javascript">',
            'alert("This is wrong username!");',
            'window.location.href = "', 'login.php', '";',
            '</script>';                //invalid username
    }
    $stmt->close();
}
$conn->close();
include('footer.php');
?>
