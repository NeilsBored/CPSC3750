<?php

include 'db_connect.php';

$sql = "SELECT first_name, last_name, email 
        FROM person
        ORDER BY last_name";
$response = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
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
mysqli_close($mysqli);
?>

