<?php
    require('connection.php');
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    include('header.php');
?>
<?php if(!empty($_SESSION['first_name']))
{?>
<!DOCTYPE html>
<html>
    <head>
        <title>Resume Application</title>
        <style>
            textarea,input{
               padding:8px;
                font-size:16px;
                border:none;
            }
            input[type="text"][disabled]{
                color:red;
            }
            h3{
    text-align:center;
    text-decoration:underline;
    font-size:larger;
}
            label{
                color:white;
                font-size:20px;
            }
            table{
    padding:50px;
    border-spacing: 20px;
    margin-left:auto;
    margin-right:auto;
}
input[type='radio']{
    accent-color:yellow;
}
input[type='checkbox']{
    accent-color:yellow;
}
button{
    font-size:16px;
    width: 100%;
            padding: 10px;
            background-color: #36b1a7 ;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
}
button:hover{
    font-size:16px;
    background-color: #1c7d76;
}
textarea{
    resize: none;
}
        </style>
    </head>
    <body>
        <?php 
        $user_id = $_SESSION["user_id"];
        $query = 'SELECT 
            user.*,
            education.*,
            experience.*,
            project_details.*,
            certificate_details.*,
            address.*
        FROM 
            users user
        LEFT JOIN 
            educations education ON user.user_id = education.user_id
        LEFT JOIN 
            experiences experience ON user.user_id = experience.user_id
        LEFT JOIN 
            project_details project_details ON user.user_id = project_details.user_id
        LEFT JOIN 
            certificate_details certificate_details ON user.user_id = certificate_details.user_id
        LEFT JOIN
            addresses address ON user.user_id = address.user_id
        WHERE
            user.user_id = ?';
        $stmt = $conn->prepare($query);
        
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("i", $user_id);
        if (!$stmt->execute()) {
            die("Execute failed: " . htmlspecialchars($stmt->error));
        }
        $result = $stmt->get_result();
        if ($result === false) {
            die("Get result failed: " . htmlspecialchars($stmt->error));
        }
        $user = null;
        $num_count = $result->num_rows;
        if ($num_count > 0) {
            $user = $result->fetch_assoc();
        } else {
            echo "No records found for user ID: " . htmlspecialchars($user_id);
        }
        $result->free();
?>
        <form action="update.php" method="post" enctype='multipart/form-data'>
        <h3>1. Personal Details</h3>
        <table>
        <tr>
                <td><label for="user_id">User_id:</label></td>
                <td><input type="text" name="user_id" required disabled value="<?php echo isset($user['user_id']) ? htmlspecialchars($user['user_id']) : ''; ?>"></td>
                <td><label for="user_name">User Name:</label></td>
                <td><input type="text" name="username_value" required disabled value="<?php echo isset($user['username_value']) ? htmlspecialchars($user['username_value']) : ''; ?>"></td>
            </tr>
            <tr>
                <td><label for="first_name">First Name:</label></td>
                <td><input type="text" name="first_name" required value="<?php echo isset($user['first_name']) ? htmlspecialchars($user['first_name']) : 'hello'; ?>"></td>
                <td><label for="last_name">Last Name:</label></td>
                <td><input type="text" name="last_name" required value="<?php echo isset($user['last_name']) ? htmlspecialchars($user['last_name']) : ''; ?>"></td>
            </tr>
            <tr>
                <td><label for="date_of_birth">Date-of-Birth:</label></td>
                <td><input type="date" name="date_of_birth" required value="2024-08-28"></td>       
                <td><label for="phone_num">Phone Number:</label></td>
                <td><input type="text" name="phone_num" required value="<?php echo isset($user['phone_num']) ? htmlspecialchars($user['phone_num']) : ''; ?>"></td>
            </tr>
            <tr>
                <td><label for="father_name">Father Name:</label></td>
                <td><input type="text" name="father_name" value="<?php echo isset($user['father_name']) ? $user['father_name'] : ''; ?>"></td>   
                <td><label for="father_occupation">Father Occupation:</label></td>
                <td><input type="text" name="father_occupation" value="<?php echo isset($user['father_occupation']) ? $user['father_occupation'] : ''; ?>"></td>
            </tr>
            <tr>
                <td><label for="mother_name">Mother Name:</label></td>
                <td><input type="text" name="mother_name" value="<?php echo isset($user['mother_name']) ? $user['mother_name'] : ''; ?>"></td>  
                <td><label for="mother_occupation">Mother Occupation:</label></td>
                <td><input type="text" name="mother_occupation" value="<?php echo isset($user['mother_occupation']) ? $user['mother_occupation'] : ''; ?>"></td>
            </tr>
            <tr>
                <td><label for="marital_status">Marital Status:</label></td>
                <td><input type="radio" name="marital_status" required value="married" checked="checked"><label>married </label> <input type="radio" name="marital_status" value="unmarried" required checked="checked"><label>unmarried</label></td>  
                <td><label for="email">Email:</label></td>
                <td><input type="email" name="email" required value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>"></td>
            </tr>
            <tr>  
                <td><label for="gender">Gender:</label></td>
                <td><input type="radio" name="gender" value="male" required checked="checked"><label>male</label>  <input type="radio" name="gender" value="female" required checked="checked"><label>female</label></td>
                <td><label for="skills">Skills:</label></td>
                <td><select name="skills" multiple required>
                    <option value="php" selected="selected">PHP</option>
                    <option value="java" selected="selected">JAVA</option>
                    <option value="javascript" selected="selected">JAVASCRIPT</option>
                    <option value="python" selected="selected">PYTHON</option>
                    <option value="html" selected="selected">HTML</option>
                    <option value="css" selected="selected">CSS</option>
                    <option value="sql" selected="selected">SQL</option>
                </select></td>
            </tr>
            <tr>
                <td><label for="address">Address:</label></td>
                <td><input type="text" name="address1" placeholder="address 1" required value="<?php echo isset($user['address1']) ? $user['address1'] : ''; ?>">  <input type="text" name="address2" placeholder="address 2" required value="<?php echo isset($user['address2']) ? $user['address2'] : ''; ?>">
                <br><br><input type="text" name="city" placeholder="city" required value="<?php echo isset($user['city']) ? $user['city'] : ''; ?>">  <input type="text" name="state" placeholder="state" required value="<?php echo isset($user['address_state']) ? $user['address_state'] : ''; ?>">
                <br><br><input type="text" name="country" placeholder="country" required value="<?php echo isset($user['country']) ? $user['country'] : ''; ?>">  <input type="text" name="pincode" placeholder="pincode" required value="<?php echo isset($user['pincode']) ? $user['pincode'] : ''; ?>"></td> 
                <td><label for="profile">Profile:</label></td>
                <td><input type="file" name="profile" required></td>  
            </tr>
        </table>

        <!-- <hr>
        <h3>2. Eductaional Details</h3>
        <table>
            <tr>
                <td></td>
                <td><label for="education_board"><h4>EDUCATION BOARD/<br>DEGREE</h4></label></td>
                <td><label for="passing_year"><h4>YEAR OF PASSING</h4></label></td>
                <td><label for="school"><h4>SCHOOL/COLLEGE</h4></label></td>
                <td><label for="mark"><h4>PERCENTAGE/CGPA</h4></label></td>
            </tr>
            <tr>
                <td>SSLC</td>
                <td><input type="text" name="education[sslc_board]" required value="<?php echo isset($user['country']) ? $user['country'] : ''; ?>"></td>
                <td><input type="text" name="education[sslc_year]" required value="2024-08-28"></td>
                <td><input type="text" name="education[sslc_school]" required value="<?php echo isset($user['country']) ? $user['country'] : ''; ?>"></td>
                <td><input type="text" name="education[sslc_mark]" required></td>
            </tr>
            <tr>
                <td>HSC</td>
                <td><input type="text" name="education[hsc_board]" required ></td>
                <td><input type="text" name="education[hsc_year]" required ></td>
                <td><input type="text" name="education[hsc_school]" required ></td>
                <td><input type="text" name="education[hsc_mark]" required ></td>
            </tr>
            <tr>
                <td>DIPLOMA</td>
                <td><input type="text" name="education[diploma_degree]" ></td>
                <td><input type="text" name="education[diploma_year]" ></td>
                <td><input type="text" name="education[diploma_college]" ></td>
                <td><input type="text" name="education[diploma_mark]"></td>
            </tr>
            <tr>
                <td>UG</td>
                <td><input type="text" name="education[ug_degree]" ></td>
                <td><input type="text" name="education[ug_year]"></td>
                <td><input type="text" name="education[ug_college]" ></td>
                <td><input type="text" name="education[ug_mark]"></td>
            </tr>
            <tr>
                <td>PG</td>
                <td><input type="text" name="education[pg_degree]" ></td>
                <td><input type="text" name="education[pg_year]" ></td>
                <td><input type="text" name="education[pg_college]"></td>
                <td><input type="text" name="education[pg_mark]"></td>
            </tr>
        </table> -->

        <hr>
        <h3>3. Experience Details</h3>
        <table>
            <tr>
                <td><label for="company_name" style="text-align:center"><h4>COMPANY NAME</h4></label></td>
                <td><label for="company_role" style="text-align:center"><h4>ROLE</h4></label></td>
                <td colspan="2"><label for="duration_from" style="text-align:center"><h4>DURATION</h4></label></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><label for="duration_from" style="text-align:center"><h4>FROM</h4></label></td>
                <td><label for="duration_to" style="text-align:center"><h4>TO</h4></label></td>
            </tr>
            <tr>
                <td><input type="text" name="company_name" required value="<?php echo isset($user['company_name']) ? $user['company_name'] : ''; ?>"></td>
                <td><input type="text" name="company_role" required value="<?php echo isset($user['role']) ? $user['role'] : ''; ?>"></td>
                <td><input type="date" name="duration_from" required value="2024-08-28"></td>
                <td><input type="date" name="duration_to" required value="2024-08-28"></td>
            </tr>
        </table>

        <hr>
        <h3>3. Project Details</h3>
        <table>
            <tr>
                <td style="text-align:center"><label for="project_name"><h4>PROJECT NAME</h4></label></td>
                <td style="text-align:center"><label for="project_description"><h4>PROJECT DESCRIPTION</h4></label></td>
                <td style="text-align:center"><label for="project_duration"><h4>PROJECT DURATION</h4></label></td>
                <td style="text-align:center"><label for="project_contribution"><h4>PROJECT CONTRIBUTION</h4></label></td>
            </tr>
            <tr>
                <td><input type="text" name="project_name" required value="<?php echo isset($user['project_name']) ? $user['project_name'] : ''; ?>"></td>
                <td><textarea name="project_description" rows="3" cols="50" required value="<?php echo isset($user['project_description']) ? $user['project_description'] : ''; ?>"></textarea></td>
                <td><input type="date" name="project_duration" required value="2024-08-28"></td>
                <td><input type="text" name="project_contribution" required value="<?php echo isset($user['project_contribution']) ? $user['project_contribution'] : ''; ?>"></td>
            </tr>
        </table>

        <hr>
        <h3>4. Certification Details</h3>
        <table>
            <tr>
                <td style="text-align:center"><label for="certificate_name"><h4>NAME</h4></label></td>
                <td style="text-align:center"><label for="certificate_institution"><h4>INSTITUTION</h4></label></td>
                <td style="text-align:center"><label for="certificate_from"><h4>DURATION FROM</h4></label></td>
                <td style="text-align:center"><label for="certificate_to"><h4>DURATION TO</h4></label></td>
            </tr>
            <tr>
                <td><input type="text" name="certificate_name" value="<?php echo isset($user['certificate_name']) ? $user['certificate_name'] : ''; ?>"></td>
                <td><input type="text" name="certificate_institution" value="<?php echo isset($user['certificate_institution']) ? $user['certificate_institution'] : ''; ?>"></td>
                <td><input type="date" name="certificate_from" value="2024-08-28"></td>
                <td><input type="date" name="certificate_to" value="2024-08-28"></td>
            </tr>
        </table>

        <hr>
        <h3>5. Languages Known</h3>
        <table>
            <tr>
                <td style="text-align:center"><label for="language_name"><h4>LANGUAGE</h4></label></td>
                <td style="text-align:center"><label for="read"><h4>READ</h4></label></td>
                <td style="text-align:center"><label for="write"><h4>WRITE</h4></label></td>
                <td style="text-align:center"><label for="speak"><h4>SPEAK</h4></label></td>
            </tr>
            <tr>
                <td style="text-align:center"><label>English</label></td>
                <td style="text-align:center"><input type="checkbox" name="english_read" value="english_read" checked="checked"></td>
                <td style="text-align:center"><input type="checkbox" name="english_write" value="english_write" checked="checked"></td>
                <td style="text-align:center"><input type="checkbox" name="english_speak" value="english_speak" checked="checked"></td>
            </tr>
            <tr>
                <td style="text-align:center"><label>Tamil</label></td>
                <td style="text-align:center"><input type="checkbox" name="tamil-read" value="YES" checked="checked"></td>
                <td style="text-align:center"><input type="checkbox" name="tamil-write" value="YES" checked="checked"></td>
                <td style="text-align:center"><input type="checkbox" name="tamil-speak" value="YES" checked="checked"></td>
            </tr>
            <tr>
                <td style="text-align:center"><label>Hindi</label></td>
                <td style="text-align:center"><input type="checkbox" name="hindi-read" value="YES" checked="checked"></td>
                <td style="text-align:center"><input type="checkbox" name="hindi-write" value="YES" checked="checked"></td>
                <td style="text-align:center"><input type="checkbox" name="hindi-speak" value="YES" checked="checked"></td>
            </tr>
        </table>
        <table class="last">
            <tr>
            <input type="hidden" name="user_id" value="<?php echo isset($user['user_id']) ? htmlspecialchars($user['user_id']) : ''; ?>">
            </tr>
            <tr>
            <td><button type="submit">Update</button></td></td>
            </tr>
        </table>
        </form>
    </body>
</html>
    <?php
}
else{
    echo "<span style='color:yellow;text-align:center'><h1>Resume not created</h1></span>";
}
?>
    <?php
    include("footer.php");
    ?>