  <?php
  /*
  File: usersTable_changePassword.php
  Author: Shane John
  Date: 2025-08-03
  Course: CPSC 3750 – Web Application Development
  Purpose: Handles the user changing their password on the profile page.
  Notes: Already sign in, so logically this shouldnt need as much security...I think.
*/

// Include for db connection credential + user authentication
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/../usersTable/usersTable_auth.php';
require_login();
// Variable need things
$user = current_user();
$message = '';
$error = '';
// Begin on post
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $currentPass = $_POST['current_password'] ?? '';
    $newPass = $_POST['new_password'] ?? '';
    $confirmPass = $_POST['confirm_password'] ?? '';
    //Wrong password
    if (!password_verify($currentPass, $user['password_hash'])) 
    {
        $error = 'Incorrect password entered.';
    } 
    // Blanks
    elseif ($newPass === '' || $confirmPass === '') 
    {
        $error = 'Please enter and confirm your new password agian.';
    } 
    // Mis-type on confirm
    elseif ($newPass !== $confirmPass) 
    {
        $error = 'New passwords do not match.';
    } 
    // Good to Update
    else 
    {
        $newHash = password_hash($newPass, PASSWORD_DEFAULT);
        $sql = $connection->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
        $sql->bind_param('si', $newHash, $user['id']);
        $sql->execute();
        $sql->close();
        $message = 'Password Changed Successfully!';
    }
}
?>