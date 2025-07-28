<?php
/*
  File: insert.php
  Author: Shane John
  Date: 2025-07-27
  Course: CPSC 3750 – Web Application Development
  Purpose: Adds person from entered inputs in form
  Notes: Kind of a repeat from creating the table, but with SQL injection prevention.
*/

// Create session
include 'db_connect.php';
// Sanitize before the query
$first = mysqli_real_escape_string($mysqli, $_POST['first_name']);
$last = mysqli_real_escape_string($mysqli, $_POST['last_name']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
// Create query
$sql = "INSERT INTO person (first_name, last_name, email)
        VALUES ('$first', '$last', '$email')";
    // Check to for successful add
    if (mysqli_query($mysqli, $sql) === TRUE)
    {
        echo "<nav><a href=\"insert_form.php\">Back to Add</a></nav>";
        echo "<b>Person added:</b> $first $last ($email)";
    }
    else 
    {
        printf("Could not insert record: %s\n", mysqli_error($mysqli));
    }
// End Session
mysqli_close($mysqli);
?>
