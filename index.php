<?php
include('header.php'); 
session_start();
if(empty($_SESSION['first_name']))
{
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Resume Application</title>
        <style>
           <style>
            input{
                background-color:#b9f9f6;
                border:none;
            }
            h3{
    color:black;
    text-align:center;
    text-decoration:underline;
    font-size:larger;
}
            label{
                color:white;
                font-size:20px;
            }
            span{
                font-size:20px;
                color:red;
            }
            table{
    padding:50px;
    border-spacing: 20px;
    margin:auto;
}
.button{
    font-size:16px;
    width: 100%;
            padding: 10px;
            background-color: #36b1a7 ;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
}
.button:hover{
    font-size:16px;
    background-color: #1c7d76;
}
textarea{
    resize: none;
}
h4{
    color:white;
    text-align:center;
}
input[type='radio']{
    accent-color:yellow;
}
input[type='checkbox']{
    accent-color:yellow;
}
        </style>
    </head>
    <body>
        <form action="validate.php" method="post" enctype='multipart/form-data'>
        <h3>1. Personal Details</h3>
        <table>
            <tr>
                <td><label for="first_name">First Name:<span><sup>*</sup></span></label></td>
                <td><input type="text" name="first_name" required></td>
                <td><label for="last_name">Last Name:</label><span><sup>*</sup></span></td>
                <td><input type="text" name="last_name" required></td>
            </tr>
            <tr>
                <td><label for="date_of_birth">Date-of-Birth:</label><span><sup>*</sup></span></td>
                <td><input type="date" name="date_of_birth" required></td>       
                <td><label for="marital_status">Marital Status:</label><span><sup>*</sup></span></td>
                <td><input type="radio" name="marital_status" value="married"><label>Married</label>  <input type="radio" name="marital_status" value="unmarried" required><label>Unmarried</label></td> 
            </tr>
            <tr>
                <td><label for="father_name">Father Name:</label></td>
                <td><input type="text" name="father_name"></td>   
                <td><label for="father_occupation">Father Occupation:</label></td>
                <td><input type="text" name="father_occupation"></td>
            </tr>
            <tr>
                <td><label for="mother_name">Mother Name:</label></td>
                <td><input type="text" name="mother_name"></td>  
                <td><label for="mother_occupation">Mother Occupation:</label></td>
                <td><input type="text" name="mother_occupation"></td>
            </tr>
            <tr>  
                <td><label for="gender">Gender:</label><span><sup>*</sup></span></td>
                <td><input type="radio" name="gender" value="male" required><label>Male</label>  <input type="radio" name="gender" value="female" required><label>Female</label></td>
                <td><label for="skills">Skills:</label><span><sup>*</sup></span></td>
                <td><select name="skills[]" multiple required>
                    <option value="php">PHP</option>
                    <option value="java">JAVA</option>
                    <option value="javascript">JAVASCRIPT</option>
                    <option value="python">PYTHON</option>
                    <option value="html">HTML</option>
                    <option value="css">CSS</option>
                    <option value="sql">SQL</option>
                </select></td>
            </tr>
            <tr>
                <td><label for="address">Address:</label><span><sup>*</sup></span></td>
                <td><input type="text" name="address1" placeholder="Address 1" required>  <input type="text" name="address2" placeholder="Address 2" required>
                <br><br><input type="text" name="city" placeholder="City" required>  <input type="text" name="state" placeholder="State" required>
                <br><br><input type="text" name="country" placeholder="Country" required>  <input type="text" name="pincode" placeholder="Pincode" required></td> 
                <td><label for="profile">Profile:</label><span><sup>*</sup></span></td>
                <td><input type="file" name="profile" required></td>  
            </tr>
        </table>

        <hr>
        <h3>2. Eductaional Details</h3>
        <h4>1. SSLC</h4>
        <table>
            <tr>
                <td><label for="sslc_board">Board:</label></td>
                <td><input type="text" id="sslc_board" name="education[sslc][board]" placeholder="Board" required></td>
            </tr>
            <tr>
                <td><label for="sslc_year">Year of Passing:</label></td>
                <td><input type="month" id="sslc_year" name="education[sslc][year]" required></td>
            </tr>
            <tr>
                <td><label for="sslc_school">School/College:</label></td>
                <td><input type="text" id="sslc_school" name="education[sslc][school]" placeholder="School/College" required></td>
            </tr>
            <tr>
                <td><label for="sslc_mark">Percentage/CGPA:</label></td>
                <td><input type="text" id="sslc_mark" name="education[sslc][mark]" placeholder="Percentage/CGPA" required></td>
            </tr>
        </table>

        <h4>2. HSC</h4>
        <table>
            <tr>
                <td><label for="hsc_board">Board:</label></td>
                <td><input type="text" id="hsc_board" name="education[hsc][board]" placeholder="Board" required></td>
            </tr>
            <tr>
                <td><label for="hsc_year">Year of Passing:</label></td>
                <td><input type="month" id="hsc_year" name="education[hsc][year]" required></td>
            </tr>
            <tr>
                <td><label for="hsc_school">School/College:</label></td>
                <td><input type="text" id="hsc_school" name="education[hsc][school]" placeholder="School/College" required></td>
            </tr>
            <tr>
                <td><label for="hsc_mark">Percentage/CGPA:</label></td>
                <td><input type="text" id="hsc_mark" name="education[hsc][mark]" placeholder="Percentage/CGPA" required></td>
            </tr>
        </table>

        <h4>3. Diploma</h4>
        <table>
            <tr>
                <td><label for="diploma_degree">Degree:</label></td>
                <td><input type="text" id="diploma_degree" name="education[diploma][degree]" placeholder="Degree"></td>
            </tr>
            <tr>
                <td><label for="diploma_year">Year of Passing:</label></td>
                <td><input type="month" id="diploma_year" name="education[diploma][year]"></td>
            </tr>
            <tr>
                <td><label for="diploma_college">College:</label></td>
                <td><input type="text" id="diploma_college" name="education[diploma][college]" placeholder="College"></td>
            </tr>
            <tr>
                <td><label for="diploma_mark">Percentage/CGPA:</label></td>
                <td><input type="text" id="diploma_mark" name="education[diploma][mark]" placeholder="Percentage/CGPA"></td>
            </tr>
        </table>

        <h4>4. UG</h4>
        <table>
            <tr>
                <td><label for="ug_degree">Degree:</label></td>
                <td><input type="text" id="ug_degree" name="education[ug][degree]" placeholder="Degree"></td>
            </tr>
            <tr>
                <td><label for="ug_year">Year of Passing:</label></td>
                <td><input type="month" id="ug_year" name="education[ug][year]"></td>
            </tr>
            <tr>
                <td><label for="ug_college">College:</label></td>
                <td><input type="text" id="ug_college" name="education[ug][college]" placeholder="College"></td>
            </tr>
            <tr>
                <td><label for="ug_mark">Percentage/CGPA:</label></td>
                <td><input type="text" id="ug_mark" name="education[ug][mark]" placeholder="Percentage/CGPA"></td>
            </tr>
        </table>

        <h4>5. PG</h4>
        <table>
            <tr>
                <td><label for="pg_degree">Degree:</label></td>
                <td><input type="text" id="pg_degree" name="education[pg][degree]" placeholder="Degree"></td>
            </tr>
            <tr>
                <td><label for="pg_year">Year of Passing:</label></td>
                <td><input type="month" id="pg_year" name="education[pg][year]"></td>
            </tr>
            <tr>
                <td><label for="pg_college">College:</label></td>
                <td><input type="text" id="pg_college" name="education[pg][college]" placeholder="College"></td>
            </tr>
            <tr>
                <td><label for="pg_mark">Percentage/CGPA:</label></td>
                <td><input type="text" id="pg_mark" name="education[pg][mark]" placeholder="Percentage/CGPA"></td>
            </tr>
        </table>

        <hr>
        <h3>3. Experience Details<span><sup>*</sup></span></h3>
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
                <td><input type="text" name="company_name" required></td>
                <td><input type="text" name="company_role" required></td>
                <td><input type="date" name="duration_from" required></td>
                <td><input type="date" name="duration_from" required></td>
            </tr>
        </table>

        <hr>
        <h3>3. Project Details<span><sup>*</sup></span></h3>
        <table>
            <tr>
                <td style="text-align:center"><label for="project_name"><h4>PROJECT NAME</h4></label></td>
                <td style="text-align:center"><label for="project_description"><h4>PROJECT DESCRIPTION</h4></label></td>
                <td style="text-align:center"><label for="project_duration"><h4>PROJECT DURATION</h4></label></td>
                <td style="text-align:center"><label for="project_contribution"><h4>PROJECT CONTRIBUTION</h4></label></td>
            </tr>
            <tr>
                <td><input type="text" name="project_name" required></td>
                <td><textarea name="project_description" rows="3" cols="50" required></textarea></td>
                <td><input type="number" name="project_duration" required></td>
                <td><input type="text" name="project_contribution" required></td>
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
                <td><input type="text" name="certificate_name"></td>
                <td><input type="text" name="certificate_institution"></td>
                <td><input type="month" name="certificate_from"></td>
                <td><input type="month" name="certificate_to"></td>
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
                <td style="text-align:center"><input type="checkbox" name="languages[0][read]" value="1"></td>
                <td style="text-align:center"><input type="checkbox" name="languages[0][write]" value="1"></td>
                <td style="text-align:center"><input type="checkbox" name="languages[0][speak]" value="1"></td>
            </tr>
            <tr>
                <td style="text-align:center"><label>Tamil</label></td>
                <td style="text-align:center"><input type="checkbox" name="languages[1][read]" value="1"></td>
                <td style="text-align:center"><input type="checkbox" name="languages[1][write]" value="1"></td>
                <td style="text-align:center"><input type="checkbox" name="languages[1][speak]" value="1"></td>
            </tr>
            <tr>
                <td style="text-align:center"><label>Hindi</label></td>
                <td style="text-align:center"><input type="checkbox" name="languages[2][read]" value="1"></td>
                <td style="text-align:center"><input type="checkbox" name="languages[2][write]" value="1"></td>
                <td style="text-align:center"><input type="checkbox" name="languages[2][speak]" value="1"></td>
            </tr>
        </table>
        <table class="last">
            <tr>
                <td><input type="submit" name="submit" class="button"></td>
                <td><input type="reset" name="reset" class="button"></td>
            </tr>
        </table>
        </form>
    </body>
</html>
<?php
}
else{
    echo "<span style='color:yellow;text-align:center'><h1>Resume already exists</h1><span>";
}
include('footer.php'); 
?>