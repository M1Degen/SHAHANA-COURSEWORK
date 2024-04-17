<?php
            include 'connection.php';
            $query = "SELECT * FROM recipes ORDER BY created_at DESC"; 
            $result = $conn->query($query);
            
            if ($result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {
                echo <div class="card" style="width: 18rem;">
                echo <div class="recipe-image">;
                echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                echo <div class="card-body">
                    <h3>' . htmlspecialchars($row['name']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['description']) . '</p>
                </div>';
                echo '</div>';
            }
            } else {
            echo '<p>No recipes found.</p>';
            }
            $conn->close();


