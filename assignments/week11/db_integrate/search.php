<?php

include 'db_connect.php';

$ln = mysqli_real_escape_string($mysqli, $_GET['last_name']);
$sql = "SELECT first_name, last_name, email
        FROM person
        WHERE LOWER(last_name) = LOWER('$ln')";
$response = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

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
mysqli_close($mysqli);
?>