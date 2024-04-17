<?php
session_start();
include('connection.php');

// this checks if the user is logged in and is also an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Check if an id was passed
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);

    
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user.";
    }
    $stmt->close();
    $conn->close();
    header('Location: manage_users.php'); // will send user back to the user management page
    exit;
} else {
    echo "No user ID provided.";
}
?>
