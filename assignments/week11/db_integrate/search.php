<?php
/*
  File: search.php
  Author: Shane John
  Date: 2025-07-27
  Course: CPSC 3750 – Web Application Development
  Purpose: Implements backend for the frontend page.
  Notes: Creating a search is a lot eaiser when it's made with SQL.
*/

// Start Session
include 'db_connect.php';
// Sanitize before query
$ln = mysqli_real_escape_string($mysqli, $_GET['last_name']);
// Create query
$sql = "SELECT first_name, last_name, email
        FROM person
        WHERE LOWER(last_name) = LOWER('$ln')";
// Grab response
$response = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
// Generate matched list from response
echo "<nav><a href=\"insert_form.php\">Back to Add</a></nav>";
echo "<h1>Results for $ln</h1>";
if (mysqli_num_rows($response) === 0) 
{
    echo "<p>No matches found.</p>";
} 
else 
{
    echo "<table border='1'><tr><th>First</th><th>Last</th><th>Email</th></tr>";
    while ($row = mysqli_fetch_assoc($response)) 
    {
        echo "<tr>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
              </tr>";
    }
    echo "</table>";
}
// End Session
mysqli_close($mysqli);
?>