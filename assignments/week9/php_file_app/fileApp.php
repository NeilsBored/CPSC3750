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
require_once __DIR__ . '/../../../../logic.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Number Classifier</title>
  <style>
    form { margin-bottom: 1em; }
    .results span { display: inline-block; background: #eef; padding: 0.2em 0.5em; margin: 0.1em; border-radius: 4px; }
  </style>
  <link rel="stylesheet" href="../../../main_style.css">
</head>
<body>
    <div class="wrapper">
      <?php include '../../../navbar.php'; ?>
    </div >
  <h1>Check Your Numbers</h1>
  <form method="post" action="">
    <label>Enter numbers (comma-separated):</label><br>
    <input type="text" name="numbers" size="50" required>
    <div style="margin-top:0.5em">
      <button type="submit" name="action" value="check">CHECK THESE NUMBERS</button>
      <button type="submit" name="action" value="armstrong">ARMSTRONG</button>
      <button type="submit" name="action" value="fibonacci">FIBONACCI</button>
      <button type="submit" name="action" value="prime">PRIME</button>
      <button type="submit" name="action" value="none">NONE</button>
      <button type="submit" name="action" value="reset">RESET</button>
    </div>
  </form>

  <?php if (!empty($display)): ?>
    <h2>Results:</h2>
    <div class="results">
      <?php foreach ($display as $num): ?>
        <span><?= htmlspecialchars($num) ?></span>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</body>
</html>
