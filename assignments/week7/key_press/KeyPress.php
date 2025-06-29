<!--
  File: KeyPress.html
  Author: Shane John
  Date: 2025-06-27
  Course: CPSC 3750 – Web Application Development
  Purpose: Frontend fluff to implement the backend mess 
  Notes: The border radius change on the navbar is intentional, I wanted to showcase the back ground change a little more.
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>KeyPress Demo</title>
  <link rel="stylesheet" href="KeyPress.css">
  <link rel="stylesheet" href="../../../main_style.css">
  <script src="../jquery-3.7.1.min.js"></script>
  <script src="KeyPress.js"></script>
</head>
  <div class="wrapper" style="border-radius: 20px;">
        <?php include '../../../navbar.php'; ?>
  </div>
  <h1>Interactive KeyPress Event Handler Web Demo</h1>
    <h3>Press any key!</h3>
        <div id="output">See Your Keypress Here...</div>
        <p>All Vowels will be forced to be uppercase.<br>
           Press R, G, or B to change the background color to red, green, or blue.
        </p>
</body>
</html>