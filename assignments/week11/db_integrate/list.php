<?php
/*
  File: list.php
  Author: Shane John
  Date: 2025-07-27
  Course: CPSC 3750 – Web Application Development
  Purpose: Generates list of all person table records
  Notes: I dislike the spacing between the first and last name, but the staff is currently experiencing time constraints.
*/

// Start session
include '../../../../db_connect.php';
// Create query
$sql = "SELECT first_name, last_name, email 
        FROM person
        ORDER BY last_name";
// Grab the response
$response = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
// Generate page w/ peoples list
echo "<nav><a href=\"insert_form.php\">Back to Add</a></nav>";
echo "<h1>All The People</h1>";
echo "<table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>";
    While ($row = mysqli_fetch_assoc($response))
    {
        echo "<tr>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
              </tr>";
    }
echo "</table>";
// Close Session
mysqli_close($mysqli);
?>

