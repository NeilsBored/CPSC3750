<?php
/*
  File: usersTable_forgotPassword.php
  Author: Shane John
  Date: 2025-08-03
  Course: CPSC 3750 – Web Application Development
  Purpose: Handles the user's forgot password starting from user_logonForm.php.
           Determines existing email, correct credentials, and account lock.
  Notes: Starting to get in to the final details now!
*/


/*
 * Parameters: $connection(mysqli connection object) - Db Connection
 *             $email(string) - The email address assigned to the user's account.
 * Return:     (array) or false if not found - 
 * Finds a user by their email and retrieves the ID and security question.
 */
function findUserByEmail($connection, $email) 
{   
    $uid='';
    $question='';
    // query to find the user's security question for display 
    $sql = $connection->prepare('SELECT id, security_question FROM users WHERE email = ?');
    $sql->bind_param('s', $email);
    $sql->execute();
    $sql->bind_result($uid, $question);
    if ($sql->fetch()) 
    {
        $sql->close();
        return ['id' => $uid, 'question' => $question];
    }
    $sql->close();
    return false;
}

/*
 * Parameters: $connection(mysqli connection object) - Db Connection
 *             $uid(int) - User's user table id 
 *             $answer(string) - Hashed security question answer
 * Return:     (bool)
 * Verifies the security answer for the user.
 */
function verifySecurityAnswer($connection, $uid, $answer) 
{
    $stored_answer='';
    $sql = $connection->prepare('SELECT security_answer FROM users WHERE id = ?');
    $sql->bind_param('i', $uid);
    $sql->execute();
    $sql->bind_result($stored_answer);
    $sql->fetch();
    $sql->close();
    return password_verify($answer, $stored_answer);
}

/*
 * Parameters: $connection(mysqli connection object) - Db Connection 
 *             $uid(int) - User's user table id 
 *             $newPassword(string) - The new password to replace the old password
 * Return:     void
 * Updates user's password and resets login locks.
 */
function updateUserPassword($connection, $uid, $newPassword)
{
    $hash = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = $connection->prepare
    (
        'UPDATE users 
         SET password_hash = ?, failed_login_count = 0, is_locked = 0 
         WHERE id = ?');
    $sql->bind_param('si', $hash, $uid);
    $sql->execute();
    $sql->close();
}

/*
 * Parameters: none
 * Return:     void
 * Clears password resets session data.
 */
function clearResetSession() 
{
    unset($_SESSION['reset_user_id'], $_SESSION['reset_email']);
}

/*
 * Parameters: $connection(mysqli connection object) - Db Connection
 *             $errors(array) - hole for all my problems
 *             $step(int) - determines reset step
 *             $question(string) - User's securtiy question
 *             $email(string) - User's email
 * Return:     void
 * Processes the forgot-password fix.
 */
function processForgotPassword($connection, &$errors, &$step, &$question, &$email) 
{
    // Step 1 - Get user security data
    if (isset($_POST['email']) && !isset($_POST['answer'])) 
    {
        $email = trim($_POST['email']);
        $user = findUserByEmail($connection, $email);
        // Are they a user?
        if ($user) 
        {
            $_SESSION['reset_user_id'] = $user['id'];
            $_SESSION['reset_email'] = $email;
            $question = $user['question'];
            $step = 2;
        } 
        // can forget an password you dont have.
        else 
        {
            $errors[] = 'No account found with that email.';
        }
    } 
    // Step 2 - Get the password reset
    elseif (isset($_POST['answer']) && isset($_SESSION['reset_user_id'])) {
        $answer = $_POST['answer'];
        $new_pass = $_POST['new_password'] ?? '';
        $uid = $_SESSION['reset_user_id'];
        // Wrong security answer
        if (!verifySecurityAnswer($connection, $uid, $answer)) 
        {
            $errors[] = 'Incorrect answer.';
            $step = 2;
            $question = $_POST['question'] ?? '';
        } 
        // Doesnt matter - I cant get this to work :{
        elseif (strlen($new_pass) < 8) 
        {
            $errors[] = 'Password must be at least 8 characters.';
            $step = 2;
            $question = $_POST['question'] ?? '';
        }
        // Good to go!
        else 
        {
            updateUserPassword($connection, $uid, $new_pass);
            clearResetSession();
            $_SESSION['message'] = 'Password reset successful. Please log in.';
            // send to logon page
            header('Location: user_logonForm.php');
            exit;
        }
    }
}

// Intialization of object/vars
$errors = [];
$step = 1;
$question = '';
$email = '';
// run call
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    processForgotPassword($connection, $errors, $step, $question, $email);
} 
else 
{
    clearResetSession();
}

?>