<?php
include 'connection.php'; 

if (isset($_GET['q']) && !empty($_GET['q'])) {
    $searchTerm = $_GET['q'];
    
    $stmt = $conn->prepare("SELECT * FROM recipes WHERE name LIKE CONCAT('%', ?, '%') OR description LIKE CONCAT('%', ?, '%') ORDER BY created_at DESC");
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="recipe-image">';
            echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['name']) . '">';
            echo '<div><h3>' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p>' . htmlspecialchars($row['description']) . '</p></div>';
            echo '</div>';
        }
    } else {
        echo '<p>No recipes found matching your search criteria.</p>';
    }
    $stmt->close();
} else {
    echo '<p>Please enter a search term.</p>';
}
$conn->close();
?>
