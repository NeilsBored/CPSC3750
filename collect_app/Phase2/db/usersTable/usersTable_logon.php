<?php
/*
  File: usersTable_logon.php
  Author: Shane John
  Date: 2025-07-30
  Course: CPSC 3750 – Web Application Development
  Purpose: Handles the user's log-on attempts on user_logonForm.php.
           Determines existing email, correct credentials, and account lock.
  Notes: More of a logic file for log-on, 
         but I required updating the db so this location felt right.
*/

// Include for db connection credential + user authenication 
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/usersTable_auth.php';

// In case the user finds a way to return to the login page, after they already logged in
if (is_logged_in()) 
{
    header('Location: ../../collect_app/phase2/index.php');
    exit;
}

// Check for POST to db - Determine log on or not
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // error(s) catch array
    $errors = [];
    // grab user attempt 
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    // Check for blanks
    if ($email === '' || $password === '') 
    {
        $errors[] = 'Please enter both email and password';
    } 
    // Start db check
    else 
    {
        //Sanitize input and get response
        $sql = $connection->prepare('SELECT * FROM users WHERE email = ?');
        $sql->bind_param('s', $email);
        $sql->execute();
        $result = $sql->get_result();
        $user = $result->fetch_assoc();
        // Verify user exisits
        if ($user) 
        {
            // Check account lock
            if ((int)$user['is_locked'] === 1) 
            {
                $errors[] = 'Account locked due to multiple failed login attempts';
            } 
            // Check password match (well..checking the hash)
            elseif (password_verify($password, $user['password_hash'])) 
            {
                // Perform log on using user id
                login_user($user);
                // Send user to Search Home
                header('Location: ../../collect_app/phase2/index.php');
                exit;
            } 
            // User exists and failed to enter the correct password
            else 
            {
                // Increment failure count
                $stmtUpd = $connection->prepare('UPDATE users SET failed_login_count = failed_login_count + 1 WHERE id = ?');
                $stmtUpd->bind_param('i', $user['id']);
                $stmtUpd->execute();
                // Time to Lock account? 
                if ($user['failed_login_count'] + 1 >= 3) 
                {
                    $stmtLock = $connection->prepare('UPDATE users SET is_locked = 1 WHERE id = ?');
                    $stmtLock->bind_param('i', $user['id']);
                    $stmtLock->execute();
                    $errors[] = 'Your account is now locked due to repeated failed login attempts';
                } 
                else 
                {
                    $remaining = 3 - ($user['failed_login_count'] + 1);
                    $errors[] = 'Incorrect Password! Attempts remaining: ' . $remaining;
                }
            }
        } 
        // Not found or wrong email
        else 
        {
            $errors[] = 'No account found with that email';
        }
    }
}
?>