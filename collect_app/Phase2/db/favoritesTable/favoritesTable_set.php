<?php
/*
  File: favoritesTable_set.php
  Author: Shane John
  Date: 2025-08-02
  Course: CPSC 3750 – Web Application Development
  Purpose: Performs an add or removal action on favorites table 
           depending on the button the user pushed on the frontend.
  Notes: Mostly the same as other "set" files.
*/

// Include for db connection credential + user authenication 
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/../usersTable/usersTable_auth.php';
require_login();

// Handle add/remove actions
if (isset($_GET['action']) && isset($_GET['movie_id']) && is_numeric($_GET['movie_id'])) 
{
    $movieId = (int)$_GET['movie_id'];
    $action = $_GET['action'];
    // Add movie to favorites table
    if ($action === 'add') 
    {
        $sql = $connection->prepare('INSERT IGNORE INTO favorites (user_id, movie_id) VALUES (?, ?)');
        $sql->bind_param('ii', $_SESSION['user_id'], $movieId);
        $sql->execute();
        $sql->close();
    } 
    // Remove movie from favorites table
    elseif ($action === 'remove') 
    {
        $sql = $connection->prepare('DELETE FROM favorites WHERE user_id = ? AND movie_id = ?');
        $sql->bind_param('ii', $_SESSION['user_id'], $movieId);
        $sql->execute();
        $sql->close();
    }
    // Redirect to favorites page
    header('Location: user_favorites.php');
    exit;
}

?>