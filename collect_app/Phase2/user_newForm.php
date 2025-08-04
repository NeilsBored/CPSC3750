<!--
  File: user_newForm.php
  Author: Shane John
  Date: 2025-07-31
  Course: CPSC 3750 – Web Application Development
  Purpose: Presents registration form for new users with validation and CSRF protection.
  Notes: Uses lots helper functions to handle registration logic.
-->

<?php
    require_once __DIR__ . '/db/usersTable/usersTable_auth.php';
    require_once __DIR__ . '/db/usersTable/usersTable_add.php';
    handle_registration(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1.0">
    <title>Create Profile</title>
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
<main class="user-form">
    <h2>Create Profile</h2>
    <?php if (!empty($errors)): ?>
        <div>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" class="new-form">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <label>Name*:<br>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
        </label><br><br>
        <label>Email*:<br>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
        </label><br><br>
        <label>Password*:<br>
            <input type="password" name="password" id="password" required>
        </label><br><br>
        <label>Confirm Password*:<br>
            <input type="password" name="confirm_password" id="confirm" required>
        </label><br><br>
        <label>Security Question (for password reset):<br>
            <input type="text" name="security_question" id="sec-question" value="<?php echo htmlspecialchars($_POST['security_question'] ?? ''); ?>">
        </label><br><br>
        <label>Security Answer:<br>
            <input type="text" name="security_answer" id="sec-answer" value="<?php echo htmlspecialchars($_POST['security_answer'] ?? ''); ?>">
        </label><br><br>
        <button type="submit" id="btn">Let's Get Started!</button>
    </form>
</main>
</body>
</html>
