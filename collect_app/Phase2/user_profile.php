<!--
  File: user_profile.php
  Author: Shane John
  Date: 2025-07-31
  Course: CPSC 3750 – Web Application Development
  Purpose: Displays the current user's profile information and allows password changes.
  Notes: Page requires authentication to access.
-->

<?php
    require_once __DIR__ . '/db/usersTable/usersTable_changePassword.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1.0">
    <title>Movie Scout Search</title>
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
    <main class="user-form" >

<h2>Profile Information</h2>
<p><b>Name:</b> <?php echo htmlspecialchars($user['name']); ?></p>
<p><b>Email:</b> <?php echo htmlspecialchars($user['email']); ?></p>
<p><b>Account Created:</b> <?php echo htmlspecialchars($user['created_at']); ?></p>
<p><b>Last Login:</b> <?php echo htmlspecialchars($user['last_login_at'] ?? 'Never'); ?></p>
<p><b>Total Logins:</b> <?php echo htmlspecialchars($user['login_count']); ?></p>
<p><b>Failed Login Count:</b> <?php echo htmlspecialchars($user['failed_login_count']); ?></p>
<p><b>Account Status:</b> <?php echo ((int)$user['is_locked'] === 1) ? 'Locked' : 'Active'; ?></p>
<div class="user-form" id="password-change">
    
  
    <?php if ($error): ?><div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    
<?php if ($message): ?><div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
    <h3>Change Password</h3>
    <form method="post">
        <label>Current Password:<br>
            <input type="password" name="current_password" id="password" required>
        </label><br><br>
        <label>New Password:<br>
            <input type="password" name="new_password" id="password" required>
        </label><br><br>
        <label>Confirm New Password:<br>
            <input type="password" name="confirm_password" id="confirm" required>
        </label><br><br>
        <button type="submit" id="btn">Change Password</button>
    </form>
</div>


    </main>
</body>
</html> 
