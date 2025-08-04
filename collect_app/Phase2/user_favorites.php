<!--
  File: user_favorites.php
  Author: Shane John
  Date: 2025-08-01
  Course: CPSC 3750 – Web Application Development
  Purpose: Displays the user's list of favorite movies with a "red-text" option to remove them.
  Notes: diversity of type to seperate better. see videos for this project.
-->

<?php
    // Include for page logics
    require_once __DIR__ . '/db/favoritesTable/favoritesTable_get.php';
    require_once __DIR__ . '/db/favoritesTable/favoritesTable_set.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1.0">
    <title>Favorite Movies</title>
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

        <h2>All My Favorite Movies</h2>

        <?php if (empty($favorites)): ?>
            <p>You have not favorited any movies yet.</p>
        <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Favorited At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($favorites as $fav): ?>
                    <tr>
                        <td>
                        <a href="details.php?title=<?php echo urlencode($fav['title']); ?>" class="movie-link">
                                <?php echo htmlspecialchars($fav['title']); ?>
                        </a>
                        </td>
                        <td><?php echo htmlspecialchars($fav['favorited_at']); ?></td>
                        <td>
                            <a href="user_favorites.php?action=remove&amp;movie_id=<?php echo $fav['movie_id']; ?>" style="color:red">Unfavorite</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
<?php endif; ?>



