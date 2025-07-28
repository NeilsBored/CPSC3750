<?php
/*
  File: db_connect.php
  Author: Shane John
  Date: 2025-07-27
  Course: CPSC 3750 – Web Application Development
  Purpose: Starts connection to people database
  Notes: Password hidden in GitHub repo.
*/

// Connection Creation
$mysqli = mysqli_connect
(
    "151.106.97.51",
    "u431530241_admin",
    "Sammi526",
    "u431530241_People"
);
// Connect success check
if (mysqli_connect_errno())
{
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>