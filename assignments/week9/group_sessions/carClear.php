<?php
/*
  File: carClear.php
  Author: Shane John
  Date: 2025-07-14
  Course: CPSC 3750 – Web Application Development
  Purpose: Clears the select car(s) from the session and send the user to back to display page
  Notes: Not much to say here, that the comments don't already.
*/
session_start();
    //Reset car list
    unset($_SESSION['cars']);   
// transfer to display      
header('Location: carDisplay.php');  
exit;