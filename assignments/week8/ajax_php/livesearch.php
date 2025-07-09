<!--
  File: livesearch.php
  Author: Shane John
  Date: 2025-07-08
  Course: CPSC 3750 – Web Application Development
  Purpose: Frontend page from chap 11 source code
  Notes: Minor changes to get common navbar in, and I made a quick style document.
-->

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>U.S State Capitals</title>
    <link rel="stylesheet" href="ajaxPHP.css">
    <link rel="stylesheet" href="../../../main_style.css">
    <script type="text/javascript" src="ajax.js"></script>
   </head>
   <body>
    <div class="wrapper">
      <?php include '../../../navbar.php'; ?>
    </div >
    <div class="search">
     <h1>U.S State Capitals - Live Search</h1>
      <p>
        <strong>Search for a State:</strong>
        <input type="text" size="40" id="searchlive" placeholder="Type any state name...">
      </p>
      <div id="results">
          <ul id="list">
            <li>[Capitol Results Display Here]</li>
          </ul>
      </div>
     </div>
     <script type="text/javascript" src="search.js"></script>
   </body>
</html>
