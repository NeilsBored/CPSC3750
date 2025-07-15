<!DOCTYPE html>
<html lang="en">
<head>
  <title>Button Move Demo</title>
  <link rel="stylesheet" href="../../../main_style.css">
  <link rel="stylesheet" href="ButtonMove.css">
</head>
<body>
    <!--Common NavBar-->
  <div class="wrapper">
    <?php include '../../../navbar.php'; ?>
  </div>
  <nav>
    <a href="#controls" id="controlsLink">Controls</a>
    <a href="#displayArea" id="displayLink">Display</a>
    <a href="#about" id="aboutLink">About</a>
  </nav>

  <section id="controls">
    <label for="colorSelect">Color:</label>
    <select id="colorSelect">
      <option>Red</option>
      <option>Green</option>
      <option>Blue</option>
      <option>Yellow</option>
      <option>White</option>
    </select>
    <button id="makeBtn">Make Button</button>
    <span id="totalDisplay">Total clicked sum: 0</span>
    <button id="moveToggle">MOVE</button>
  </section>

  <section id="displayArea"></section>

  <section id="about">
    <h2>About</h2>
    <p>This demo lets you create numbered buttons in random places, recolor them, sum their values, and animate them.</p>
  </section>

  <script src="ButtonMove.js"></script>
</body>
</html>
