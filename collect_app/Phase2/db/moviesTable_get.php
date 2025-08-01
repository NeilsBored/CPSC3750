<?php
/*
  File: moviesTable_get.php
  Author: Shane John
  Date: 2025-07-22
  Course: CPSC 3750 – Web Application Development
  Purpose: Pull movies collection data from the db table
  Notes: This file will also most likely change in part 2
*/

// Include for db connection credential
require_once __DIR__ . '/db_config.php';

// Prepare statement
$sql = 'SELECT id, title, release_date, rating, overview, poster, added_at
        FROM movies
        ORDER BY added_at DESC';
// Grab Result of that statement
$result = $conn->query($sql);
// Loop to fill data array
$movies = [];
if ($result) 
{
    while ($row = $result->fetch_assoc()) 
    {
      $movies[] = $row;
    }
    // Set the raw result free
    $result->free(); 
}
// Package + Output
header('Content-Type: application/json');
echo json_encode($movies);
// End Transmission
$connect->close();