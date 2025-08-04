<!--
  File: user_logonForm.php
  Author: Shane John
  Date: 2025-08-01
  Course: CPSC 3750 – Web Application Development
  Purpose: Provides user with a portal for logging on to their profile
  Notes: 'Seinfield voice' - What's the difference between a profile and an account anyway?
-->

<?php
    // Include for usertable add handler file
    require_once __DIR__ . '/db/usersTable/usersTable_logon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log In</title>
    <link rel="stylesheet" href="../../main_style.css">
    <link rel="stylesheet" href="css/collect.css">
    <link rel="stylesheet" href="css/collect2.css">
    <link rel="stylesheet" href="css/users.css">
</head>
<body>
    <!-- Common Navbar -->
    <div class="wrapper">
        <?php include '../../navbar.php'; ?>
    </div>
    <!-- Collect NavBar -->
    <header>  
        <?php include 'collect_nav.php'; ?>
    </header>   
    <main class="user-form">
        <h2>Log In</h2>
        <!-- Print for errors - esstential -->
        <?php if (!empty($errors)): ?>
        <div>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        <!-- log on form -->        
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <label>Email:</label><br>
                <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            <br><br>
            <label>Password:</label><br>
                <input type="password" name="password" required>
            <br><br>
            <button type="submit" class="user-form" id="btn">Log In</button>
        </form>
        <!--  -->     
        <p><a href="user_forgotPassword.php" style="color: royalblue;">Forgot your password?</a></p>
    </main>
</body>
</html>