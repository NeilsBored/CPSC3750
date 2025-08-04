<!--
  File: admin_collections.php
  Author: Shane John
  Date: 2025-08-02
  Course: CPSC 3750 – Web Application Development
  Purpose: Lists all collected movies for administrative review.
  Notes: Simple read-only view of the public collection.
-->

<?php
    // Include for page logic
    require_once __DIR__ . '/db/collectionTable/collectionTable_admin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1.0">
    <title>Admin Collections List</title>
    <link rel="stylesheet" href="../../main_style.css">
    <link rel="stylesheet" href="css/collect.css">
    <link rel="stylesheet" href="css/collect2.css">
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
        <h2>One Collection To Rule Them All</h2>
        <?php if (empty($rows)): ?>
            <p>No items collected.</p>
        <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Title</th>
                    <th>Added At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r): ?>
                <tr>
                    <td><?php echo htmlspecialchars($r['username']); ?></td>
                    <td><?php echo htmlspecialchars($r['movie_name']); ?></td>
        
                    <td><?php echo htmlspecialchars($r['added_at']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
<?php endif; ?>