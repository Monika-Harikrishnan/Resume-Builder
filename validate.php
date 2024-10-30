<?php
session_start();
include('header.php');
$errors=[];
$user_id = $_SESSION['user_id'];
require_once('connection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){

    if(empty($_POST["first_name"]))
    {
        $errors['first_name']="Enter your first name";
    }
    
    if(empty($_POST["last_name"]))
    {
        $errors['last_name']="Enter your last name";
    }
    
    if(empty($_POST["date_of_birth"]))
    {
        $errors['date_of_birth']="Enter your date of birth";
    }
    
    if(empty($_POST["marital_status"]))
    {
        $errors['marital_status']="Enter your marital status";
    }
   
    if(empty($_POST["gender"]))
    {
        $errors['gender']="Enter your gender";
    }

    //address
    if(empty($_POST["address1"]))
    {
        $errors['address1']="Enter your address1";
    }
    if(empty($_POST["address2"]))
    {
        $errors['address2']="Enter your address2";
    }
    if(empty($_POST["city"]))
    {
        $errors['city']="Enter your city";
    }
    if(empty($_POST["state"]))
    {
        $errors['state']="Enter your state";
    }
    if(empty($_POST["country"]))
    {
        $errors['country']="Enter your country";
    }
    if(empty($_POST["pincode"]))
    {
        $errors['pincode']="Enter your pincode";
    }

     //project_details  
     if(empty($_POST["project_name"]))
     {
         $errors['project_name']="Enter your project name";
     }
     if(empty($_POST["project_description"]))
     {
         $errors['project_description']="Enter your project description";
     }
     if(empty($_POST["project_duration"]))
     {
         $errors['project_from']="Enter your project from date";
     }
     if(empty($_POST["project_contribution"]))
     {
         $errors['project_contribution']="Enter your project contribution";
     }
     
    //error checking
    if(empty($errors))
    {
        $user_id = $_SESSION['user_id'];
        $first_name = $_POST['first_name'];
        $last_name =  $_POST["last_name"];
        $date_of_birth = $_POST["date_of_birth"];
        $father_name = $_POST["father_name"];
        $father_occupation = $_POST["father_occupation"];
        $mother_name = $_POST["mother_name"];
        $mother_occupation = $_POST["mother_occupation"];
        $marital_status = $_POST["marital_status"];
        $gender = $_POST["gender"];
        $skills = $_POST["skills"];
        $address1 = $_POST["address1"];
        $address2 = $_POST["address2"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $country = $_POST["country"];
        $pincode = $_POST["pincode"];
        $certificate_name = $_POST["certificate_name"];
        $certificate_institution = $_POST["certificate_institution"];
        $certificate_from = $_POST["certificate_from"];
        $certificate_to = $_POST["certificate_to"];
        $project_name = $_POST["project_name"];
        $project_description = $_POST["project_description"];
        $project_duration = $_POST["project_duration"];
        $project_contribution = $_POST["project_contribution"];
        $skills_str = isset($_POST['skills']) ? $_POST['skills'] : [];
        $skills = is_array($skills_str) ? implode('<br>', $skills_str) : '';

    //personal-details    
    $sql = "INSERT INTO users (user_id, first_name, last_name, date_of_birth, father_name, father_occupation, mother_name, mother_occupation, marital_status, gender, skills) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE
        first_name = VALUES(first_name),
        last_name = VALUES(last_name),
        date_of_birth = VALUES(date_of_birth),
        father_name = VALUES(father_name),
        father_occupation = VALUES(father_occupation),
        mother_name = VALUES(mother_name),
        mother_occupation = VALUES(mother_occupation),
        marital_status = VALUES(marital_status),
        gender = VALUES(gender),
        skills = VALUES(skills)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

if ($stmt === false) {
die("Prepare failed: " . $conn->error);
}

// Bind parameters to the placeholders
$stmt->bind_param("issssssssss", $user_id, $first_name, $last_name, $date_of_birth, $father_name, $father_occupation, $mother_name, $mother_occupation, $marital_status, $gender, $skills);

// Execute the statement
if ($stmt->execute()) {
echo "<b>Users table updated or inserted successfully</b><br>";
} else {
echo "Error users: " . $stmt->error;
}


      //address-details
     $address = "INSERT INTO addresses (user_id,address1,address2,city,address_state,country,pincode)
     VALUES ('$user_id','$address1','$address2','$city','$state','$country','$pincode')";
     if ($conn->query($address) === TRUE) {
         echo "<b>address created successfully</b><br>";
      } else {
         echo "Error address ";
      }

      //certificate-details
      $certificate = "INSERT INTO certificate_details (user_id,certificate_name,certificate_institution,duration_from,duration_to)
     VALUES ('$user_id','$certificate_name','$certificate_institution','$certificate_from','$certificate_to')";
     if ($conn->query($certificate) === TRUE) {
         echo "certificate created successfully<br>";
      } else {
         echo "Error certificate ";
      }

      //project-details 
      $project = "INSERT INTO project_details (user_id,project_name,project_description,project_duration,project_contribution)
     VALUES ('$user_id','$project_name','$project_description','$project_duration','$project_contribution')";
     if ($conn->query($project) === TRUE) {
         echo "project created successfully<br>";
      } else {
         echo "Error project ";
      }
      //language details
      $stmt = $conn->prepare("
      INSERT INTO languages (user_id, language_id, can_read, can_write, can_speak)
      VALUES (?, ?, ?, ?, ?)
  ");

  if ($stmt === false) {
      die("Prepare failed: " . $conn->error);
  }

  // Loop through languages from the POST request
  foreach ($_POST['languages'] as $index => $language_data) {
      // Determine the language based on index
      $language = '';
      switch ($index) {
          case 0:
              $language = 'English';
              break;
          case 1:
              $language = 'Tamil';
              break;
          case 2:
              $language = 'Hindi';
              break;
          default:
              $language = 'Unknown'; // Handle unknown languages or extend as needed
              break;
      }

      // Determine read, write, and speak values
      $can_read = isset($language_data['read']) ? 1 : 0;
      $can_write = isset($language_data['write']) ? 1 : 0;
      $can_speak = isset($language_data['speak']) ? 1 : 0;

      // Bind parameters and execute the statement
      $stmt->bind_param('isiii', $user_id, $language, $can_read, $can_write, $can_speak);

      if (!$stmt->execute()) {
          echo "Execute failed: " . $stmt->error;
      }
  }

  echo "Languages recorded successfully<br>";

  // Close the statement
  $stmt->close();
} else {
  echo "No data posted";
}


      //educational-details
      $stmt = $conn->prepare("
      INSERT INTO educations (user_id, specialization, institution, year_of_passing, edu_percentage)
      VALUES (?, ?, ?, ?, ?)
  ");

  if ($stmt === false) {
      die("Prepare failed: " . $conn->error);
  }

  // Track if any insert operation failed
  $all_success = true;

  // Loop through the posted educational data
  foreach ($_POST['education'] as $level => $data) {
      // Determine the specialization and institution
      $specialization = $data['board'] ?? $data['degree'] ?? '';
      // Ensure year_of_passing is not null
      $year_of_passing = !empty($data['year']) ? $data['year'] . '-01' : '';
      $institution = $data['school'] ?? $data['college'] ?? '';
      $mark = $data['mark'] ?? '';

      // Bind parameters and execute the statement
      $stmt->bind_param('issss', $user_id, $specialization, $institution, $year_of_passing, $mark);

      if (!$stmt->execute()) {
          echo "Execute failed: " . $stmt->error . "<br>";
          $all_success = false;
      }
  }

  if ($all_success) {
      echo "Educational details recorded successfully";
  }

  // Close the statement
  $stmt->close();
     
    }

else
{
    echo "error";
}
include('footer.php');

?>