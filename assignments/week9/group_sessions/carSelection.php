<?php
/*
  File: carSelection.php
  Author: Shane John
  Date: 2025-07-14
  Course: CPSC 3750 – Web Application Development
  Purpose: Acts as landing page for the assingment, showing the selection of cars
  Notes: I made very small style adjustments, but otherwise only use the mainstyle.css for this 
    to save time. (I may do this mostly going forward, since the last few assingments are more backend.
    .. please don't hate me)
*/
// Start or Resume
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>  
  <title>Car Selection Page</title>
  <link rel="stylesheet" href="../../../main_style.css">
</head>
<body>
  <div class="wrapper">
    <?php include '../../../navbar.php'; ?>
  </div >
  <div style="margin-left:2%">
    <h1>Car Selection Page</h1>
    <form action="carDisplay.php" method="post">
      <label for="cars">Choose your cars:</label><br>
      <select name="cars[]" id="cars" multiple size="7" style="padding:5px;">
        <option value="Toyota 4Runner">Toyota 4Runner</option>
        <option value="Honda Civic">Honda Civic</option>
        <option value="Ford F-150">Ford F-150</option>
        <option value="Dodge Challenger">Dodge Challenger</option>
        <option value="Chevrolet Tahoe">Chevrolet Tahoe</option>
        <option value="Tesla Model S">Tesla Model S</option>
        <option value="Rivian R2">Rivian R2</option>
      </select><br><br>
      <input type="submit" value="Submit Selections" style="padding:5px;">
    </form>
  </div>
</body>
</html>