<!--
  File: collect_nav.php
  Author: Shane John
  Date: 2025-08-01
  Course: CPSC 3750 – Web Application Development
  Purpose: Provides navigation for collection app pages
  Notes: Includes authentication to toggle admin and user options, with color diffs.
-->

<!-- Include for db connection credential + user authenication --> 
<?php
    require_once __DIR__ . '/db/usersTable/usersTable_auth.php';
?>
<nav>
    <ul class="nav">
        <img src="images/ticket.png" alt="collectIcon"><h2>MovieScout</h2>
        <li><a href="index.php">Search Home</a></li>
        <li><a href="stats.php">Collection Stats</a></li>
        <li><a href="about.php">How to Scout</a></li>
        <li><a href="../index.php">Phase 1</a></li>
    <div class="user-nav">
    <?php if (is_logged_in()): ?>
        <?php $user = current_user(); ?>
        <?php if ($user): ?>
            <li><a href="user_collection.php">My Collection</a></li>
            <li><a href="user_favorites.php">My Favorites</a></li>
        <?php endif; ?>
        <li><a href="user_profile.php">My Profile</a></li>
        <?php $user = current_user(); 
        if ($user && $user['is_admin'] === 1): ?>
            <li><a href="admin_users.php" id="admin">Admin: Users</a></li>
            <li><a href="admin_collections.php" id="admin">Admin: Collections</a></li>
        <?php endif; ?>
        <li><a href="db/usersTable/usersTable_logout.php" id="log-out">Logout</a></li>
    <?php else: ?>
        <li><a href="user_logonForm.php">Login</a></li>
        <li><a href="user_newForm.php" id="create">Create Profile</a></li>
    <?php endif; ?>
    </div>    
    </ul>
</nav>