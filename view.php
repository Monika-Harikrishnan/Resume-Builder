<style>
/* Overall Container */
.box {
    display: flex;
    justify-content: space-between;
    gap: 0px;
    padding: 0px;
    background-color: white;
    width: 60%;
    margin: auto;
}

/* Right Side Containers */
.right-side {
    flex: 1;
}
.container6{
    height:360px;
}
.container2, .container4, .container6 {
    background-color: #2d3c57 ;
    color: white;
    border: 2px solid #2d3c57;
    margin-bottom: 0px;
    padding: 20px;
    margin-right:150px;
    font-size:15px;
    word-spacing:2px;
    line-height:1.8;
}

.container2 h2, .container4 h2, .container6 h2 {
    font-size:18px;
    margin-top: 0;
}

/* Left Side Containers */
.left-side {
    flex: 1;
}
.container1{
    margin-top:0px;
}
.container1, .container3, .container5 {
    border: 2px solid white ;
    margin-bottom: 0px;
    padding: 0px;
    border-radius: 8px;
    background-color: white;
    margin-left:-120px;
    margin-right: 10px;
    font-size:15px;
}
.container1 h3{
    color:#646567 ;
    letter-spacing:2px;
    font-family: Georgia;
    font-size:22px;
}
.container1 h2, .container3 h2, .container5 h2 {
    margin-top: 0;
   color: #2d3c57;
   font-size:18px;
}

hr {
    border: 1px solid #376c6a;
}

/* Resume Item Styles */
.resume-item {
    margin-bottom: 20px;
}

.resume-item strong {
    display: block;
    margin-bottom: 5px;
}
button{
    background-color:green;
    border:none;
    color:white;
    font-size:18px;
    margin-left:50%;
    margin-top:2rem;
    margin-bottom:1rem;
    padding:10px;
    border-radius:5px;
}
</style>
<?php
session_start();
include('header.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if (!empty($_SESSION['first_name'])) {
    require('connection.php'); 

    $user_id = $_SESSION['user_id'];

    // Prepare SQL statement with a placeholder
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo "<div class='box' id='resume-content'>";

        // Right Side Containers (previously left-side)
        echo "<div class='right-side'>";

        // Addresses
        $stmt_addr = $conn->prepare("SELECT address1, address2, city, address_state, country, pincode FROM addresses WHERE user_id = ?");
        $stmt_addr->bind_param("i", $user_id);
        $stmt_addr->execute();
        $result_addr = $stmt_addr->get_result();
        echo "<div class='container2'>";
        echo "<img src = 'profile.jpg' alt='image' height='130px' width='130px' style='margin-left:30px;border-radius:50%;border:2px solid white'>";
        echo "<br><br><h2>Addresses</h2>";
        echo "<hr>";
        while ($address = $result_addr->fetch_assoc()) {
            echo  htmlspecialchars($address['address1']) . ",<br>" .
                htmlspecialchars($address['address2']) . ",<br>" .
                htmlspecialchars($address['city']) . ",<br>" .
                htmlspecialchars($address['address_state']) . ",<br>" .
                htmlspecialchars($address['country']) . ",<br>" .
                htmlspecialchars($address['pincode']) . ".";
        }
        echo "</ul></div>";

        // Education
        $stmt_edu = $conn->prepare("SELECT specialization, institution, year_of_passing, edu_percentage FROM educations WHERE user_id = ?");
        $stmt_edu->bind_param("i", $user_id);
        $stmt_edu->execute();
        $result_edu = $stmt_edu->get_result();
        echo "<div class='container4'><h2>Education</h2><hr>";
        if ($result_edu->num_rows > 0) {
            while ($education = $result_edu->fetch_assoc()) {
                echo "<div class='education-entry'>";
                echo  "<li>" ."<strong>" . htmlspecialchars($education['specialization']) . "</strong> <br>" .
                    "<span class='institution'>" . htmlspecialchars($education['institution']) . "</span> - " .
                    "<span class='percentage'>" . htmlspecialchars($education['edu_percentage']) . "%</span> (" .
                    "<span class='year'>" . htmlspecialchars($education['year_of_passing']) . "</span>)";
                echo "</div>";
            }
        } else {
            echo "<p>No education details available.</p>";
        }
        echo "</div>";

        // Experiences
        $stmt_exp = $conn->prepare("SELECT company_name, role, duration_from, duration_to FROM experiences WHERE user_id = ?");
        $stmt_exp->bind_param("i", $user_id);
        $stmt_exp->execute();
        $result_exp = $stmt_exp->get_result();
        echo "<div class='container6'><h2>Experiences</h2>";
        echo "<hr>";
        while ($experience = $result_exp->fetch_assoc()) {
            echo "<li><strong>" . htmlspecialchars($experience['company_name']) . "</strong> as " .
                htmlspecialchars($experience['role']) . " (" .
                htmlspecialchars($experience['duration_from']) . " - " .
                htmlspecialchars($experience['duration_to']) . ")</li>";
        }
        echo "</ul></div>";

        echo "</div>"; // Close right-side

        // Left Side Containers (previously right-side)
        echo "<div class='left-side'>";

        // Personal Information
        echo "<div class='container1'>";
        echo "<div class='resume-item'><h3>{$user['first_name']}"." "."{$user['last_name']}</h3></div>";
        echo "<br>";
        echo "<h2>Profile</h2><hr>";
        echo "<p>Seeking a challenging position in industry where I can utilize my skills to contribute to the success of the company.</p>";
        echo "<h2>Contact</h2><hr>";
        echo "<div class='resume-item'><b>Phone Number:</b> {$user['phone_num']}</div>";
        echo "<div class='resume-item'><b>Email:</b> {$user['email']}</div>";
        echo "<h2>Skills</h2><hr>";
        echo "<div class='resume-item'>{$user['skills']}</div>";
        echo "<h2>Personal Details</h2><hr>";
        echo "<div class='resume-item'><li> <b>Date of Birth:</b> {$user['date_of_birth']}</div>";
        echo "<div class='resume-item'><li><b>Father's Name:</b> {$user['father_name']}</div>";
        echo "<div class='resume-item'><li><b>Father's Occupation:</b> {$user['father_occupation']}</div>";
        echo "<div class='resume-item'><li><b>Mother's Name:</b> {$user['mother_name']}</div>";
        echo "<div class='resume-item'><li><b>Mother's Occupation:</b> {$user['mother_occupation']}</div>";
        echo "<div class='resume-item'><li><b>Marital Status:</b> {$user['marital_status']}</div>";
        echo "<div class='resume-item'><li><b>Gender:</b> {$user['gender']}</div>";
        echo "</div>";

        // Projects
        $stmt_proj = $conn->prepare("SELECT project_name, project_description, project_duration, project_contribution FROM project_details WHERE user_id = ?");
        $stmt_proj->bind_param("i", $user_id);
        $stmt_proj->execute();
        $result_proj = $stmt_proj->get_result();
        echo "<div class='container3'><h2>Projects</h2>";
        echo "<hr>";
        while ($project = $result_proj->fetch_assoc()) {
            echo "<li><strong>" . htmlspecialchars($project['project_name']) . "</strong> - " .
                htmlspecialchars($project['project_description']) . " - " .
                htmlspecialchars($project['project_contribution']) . " (" .
                htmlspecialchars($project['project_duration']) . ")</li>";
        }
        echo "</ul></div>";

        // Certificates
        $stmt_cert = $conn->prepare("SELECT certificate_name, certificate_institution, duration_from, duration_to FROM certificate_details WHERE user_id = ?");
        $stmt_cert->bind_param("i", $user_id);
        $stmt_cert->execute();
        $result_cert = $stmt_cert->get_result();
        echo "<div class='container5'><br><br><h2>Certificates</h2>";
        echo "<hr>";
        while ($certificate = $result_cert->fetch_assoc()) {
            echo "<li><strong>" . htmlspecialchars($certificate['certificate_name']) . "</strong> from " .
                htmlspecialchars($certificate['certificate_institution']) . " (" .
                htmlspecialchars($certificate['duration_from']) . " - " .
                htmlspecialchars($certificate['duration_to']) . ")</li>";
        }
        echo "</ul></div>";

        echo "</div>"; // Close left-side

        echo "</div>"; // Close .box
    } else {
        echo "<h1 style='color: yellow; text-align: center;'>Resume not created</h1>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Download Resume</title>
    <style>
        .button{
            color:yellow;
            font-size:20px;
            margin-left:50%;
            margin-top:20px;
        }
    </style>
</head>
<body>
<button id="download-pdf" class="button">Download as PDF</button>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script>
        document.getElementById('download-pdf').addEventListener('click', function() {
            html2canvas(document.getElementById('resume-content')).then(function(canvas) {
                var imgData = canvas.toDataURL('image/png');
                var pdf = new jsPDF();
                var imgWidth = 210; // Width of PDF in mm
                var pageHeight = 295; // Height of PDF in mm
                var imgHeight = canvas.height * imgWidth / canvas.width;
                var heightLeft = imgHeight;

                var position = 0;

                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position -= pageHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                pdf.save('resume.pdf');
            });
        });
    </script>
</body>
</html>

