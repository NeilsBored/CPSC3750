<?php

$mysqli = mysqli_connect
(
    "151.106.97.51",
    "u431530241_admin",
    "Sammi526",
    "u431530241_People"
);

if (mysqli_connect_errno())
{
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>