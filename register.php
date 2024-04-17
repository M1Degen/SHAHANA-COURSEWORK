<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT); // Encrypt the password
    $role = $conn->real_escape_string($_POST['role']);

    // Check if user already exist
    $checkUser = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkUser);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "User already exists with that email.";
        $stmt->close();
    } else {
        
        $sql = "INSERT INTO users (firstname, lastname, email, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $password, $role);
        if ($stmt->execute()) {
            echo "New account created successfully";
            header("Location: index.html"); 
                        exit; 
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>
