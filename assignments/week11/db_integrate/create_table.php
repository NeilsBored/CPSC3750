<?php
/*
  File: create_table.php
  Author: Shane John
  Date: 2025-07-27
  Course: CPSC 3750 – Web Application Development
  Purpose: Creates the person table in the peopleDB
  Notes: Only ran this once, and had to run it in phpMyAdmin to get it to work.
*/

// Start session
include 'db_connect.php';
// Create query w/ required fields
$sql = "CREATE TABLE person 
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL
);";
// Try/did it work? check
if (mysqli_query($mysqli, $sql) === TRUE) 
{
    echo "Person table created successfully!";
} 
else 
{
    printf("Could not create table: %s\n", mysqli_error($mysqli));
}
// End session
mysqli_close($mysqli);
?>
