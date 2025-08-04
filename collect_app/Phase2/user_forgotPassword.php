<!--
  File: user_forgotPassword.php
  Author: Shane John
  Date: 2025-08-02
  Course: CPSC 3750 – Web Application Development
  Purpose: Provides a two-step form for users to reset their password using a security question.
  Notes: Steps switch based on email verification.
-->

<?php
require_once __DIR__ . '/db/usersTable/usersTable_auth.php';
require_once __DIR__ . '/db/db_config.php';
require_once __DIR__ . '/db/usersTable/usersTable_forgotPassword.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../../main_style.css">
    <link rel="stylesheet" href="css/collect.css">
    <link rel="stylesheet" href="css/users.css">
</head>
<body>
    <div class="wrapper">
        <?php include '../../navbar.php'; ?>
    </div>
    <header>
        <?php include 'collect_nav.php'; ?>
    </header>
    <main class="user-form">
        <h2>Reset Password</h2>
        <?php if (!empty($errors)): ?>
            <div>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($step === 1): ?>
        <div class="user-form" id="password-change">
            <form method="post">
                <label>Email:<br>
                    <input type="email" name="email" required>
                </label><br><br>
                <button type="submit" class="user-form" id="btn">Next</button>
            </form>
        </div>
        <?php else: ?>
        <div class="user-form" id="password-change">
            <form method="post">
                <p><strong><?php echo 'Security Question: '.htmlspecialchars($question); ?></strong></p>
                <input type="hidden" name="question" value="<?php echo htmlspecialchars($question); ?>">
                <label>Answer:<br>
                    <input type="text" name="answer" required>
                </label><br><br>
                <label>New Password:<br>
                    <input type="password" name="new_password" required>
                </label><br><br>
                <button type="submit" class="user-form" id="btn">Reset Password</button>
            </form>
        </div>
            
        <?php endif; ?>
    </main>
</body>
</html>