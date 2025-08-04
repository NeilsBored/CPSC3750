<?php
/*
  File usersTable_add.php
  Author: Shane John
  Date: 2025-07-31
  Course: CPSC 3750 – Web Application Development
  Purpose: Handles creation of new user in Users table.
  Notes: This is the second most worstest part of this phase.
*/

// Include for db connection credential + user authenication
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/usersTable_auth.php';
// error(s) catch array
$errors = [];

// start session (if not already)
if (session_status() === PHP_SESSION_NONE) 
{
    session_start();
}

// If already logged in, then they are a user..back to search home and who knows how they got here.
if (is_logged_in()) 
{
    header('Location: index.php');
    exit;
}

/*
 * Parameters: email(string) - Email address to be check.
 * Return:     (bool)
 * Checks if a user with the given email already exists in users table.
 */
function check_email_exists(string $email): bool 
{
    // I really should have turned the query statements action into a function
    global $connection;
    $count=0;
    $sql = $connection->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
    $sql->bind_param('s', $email);
    $sql->execute();
    $sql->bind_result($count);
    if (!$sql->fetch()) 
    {
        $count = 0;
    }
    $sql->close();
    return $count > 0;
}

/*
 * Parameters: name(string) - The user's name.
 *             email(string) - The user's email address.
 *             password(string) - The user's plaintext password.
 *             question(string or null) - Optional security question.
 *             answer(string or null) - Optional answer to the security question.
 * Return:     none
 * Registers a new user in the database, sets their session user_id, 
 * and then redirects back to search home.
 */
function register_user(string $name, string $email, string $password, ?string $question, ?string $answer): void 
{
    global $connection;
    try 
    {
        // Hash creation and the bacon to go with it (I'm so tired)
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $secureAnswerHash = $answer !== null ? password_hash($answer, PASSWORD_DEFAULT) : null;
        // Add user to user db
       $sql = $connection->prepare(
          'INSERT INTO users
             (name, email, password_hash, security_question, security_answer, last_login_at, login_count) 
             VALUES
             (?, ?, ?, ?, ?, NOW(), 1)'
       );
        $sql->bind_param('sssss', $name, $email, $passwordHash, $question, $secureAnswerHash);
        // Identify session id
        if ($sql->execute()) 
        {
            $_SESSION['user_id'] = $connection->insert_id;
            header('Location: index.php');
            exit;
        }
        // Need to try again ol' chap
        else 
        {
            error_log($sql->error);
            throw new Exception("Registration Failed");
        }

    } 
    catch (Exception $error) 
    {
        error_log($error->getMessage());
    }
}

/*
 * Parameters: none
 * Return:     void
 * Handles the registration form submission: validates CSRF token(done before the week 12 quiz), input fields, 
 * checks for an existing email, and registers user on successful run.
 */
function handle_registration(): void 
{

    global $connection, $errors;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        // verify session token match
        $csrf_token = $_POST['csrf_token'] ?? '';
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) 
        {
            $errors[] = 'Invalid CSRF token.';
            return;
        }
        // Grab form inputs
        $name = trim($_POST['name'] ?? '');
        $email = strtolower(trim($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';
        $securityQuestion = trim($_POST['security_question'] ?? '') ?: null;
        $securityAnswer = trim($_POST['security_answer'] ?? '') ?: null;
        // Check inputs 
        if ($name === '' || $email === '' || $password === '' || $confirm === '') 
        {
            $errors[] = 'All fields marked with * are required.';
        }
        if ($password !== $confirm) 
        {
            $errors[] = 'Passwords do not match.';
        }
        if (strlen($password) < 8) 
        {
            $errors[] = 'Password must be at least 8 characters long.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $errors[] = 'Invalid email address.';
        }
        if (check_email_exists($email)) 
        {
            $errors[] = 'An account with that email already exists.';
        }
        // Create user registrations + greeting
        if (empty($errors)) 
        {
            register_user($name, $email, $password, $securityQuestion, $securityAnswer);
        }
    }
}

// A randomized session token id to prevent cross site
if (empty($_SESSION['csrf_token'])) 
{
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
