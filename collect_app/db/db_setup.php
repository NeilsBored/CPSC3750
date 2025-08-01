<?php
/*
  File: db_setup.php
  Author: Shane John
  Date: 2025-07-22
  Course: CPSC 3750 – Web Application Development
  Purpose: One-time run to create database with the needed table
  Notes: This was actually run without the php(hostinger thing), but I tested this file on my local and it worked.
*/

// Include for db connection credential
require_once __DIR__ . '/db_config.php';

// Double Check connection to db works
if ($connection->connect_error) 
{
    die('Connection failed at setup: ' . $connection->connect_error);
}
// Select and initialize table (if not made already)
$connection->select_db($db_name);
$sqlTable = <<<SQL
CREATE TABLE IF NOT EXISTS movies 
(
    id INT AUTO_INCREMENT PRIMARY KEY,l
    title VARCHAR(255) NOT NULL,
    release_date DATE NULL,
    rating FLOAT NULL,
    overview TEXT,
    poster VARCHAR(255),
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); 
SQL;
// knock-on the db with query + success message
if ($connection->query($sqlTbl) !== true) 
{
    die('Table creation failed: ' . $connection->error);
}
echo "Database and table initialized successfully.";
// End transmission
$connection->close();