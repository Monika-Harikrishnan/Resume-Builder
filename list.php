<?php
    require('connection.php');
    session_start();
  //   if (!isset($_SESSION['user_id'])) {
  //     header("Location: login.php");
  //     exit();
  // }
?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>HTML Table</h2>
<table>
  <tr>
  <th>ID</th>
    <th>Name</th>
    <th>Date of birth</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Father name</th>
    <th>Father occupation</th>
    <th>Mother name</th>
    <th>Mother occupation</th>
    <th>Marital status</th>
    <th>Gender</th>
    <th>Skills</th>
    <?php if (isset($_SESSION['user_id'])):?>
    <th>EDIT</th>
    <th>DELETE</th>
    <?php endif;?>
  </tr>
<?php

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$limit = 10;
$offset = ($page - 1) * $limit;
$user_query = "SELECT user_id, first_name, last_name, date_of_birth,phone_num, email,father_name, 
father_occupation, mother_name,mother_occupation,marital_status,gender, skills from users limit " . $limit . " offset " . $offset;
$result = $conn->query($user_query);
$num_count = $result->num_rows;
if ($num_count > 0) {
     while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
    <td><?php echo (isset($row['first_name']) ? $row['first_name'] : '') . ' ' . (isset($row['last_name']) ? $row['last_name'] : ''); ?></td>
    <td><?php echo (isset($row['date_of_birth']) ? $row['date_of_birth'] : ''); ?></td>
    <td><?php echo (isset($row['phone_num']) ? $row['phone_num'] : ''); ?></td>
    <td><?php echo (isset($row['email']) ? $row['email'] : ''); ?></td>
    <td><?php echo (isset($row['father_name']) ? $row['father_name'] : ''); ?></td>
    <td><?php echo (isset($row['father_occupation']) ? $row['father_occupation'] : ''); ?></td>
    <td><?php echo (isset($row['mother_name']) ? $row['mother_name'] : ''); ?></td>
    <td><?php echo (isset($row['mother_occupation']) ? $row['mother_occupation'] : ''); ?></td>
    <td><?php echo (isset($row['marital_status']) ? $row['marital_status'] : ''); ?></td>
    <td><?php echo (isset($row['gender']) ? $row['gender'] : ''); ?></td>
    <td><?php echo (isset($row['skills']) ? $row['skills'] : ''); ?></td>
    <?php if (isset($_SESSION['user_id'])):?>
      <td><a href="<?php echo 'edit.php?user_id=' . $row['user_id']; ?>">Edit</a></td>
    <td><a href="<?php echo 'delete.php?user_id=' . $row['user_id']; ?>">DELETE</a></td>
    <?php endif;?>
    
  </tr>

  <?php }
}
for($page = 1; $page<= $num_count; $page++) {  
    echo '<a href = "list.php?page=' . $page . '">' . $page . ' </a>';  
} 
?>

</table>

</body>
</html>