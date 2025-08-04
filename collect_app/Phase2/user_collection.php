<!--
  File: user_collection.css
  Author: Shane John
  Date: 2025-08-01
  Course: CPSC 3750 – Web Application Development
  Purpose: Displays the current user's collection list with options to remove items
           and add them to favorites.
  Notes: Users are given the option to remove any movie or add it to their favs.
-->

<?php
    // Include for page logic
    require_once __DIR__ . '/db/collectionTable/collectionTable_get.php';
    require_once __DIR__ . '/db/collectionTable/collectionTable_set.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1.0">
    <title>Movie Collection</title>
    <link rel="stylesheet" href="../../main_style.css">
    <link rel="stylesheet" href="css/collect.css">
    <link rel="stylesheet" href="css/collect2.css">
    <link rel="stylesheet" href="css/users.css">
</head>
<body>
    <!-- Common NavBar -->
    <div class="wrapper">
        <?php include '../../navbar.php'; ?>
    </div >
    <!-- Collect NavBar -->
    <header>  
        <?php include 'collect_nav.php'; ?>
    </header>
     <!-- Main Page -->
    <main class="container">

    <h2>My Personal Movie Collection</h2>

    <?php if (empty($collection)): ?>
        <p>You have not added any movies to your collection yet.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Added At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($collection as $col): ?>
                <tr>
                    <td>
                        <a href="details.php?title=<?php echo urlencode($col['title']); ?>" class="movie-link">
                            <?php echo htmlspecialchars($col['title']); ?>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars($col['added_at']); ?></td>
                    <td>
                        <form method="get" action="user_collection.php" style="display:inline">
                            <input type="hidden" name="action" value="remove">
                            <input type="hidden" name="movie_id" value="<?php echo $col['movie_id']; ?>">
                            <button type="submit" id="collect-remove">Remove From Collection</button>
                        </form>
                        <form method="get" action="user_favorites.php" style="display:inline">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="movie_id" value="<?php echo $col['movie_id']; ?>">
                            <button type="submit" id="favorites-add" >Add To Favorites</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        <?php if ($totalPages > 1): ?>
        <nav class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a class="btn" href="?page=<?php echo $i; ?>"
                    <?php if ($i === $page) echo 'style="background-color:#555"'; ?>>
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </nav>
        <?php endif; ?>
    <?php endif; ?>

    </main> 
</body> 
</html> 



