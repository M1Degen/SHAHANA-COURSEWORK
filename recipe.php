<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Recipes</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<header>
        <nav>
            <div class="nav-container">
                <ul class="navbar left-nav">
                    <li><a href="chef_dashboard.php">Account</a></li>
                    <li><a href="#">Recipes &#x25BE;</a></li>
                    <li><a href="about_us.html">About</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                </ul>
               
            </div>
        </nav>
    </header>
<body>


<script>
        function performSearch() {
            var input = document.getElementById('searchInput');
            var searchTerm = input.value;
            var resultsContainer = document.getElementById('searchResults');
            if (searchTerm.length === 0) {
                resultsContainer.innerHTML = '';
                return;
            }
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'search.php?q=' + encodeURIComponent(searchTerm), true);
            xhr.onload = function() {
                if (this.status === 200) {
                    resultsContainer.innerHTML = this.responseText;
                } else {
                    resultsContainer.innerHTML = 'An error occurred during the search.';
                }
            };
            xhr.send();
        }
    </script>


<div class="right-nav">
                    <input type="search" id="searchInput" placeholder="Search recipes..." aria-label="Search" oninput="performSearch()">
                    <div id="searchResults" class="search-results"></div>
                    <button class="logout-btn">Log Out</button>
                </div>
    

    <main>
        <section class="gallery-grid">
            <?php
            include 'connection.php'; // Ensures I have a connection to the database
            $query = "SELECT * FROM recipes ORDER BY created_at DESC"; // Adjusts according to my table order
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
            
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="recipe-image">';
                    echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                    echo '<div><h3>' . htmlspecialchars($row['name']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['description']) . '</p></div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No recipes found.</p>';
            }
            $conn->close();
            ?>
        </section>
    </main>
    <footer>
        <ul class="footerLinks">
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Use</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
    </footer>

</body>
</html>
