<?php
session_start();
include('connection.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); 
    exit;
}

$userCount = $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0];
$recipeCount = $conn->query("SELECT COUNT(*) FROM recipes")->fetch_row()[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <nav>
            <div class="nav-container">
                <ul class="navbar left-nav">
                    <li><a href="chef_dashboard.php">Account</a></li>
                    <li><a href="recipes.php">Recipes </a></li>
                    <li><a href="about_us.html">About</a></li>
                    <li><a href="faq.html">FAQ</a></li>
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
    <main>
    <h1>This is the Admin Dashboard</h1>
    <p><strong>Total Users:</strong> <?php echo $userCount; ?></p>
    <p><strong>Total Recipes:</strong> <?php echo $recipeCount; ?></p>

    <h2>Management Tools</h2>
    <ul>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="manage_recipes.php">Manage Recipes</a></li>
        
    </ul>

    

    <a href="logout.php">Logout</a>
</main>

<footer>
        <ul class="footerLinks">
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Use</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
        <p> Chi's food blog | © 2024</p>
    </footer>
</body>
</html>
