<?php
session_start();
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Recipes</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="about_us.css">
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

</head>
<body>
    <header>
        <nav>
            <div class="nav-container">
                <ul class="navbar left-nav">
                    <li><a href="chef_dashboard.php">Account</a></li>
                    <li><a href="recipe.php">Recipes</a>
                
                    <li><a href="about_us.html">About</a></li>
                    <li><a href="faq.html">FAQ</a></li>
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
        <!-- Section 1:  -->
        <section class="imgcontainer"">
                <img src="images\R.jpeg" alt="Testimonial ">
        </section>
        <div>
            <h2 class = "LR">LATEST RECIPES</h2>
        </div>
        <!-- Section 2: Testimonials Grid -->
        <section class="testimonialsGrid">
            <div class="testimonialItem">
                <img src="images/OIP.jpeg" alt="Testimonial 1">
                <p>"Joining this  website has expanded my culinary horizons beyond measure." - Alex</p>
            </div>
            <div class="testimonialItem">
                <img src="images/delicious-asian-noodles-concept_23-2148773773.jpg" alt="Testimonial 2">
                <p>"I have discovered dishes I  never knew existed and now they're family favorites!" - Casey</p>
            </div>
            <div class="testimonialItem">
                <img src="images/delicious-chinese-food-asian-cuisine_841229-24577.jpg" alt="Testimonial 3">
                <p>"The variety of recipes available has truly enriched my cooking experience." - Jamie</p>
            </div>
            <div class="testimonialItem">
                <img src="images/penne-pasta-tomato-sauce-with-meat-tomatoes-decorated-with-pea-sprouts-dark-table_2829-3412.jpg" alt="Testimonial 4">
                <p>"Every recipe I've tried has turned out amazing. Highly recommend this platform!" - Pat</p>
            </div>
        </section>
        <!-- will add more content here  -->
        <section class="aboutSection">
            <h3>About Us</h3>
            <p>Discover the joy of cooking with our vast collection of recipes from around the world where the best chefs around the world share their own recipes.</p>
        </section>
    
        <section class="joinUsSection">
            <h3>Are you ready to discover new Recipes?</h3>
            <a href="#" class="joinUsButton">Join us</a>
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