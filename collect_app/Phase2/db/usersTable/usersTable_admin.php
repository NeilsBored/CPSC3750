<?php
/*
  File: usersTable_admin.php
  Author: Shane John
  Date: 2025-08-04
  Course: CPSC 3750 – Web Application Development
  Purpose: Provides an array of all users in usersTable, 
           specifically name,email, created date/time, 
           last login, total logins, and failed attempts
  Notes: Doing the extra credit parts is either a really bad or a really good idea.
*/

// Include for db connection credential + user authenication 
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/../usersTable/usersTable_auth.php';
require_login();

// Only admin user may view this page!!
$user = current_user();
if (!$user || $user['is_admin'] !== 1) 
{
    http_response_code(403);
    echo '<p>Access Denied</p>';
    exit;
}

// Handle unlock request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['unlock_id'])) 
{
    $uid = (int)$_POST['unlock_id'];
    $sql = $connection->prepare('UPDATE users SET failed_login_count = 0, is_locked = 0 WHERE id = ?');
    $sql->bind_param('i', $uid);
    $sql->execute();
    $sql->close();
    header('Location: admin_users.php');
    exit;
}

// Fetch full users list
$sql = $connection->prepare('SELECT id, name, email, created_at, last_login_at, login_count, failed_login_count, is_locked FROM users ORDER BY created_at DESC');
$sql->execute();
$result = $sql->get_result();
// Fill in array
$users = [];
while ($row = $result->fetch_assoc()) 
{
    $users[] = $row;
}
$sql->close();
?>