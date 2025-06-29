<!--
  File: jQuery.html
  Author: Shane John
  Date: 2025-06-27
  Course: CPSC 3750 – Web Application Development
  Purpose: A showcase for the jQuery widgets and effects
  Notes: Mostly the same as the provided example, but I tried to add my own spin in some parts.
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>jQuery Demo</title>
    <link rel="stylesheet" href="../../../main_style.css">
    <!-- jQuery and jQuery UI-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link   rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Assignment CSS and JS -->
    <link rel="stylesheet" href="jQuery.css">
    <script src="jQuery.js" defer></script>
</head>
<body>
  <div class="wrapper">
        <?php include '../../../navbar.php'; ?>
  </div>

  <div id="jquery">
  <h1>Welcome to The jQuery Homepage</h1>
    <p>Hover over the black box to reveal the 3 divs.</p>
    <p>After the Reveal, push the buttons to make them fade out.</p>
    <section>    
      <div style="margin-bottom:10px;">
        <button id="fade1">Fade div 1</button>
        <button id="fade2">Fade div 2</button>
        <button id="fade3">Fade div 3</button>
      </div>
      <div class="content">
        <p>A paragraph in a div.</p>
        <p>“A common mistake that people make when trying to design something 
            completely foolproof is to underestimate the ingenuity of complete fools.” <br>
            <b>Douglas Adams</b>
        </p>
      </div>
      <div class="content">
        <p>A paragraph in another div.</p>
        <p>“Everyone should be able to do one card trick, tell two jokes, and recite three poems, 
            in case they are ever trapped in an elevator.” <br>
            <b>Lemony Snicket</b>
        </p>
      </div>
      <div class="content">
        <p>A paragraph in another another div.</p>
        <p>“We have so much time and so little to do. Strike that, reverse it.” <br>
            <b>Roald Dahl</b>
        </p>
      </div>
    </section>
    
    <p>Purchase Date: <input type="text" id="datepicker"></p>
    <p> Enter a date to see the different expiration dates in the accordian below.</p>
    <div id="accordion">
      <h3>Apple</h3>
        <div>
          <p>An Apple would expire on: <span id="expire1"></p>
        </div>
      <h3>Banana</h3>
        <div>
          <p>A Banana would expire on: <span id="expire2"></p>
        </div>
      <h3>Carrot</h3>
        <div>
          <p>A Carrot would expire on: <span id="expire3"></p>
        </div>
    </div>

    <div id="progressbar"></div>
  </div>
  
</body>
</html>
