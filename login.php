<?php
session_start();
include('connection.php'); // ensures my database connection file 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT id, password, role FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            
            // edirect user based on role
            switch ($_SESSION['role']) {
                case 'admin':
                    header("Location: admin_dashboard.php"); // redirects to admin dashboard
                    break;
                case 'cook':
                    header("Location: chef_dashboard.php"); // redirects to chef dashboard
                    break;
                case 'recipe_seeker':
                    header("Location: home.php"); // redirects to home page for recipe seekers
                    break;
            }
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that email.";
    }
}
?>
