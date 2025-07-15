<?php
/*
  File: carDisplay.php
  Author: Shane John
  Date: 2025-07-14
  Course: CPSC 3750 – Web Application Development
  Purpose: Displays the user select cars from the selections main page
  Notes: Agian I really enjoy the simplicity of GET/POST methods.
*/
session_start();   
  //check for selection POST call
  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    // Stores selections in session array
    $_SESSION['cars'] = $_POST['cars'] ?? [];
  }
  //Update Global
  $cars = $_SESSION['cars'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Car Display Page</title>
  <link rel="stylesheet" href="../../../main_style.css">
</head>
<body>
  <div class="wrapper">
    <?php include '../../../navbar.php'; ?>
  </div >

  <h1>Car Display Page</h1>
  <?php if (empty($cars)): ?>
    <p>No Cars Currrently Selected</p>
  <?php else: ?>
    <ul>
    <?php foreach ($cars as $car): ?>
      <li><?= htmlspecialchars($car) ?></li>
    <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <p>
    <a href="carClear.php">Clear Selections</a>
    |
    <a href="carSelection.php">Back to Selections Page</a>
  </p>
</body>
</html>