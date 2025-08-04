<?php
/*
  File: db_config.php
  Author: Shane John
  Date: 2025-07-30
  Course: CPSC 3750 – Web Application Development
  Purpose: Sets credentials for MovieScoutDB
  Notes: Hidden on everything that is not my files.
*/

// Database credentials
$db_host = '151.106.97.51';
$db_user = 'u431530241_shane_admin';
$db_pass = 'KoraBean15!';
$db_name = 'u431530241_MovieScout';

/*
 * Parameters: none
 * Return:     mysqli - Connection object
 * Establishes a MySQLi connection using configured credentials (or just exits on error).
 */
function dodaDB(): mysqli 
{
    global $db_host, $db_user, $db_pass, $db_name;
    $connect = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($connect->connect_error) 
    {
        die('Database connection failed: ' . $connect->connect_error);
    }
    return $connect;
}

// Make connection available
$connection = dodaDB();