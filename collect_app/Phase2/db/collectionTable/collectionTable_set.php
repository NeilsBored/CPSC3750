<?php
/*
  File: collectionTable_set.php
  Author: Shane John
  Date: 2025-08-01
  Course: CPSC 3750 – Web Application Development
  Purpose: Performs an add or removal action on collection table depending on the button the user push on the frontend.
  Notes: Making functions felt like over kill for this file.
*/

// Include for db connection credential + user authenication 
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/../usersTable/usersTable_auth.php';
require_login();

// Handle add/remove movies
if (isset($_GET['action'], $_GET['movie_id']) && is_numeric($_GET['movie_id'])) 
{
    $movieId = (int)$_GET['movie_id'];
    $action = $_GET['action'];
    // Add movie to collection table
    if ($action === 'add') 
    {
        $sql = $connection->prepare('INSERT IGNORE INTO collection (user_id, movie_id) VALUES (?, ?)');
        $sql->bind_param('ii', $_SESSION['user_id'], $movieId);
        $sql->execute();
        $sql->close();
    } 
    // Remove movie from collection table
    elseif ($action === 'remove') 
    {
        $sql = $connection->prepare('DELETE FROM collection WHERE user_id = ? AND movie_id = ?');
        $sql->bind_param('ii', $_SESSION['user_id'], $movieId);
        $sql->execute();
        $sql->close();
    }
    // Send user back to collections page (if not already looking at it)
    header('Location: user_collection.php');
    exit;
}
?>