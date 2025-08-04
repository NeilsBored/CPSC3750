<?php
/*
  File: usersTable_logout.php
  Author: Shane John
  Date: 2025-07-30
  Course: CPSC 3750 – Web Application Development
  Purpose: Handles Log out requests from collect_navbar.php log out link
  Notes: This file may seem silly, but I thought it might be good to add an intermediary step
         between view and model, a control if you will.
*/

// Include for authentication file
require_once __DIR__ . '/usersTable_auth.php';
// Run log on function in authentication
logout_user();
// Redirect back to home page
header('Location: ../../index.php');
exit;