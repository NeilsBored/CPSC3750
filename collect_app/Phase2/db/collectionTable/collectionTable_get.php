<?php
/*
  File: collectionTable_get.php
  Author: Shane John
  Date: 2025-08-02
  Course: CPSC 3750 – Web Application Development
  Purpose: Provides an array of the user's movie collection
  Notes: Technically can show the first 100, but that sure is a alot of movies.
*/

// Include for db connection credential + user authenication 
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/../usersTable/usersTable_auth.php';
require_login();

// Requried per page count
$moviesPerPage = 100;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $moviesPerPage;
// Count total movies in collection for page number
$countsql = $connection->prepare('SELECT COUNT(*) FROM collection WHERE user_id = ?');
$countsql->bind_param('i', $_SESSION['user_id']);
$countsql->execute();
$countsql->bind_result($totalmovies);
$countsql->fetch();
$countsql->close();
$totalPages = (int)ceil($totalmovies / $moviesPerPage);

// Get user's collection data
$sql = $connection->prepare
(
    'SELECT c.movie_id, i.title, c.added_at
     FROM 
     (
         SELECT movie_id, MAX(added_at) AS added_at
         FROM collection
         WHERE user_id = ?
         GROUP BY movie_id
     ) AS c
     JOIN movies i ON c.movie_id = i.id
     ORDER BY c.added_at DESC
     LIMIT ? OFFSET ?'
);
$sql->bind_param('iii', $_SESSION['user_id'], $moviesPerPage, $offset);
$sql->execute();
$result = $sql->get_result();
// Fill Collection Table array
$collection = [];
while ($row = $result->fetch_assoc()) 
{
    $collection[] = $row;
}
$sql->close();
?>