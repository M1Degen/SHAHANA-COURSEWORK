<?php
session_start();
include('connection.php');

if (!isset($_GET['id']) || !isset($_SESSION['user_id']) || $_SESSION['role'] !== 'cook') {
    echo "Invalid Access. Please log in as a cook.";
    exit;
}

$recipeId = $_GET['id'];
$cookId = $_SESSION['user_id'];

// Proces form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $location = $conn->real_escape_string($_POST['location']);
// update recipe 
    $sql = "UPDATE recipes SET name = ?, description = ?, location = ? WHERE id = ? AND cook_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $name, $description, $location, $recipeId, $cookId);
    if ($stmt->execute()) {
        echo "<p>Recipe updated successfully.</p>";
        header("Location: chef_dashboard.php");
        exit;
    } else {
        echo "<p>Error updating recipe: " . htmlspecialchars($conn->error) . "</p>";
    }
}

// Fetches the existing recipe for updating
$sql = "SELECT name, description, location FROM recipes WHERE id = ? AND cook_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $recipeId, $cookId);
$stmt->execute();
$result = $stmt->get_result();
$recipe = $result->fetch_assoc();

if (!$recipe) {
    echo "No recipe found or you do not have permission to edit this recipe.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="about_us.css">
</head>
<body>
<header>
        <nav>
            <div class="nav-container">
                <ul class="navbar left-nav">
                    <li><a href="chef_dashboard.php">Account</a></li>
                    <li><a href="recipe.php">Recipes</a>
                
                    <li><a href="about_us.html">About</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
                <div class="right-nav">
                    <!--  live search -->
                    <input type="search" id="searchInput" placeholder="Search recipes..." aria-label="Search" oninput="performSearch()">
                    <div id="searchResults" class="search-results"></div>
                     <a href="logout.php">
                     <button class="logout-btn">Log Out</button>
                     </a>
                </div>
            </div>
        </nav>
    </header>
    <main>
    <h1>editecipe</h1>
    <form method="post">
        <label for="name">Recipe Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($recipe['name']); ?>" required><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($recipe['description']); ?></textarea><br>

        <label for="location">Location:</label><br>
        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($recipe['location']); ?>" required><br>

        <button type="submit">Update Recipe</button>
    </form>
</main>
</body>
</html>
