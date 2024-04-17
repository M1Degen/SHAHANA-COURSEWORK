<?php
session_start();
include('connection.php');


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $recipeId = intval($_GET['id']);

    
    $sql = "DELETE FROM recipes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipeId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Recipe deleted successfully.";
    } else {
        echo "Error deleting recipe.";
    }
    $stmt->close();
    $conn->close();
    header('Location: manage_recipes.php'); 
    exit;
} else {
    echo "No recipe ID provided.";
}
?>
