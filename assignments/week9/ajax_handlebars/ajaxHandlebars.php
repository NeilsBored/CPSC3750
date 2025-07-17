<!--
  File: ajaxHandlebars.php
  Author: Shane John
  Date: 2025-07-15
  Course: CPSC 3750 – Web Application Development
  Purpose: Frontend page for Ajax and Handlebars Demo - Uses Handlebars temp for Player's data
  Notes: With the Playoffs happening recently, I decided to use 
         past and present NHL Players as my example data.
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Ajax-Handlebars </title>
  <!-- Local Copy of Handlebars -->
  <script src="../../../js/handlebars-latest.js"></script>
  <!-- Main and Assignment Stylings -->
  <link rel="stylesheet" href="../../../main_style.css">
  <link rel="stylesheet" href="ajaxHandlebars.css">
</head>
<body>
  <!-- Common Navbar -->
  <div class="wrapper">
    <?php include '../../../navbar.php'; ?>
  </div >
  <h1 style="margin:1% 0 1% 1.5%"> The Hockey Dream Team </h1>
  <!-- Rendered Columns -->
  <div id="players-container"></div>
    <!-- Players Handle Template -->
    <script id="players-template" type="text/x-handlebars-template">
      <div class="positions-container">
        <!-- Players Position Columns -->
        {{#each positions}}
        <div class="position-column">
          <h2>{{position}}</h2>
          <!-- Current Position Players -->
          {{#each players}}
            <div class="player-card">
              <strong>{{name}}</strong><br>
              <span>{{position}}, #{{number}}</span>
            </div>
          {{/each}}
        </div>
        {{/each}}
      </div>
  </script>
  <script src="ajaxHandlebars.js"></script>
</body>
</html>
