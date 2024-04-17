<?php
session_start();
include('connection.php');


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$result = $conn->query("SELECT id, name, description, cook_id FROM recipes");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Recipes</title>
</head>
<body>
    <h1>Manage Recipes</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Cook ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($recipe = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $recipe['id']; ?></td>
                <td><?php echo htmlspecialchars($recipe['name']); ?></td>
                <td><?php echo htmlspecialchars($recipe['description']); ?></td>
                <td><?php echo $recipe['cook_id']; ?></td>
                <td>
                    <a href="edit_recipe.php?id=<?php echo $recipe['id']; ?>">Edit</a>
                    <a href="delete_recipe.php?id=<?php echo $recipe['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
