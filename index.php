<!--
  File: index.php
  Author: Shane John
  Date: 2025-05-10
  Course: CPSC 3750 – Web Application Development
  Purpose: A home page for CPSC-3750 Summer 2025
  Notes: Looking for ideas on what else to add to this page.
-->

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CPSC-3750 Summer Website</title>
  <link rel="stylesheet" href="main_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <style>
    .content .text {
      display: flex;
      align-items: flex-start;
    }
    .content .text .header-section {
      display: flex;
      flex-direction: column;
      margin-left: 30px;
    }
    .content .text .paragraph-section {
      text-align: left;
      margin-left: 50px;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <?php include 'navbar.php'; ?>
  </div>
 
  <div class="hero-section" style="height: 100vh;" >
      <img src="home_assets/images/background.png" alt="Background Image" style="height: 70%">
      <div class="content" style="height:30%; top: 43%;">
        <div class="text">
          <div class="header-section">
            <h2>CPSC-3750</h2>
            <h4>The Home Page</h4>
          </div>
          <div class="paragraph-section">
            <p>Hello, my name is Shane John.
            <br><br>
                This is a web site developed 
            <br>for CPSC-3750 Summer 2025.
            </p>
          </div>
        </div>
      </div>
    </div>
    </body>
</html>