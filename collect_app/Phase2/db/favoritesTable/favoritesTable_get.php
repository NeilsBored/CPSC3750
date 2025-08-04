<?php
/*
  File: favoritesTable_get.php
  Author: Shane John
  Date: 2025-08-02
  Course: CPSC 3750 – Web Application Development
  Purpose: Provides an array of the user's favorited movies
  Notes: Really really should have just made an input query as a parameter funciton.
*/

// Include for db connection credential + user authenication 
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/../usersTable/usersTable_auth.php';
require_login();

// Grab user's favorites from favorites table
$sql = $connection->prepare
(
'SELECT f.*, i.title, i.release_date, f.favorited_at 
  FROM favorites f 
  JOIN movies i ON f.movie_id = i.id 
  WHERE f.user_id = ? 
  ORDER BY f.favorited_at DESC'
);
$sql->bind_param('i', $_SESSION['user_id']);
$sql->execute();
// setup query output for use elsewhere
$result = $sql->get_result();
$favorites = $result->fetch_all(MYSQLI_ASSOC);
$sql->close();
?>