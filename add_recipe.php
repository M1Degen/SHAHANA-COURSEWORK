<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $location = $conn->real_escape_string($_POST['location']);

    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];  
        $filename = $_FILES['image']['name'];
        $filetmp = $_FILES['image']['tmp_name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (in_array($ext, $allowed)) {
            $dest = 'uploads/' . $filename;  
            if (move_uploaded_file($filetmp, $dest)) {
                
                $image_path = $dest;
            } else {
                echo "Failed to save file.";
                exit;
            }
        } else {
            echo "Invalid file type.";
            exit;
        }
    } else {
        echo "No image uploaded.";
        $image_path = "";  
    }

    $sql = "INSERT INTO recipes (name, description, location, image_path, cook_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $description, $location, $image_path, $_SESSION['user_id']);
    if ($stmt->execute()) {
        echo "New recipe added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
