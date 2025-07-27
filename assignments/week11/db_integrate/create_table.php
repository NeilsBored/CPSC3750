<?php
include 'db_connect.php';

$sql = "CREATE TABLE person 
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL
);";

if (mysqli_query($mysqli, $sql) === TRUE) 
{
    echo "Person table created successfully!";
} 
else 
{
    printf("Could not create table: %s\n", mysqli_error($mysqli));
}
mysqli_close($mysqli);
?>
