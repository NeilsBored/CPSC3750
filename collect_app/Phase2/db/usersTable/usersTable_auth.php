<?php
/*
  File usersTable_auth.php
  Author: Shane John
  Date: 2025-07-30
  Course: CPSC 3750 – Web Application Development
  Purpose: Main interface for user login and logout actions
  Notes: This part took sooo much time to plan out and google...my head hurts.
*/

// Include for db connection 
require_once __DIR__ . '/../db_config.php';
// Start session before any output
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
 * Parameters: none
 * Return:     (bool)
 * Checks if the user is currently logged in.
 */
function is_logged_in(): bool
{
    return isset($_SESSION['user_id']);
}

/*
 * Parameters: none
 * Return:     array or null
 * Retrieves currently logged in user's records (or null if not found).
 */
function current_user(): ?array
{
    // first make sure someone is logged in
    if (!is_logged_in()) 
    {
        return null;
    }
    // Query the user table for session's user_id.
    global $connection;
    $sql = $connection->prepare('SELECT * FROM users WHERE id = ?');
    $sql->bind_param('i', $_SESSION['user_id']);
    $sql->execute();
    $result = $sql->get_result();
    return $result->fetch_assoc() ?: null;
}

/*
 * Parameters: none
 * Return:     (bool)
 * Checks if a user is an admin account.
 */
function is_admin(): bool
{
    return !empty($_SESSION['is_admin']);
}

/*
 * Parameters: user(array) - User record containing an 'id' field.
 * Return:     void
 * Logs in the user by updating last login timestamp, resetting failed login count, and setting session variables.
 */
function login_user(array $user): void
{   
    // Update last login timestamp and increment login count
    global $connection;
    $sql = $connection->prepare('UPDATE users SET last_login_at = CURRENT_TIMESTAMP, login_count = login_count + 1, failed_login_count = 0 WHERE id = ?');
    $sql->bind_param('i', $user['id']);
    $sql->execute();
    $_SESSION['user_id'] = $user['id'];
    // If I had more time I would make this field a hash verification with a second password instead.
    $_SESSION['is_admin'] = (int)$user['is_admin'] === 1;
}

/* 
 * Parameters: none
 * Return:     void
 * Logs out the user by clearing session variables and destroying the session.
 */
function logout_user(): void
{
    unset($_SESSION['user_id'], $_SESSION['is_admin']);
    session_destroy();
}

/*
 * Parameters: none
 * Return:     void
 * Redirects unauthenticated users to login page.
 */
function require_login(): void
{
    if (!is_logged_in()) 
    {
        header('Location: user_logonForm.php');
        exit;
    }
}

