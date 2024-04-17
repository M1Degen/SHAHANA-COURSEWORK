<?php
session_start();
include 'connection.php';

// make sure the user is logged in and is also a cook
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'cook') {
    echo "Access Denied. You must be logged in as a cook to view this page.";
    exit; // doesnt load page if not a cook
}

$cook_id = $_SESSION['user_id'];  // Get the cooks or chefs user id from session start

// collect the cook's recipes from the DB
$query = "SELECT * FROM recipes WHERE cook_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $cook_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef Dashboard</title>
    <link rel="stylesheet" href="about_us.css">
</head>
<body>
<header>
    <nav>
        <div class="nav-container">
            <ul class="navbar left-nav">
                <li><a href="">Account</a></li>
                <li><a href="recipe.php">Recipes </a>
                    </ul>
                </li>
                <li><a href="about_us.html">About</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
            <div class="right-nav">
                <input type="search" id="searchInput" placeholder="Search recipes..." aria-label="Search" oninput="performSearch()">
                <div id="searchResults" class="search-results"></div>
                <a href="logout.php">
                   <button class="logout-btn">Log Out</button>
                 </a>
            </div>
        </div>
    </nav>
</header>
<h1>My Dashboard</h1>
<form id="recipeForm" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Recipe Name" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <input type="text" name="location" placeholder="Location" required><br>
    <input type="file" name="image" required><br>
    <button type="button" onclick="submitRecipe()">Add Recipe</button>
</form>
<div id="message"></div>

<div>
    <h2>Your Recipes</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="recipe">';
            echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="Recipe Image" style="width:200px;"><br>';
            echo '<strong>' . htmlspecialchars($row['name']) . '</strong><br>';
            echo htmlspecialchars($row['description']) . '<br>';
            echo '<a href="edit_recipe.php?id=' . $row['id'] . '">Edit</a> | ';
            echo '<a href="#" onclick="confirmDelete(' . $row['id'] . '); return false;">Delete</a>';
            echo '</div><br>';
        }
    } else {
        echo 'No recipes found.';
    }
    $conn->close();
    ?>
</div>

<script>
function submitRecipe() {
    var formElement = document.getElementById('recipeForm');
    var formData = new FormData(formElement);
    fetch('add_recipe.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('message').textContent = data;
        formElement.reset(); 
    })
    .catch(error => console.error('Error:', error));
}

function confirmDelete(recipeId) {
    if (confirm('Are you sure you want to delete this recipe?')) {
        window.location.href = 'delete_recipe.php?id=' + recipeId;
    }
}
</script>

<footer>
    <ul class="footerLinks">
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Use</a></li>
        <li><a href="#">Contact Us</a></li>
    </ul>
</footer>
</body>
</html
