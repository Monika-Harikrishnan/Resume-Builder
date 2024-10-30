<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require('connection.php');

        $user_id = $_SESSION['user_id']; 
        $conn->begin_transaction();

        try {
            $stmt1 = $conn->prepare("DELETE FROM languages WHERE user_id = ?");
            $stmt1->bind_param("i", $user_id);
            $stmt1->execute();
        
            $stmt1 = $conn->prepare("DELETE FROM educations WHERE user_id = ?");
            $stmt1->bind_param("i", $user_id);
            $stmt1->execute();
        
            $stmt2 = $conn->prepare("DELETE FROM project_details WHERE user_id = ?");
            $stmt2->bind_param("i", $user_id);
            $stmt2->execute();
        
            $stmt3 = $conn->prepare("DELETE FROM certificate_details WHERE user_id = ?");
            $stmt3->bind_param("i", $user_id);
            $stmt3->execute();
        
            $stmt4 = $conn->prepare("DELETE FROM addresses WHERE user_id = ?");
            $stmt4->bind_param("i", $user_id);
            $stmt4->execute();
        
            $stmt5 = $conn->prepare("DELETE FROM users WHERE user_id = ?");
            $stmt5->bind_param("i", $user_id);
            $stmt5->execute();
            $conn->commit();
            echo "<h1><span style='color:red'><b>DELETED SUCCESSFULLY</b></span></h1>";
        } 
        catch (Exception $e) {
            $conn->rollback();
            echo "Failed to delete records: " . $e->getMessage();
        }
        $stmt1->close();
        $stmt2->close();
        $stmt3->close();
        $stmt4->close();
        $stmt5->close();
        $conn->close();

    session_destroy();  // Optionally destroy the session
    header("Location: login.php");
    exit();

?>