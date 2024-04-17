<?php
include 'connection.php';  

if (isset($_GET['recipe_id'])) {
    $recipe_id = $_GET['recipe_id'];

    $query = "DELETE FROM recipes WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Recipe deleted successfully.";
    } else {
        echo "Error deleting recipe.";
    }
    $stmt->close();
    $conn->close();
}
?>
