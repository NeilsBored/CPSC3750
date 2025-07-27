<?php

include 'db_connect.php';

$first = mysqli_real_escape_string($mysqli, $_POST['first_name']);
$last = mysqli_real_escape_string($mysqli, $_POST['last_name']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);

$sql = "INSERT INTO person (first_name, last_name, email)
        VALUES ('$first', '$last', '$email')";
    if (mysqli_query($mysqli, $sql) === TRUE)
    {
        echo "<nav><a href=\"insert_form.php\">Back to Add</a></nav>";
        echo "<b>Person added:</b> $first $last ($email)";
    }
    else 
    {
        printf("Could not insert record: %s\n", mysqli_error($mysqli));
    }
mysqli_close($mysqli);
?>
