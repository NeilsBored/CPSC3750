<?php
/*
  File: collectionTable_admin.php
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

// Only admin user may view this page
$user = current_user();
if (!$user || $user['is_admin'] !== 1) 
{
    http_response_code(403);
    echo '<p>Access denied.</p>';
    exit;
}

// Grab the entire collection table records
$sql = $connection->prepare(
'SELECT u.name AS username, i.title AS movie_name, c.added_at
        FROM collection c
        JOIN users u ON c.user_id = u.id
        JOIN movies i ON c.movie_id = i.id
        ORDER BY c.added_at DESC');
$sql->execute();
$result = $sql->get_result();
// Fill Data array
$rows = [];
while ($row = $result->fetch_assoc()) 
{
    $rows[] = $row;
}
// close conection
$sql->close();
?>