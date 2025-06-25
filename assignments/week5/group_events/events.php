<!--
  File: events.php
  Author: Shane John
  Date: 2025-06-24
  Course: CPSC 3750 – Web Application Development
  Purpose: Main HTML file for Group: Events Assignment
  Notes: Nothing really to see here, just a simple page with event handlers for the events.
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>GroupEvents.html</title>
  <link rel="stylesheet" href="events.css">
  <link rel="stylesheet" href="../../../main_style.css">
</head>
<body>
 <div class="wrapper">
    <?php include '../../../navbar.php'; ?>
  </div >

  <h1 style="text-align: center;">Group Events</h1>
 
<div class="eventContainer">
  <h3>Animation Events</h3>
    <div id="box"></div>
    <p id="animStatus"></p>
</div>  
<div class="eventContainer">
  <h3>Drag Events</h3>
    <div id="dragMe" draggable="true">Drag This</div>
    <div id="dropZone">Drop Here</div>
    <p id="dragStatus"></p>
</div>
<div class="eventContainer">
  <h3>Input Events</h3>
    <input id="textInput" type="text" placeholder="Type Here…">
    <p id="inputStatus"></p>
</div>
<div class="eventContainer">
  <h3>Mouse Events</h3>
    <div id="mouseArea">Hover-over or Click-on This</div>
    <p id="mouseStatus"></p>
</div>
<div class="eventContainer">
  <h3>Focus Events</h3>
    <textarea id="area" rows="10" placeholder="Click to Focus Here…"></textarea>
    <p id="focusStatus"></p>
</div>

  <script src="events.js"></script>
</body>
</html>