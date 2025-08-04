<?php
/*
  File: collectionTable_titles.php
  Author: Shane John
  Date: 2025-08-27
  Course: CPSC 3750 – Web Application Development
  Purpose: Returns a JSON array of titles in the current user's collection
  Notes: Used by the search page to disable "Add" buttons for movies already collected.
*/

// Include for db connection credential + user authentication
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/../usersTable/usersTable_auth.php';
require_login();

$sql = $connection->prepare
(
'SELECT m.title FROM collection c 
        JOIN movies m ON c.movie_id = m.id 
        WHERE c.user_id = ?');
$sql->bind_param('i', $_SESSION['user_id']);
$sql->execute();
$result = $sql->get_result();
// Fill in titles array
$titles = [];
while ($row = $result->fetch_assoc()) 
{
    $titles[] = $row['title'];
}
$sql->close();

echo json_encode($titles);
?>