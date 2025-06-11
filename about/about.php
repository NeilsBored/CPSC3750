<!--
  File: about.php
  Author: Shane John
  Date: 2025-05-08
  Course: CPSC 3750 – Web Application Development
  Purpose: Introduction page for my personal information and interests.
  Notes: This page was previously included as the home page of the website.
-->

<!DOCTYPE html>

<style>
    .about{
        background-color: #1b2332;
    }
</style>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CPSC-3750 Summer Website</title>
            <link rel="stylesheet" href="/main_style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>

<body class="about">
    <div class="wrapper">
        <?php include '../navbar.php'; ?>
    </div>

    <div class="hero-section">
        <img src="about_assets/images/profile_top.png">
        <div class="content">
            <div>
                <img src="about_assets/images/Me.jpeg" alt="Shane John">
            </div>
            <div>
            <h2>Introduction</h2>
            <p>
                <b>Major:</b> Computer Science<br>
                <b>Minor:</b> Business Administration<br>
                <b>Graduation:</b> Fall 2025
            </p>
            </div>
        </div>
        
    </div>
    <div class="hero-section" style="margin-top: -255px;">
         <img src="about_assets/images/profile_middle.png">
        <div class="content">
            <div>
                <img src="about_assets/images/SAE.jpeg" alt="Shane John">
            </div>
            <div>
            <h2>Personal Interests</h2>
            <p>
                <b>Former</b> Member of Student Formula SAE<br>
                <b>Current</b> Member of Clemson AI Club
            </p>
            </div>
    </div>
        </div>
    <div>
     <div class="hero-section" style="margin-top: -255px;">
         <img src="about_assets/images/profile_bottom.png">
        <div class="content">
            <div>
                <img src="about_assets/images/Pets.jpeg" alt="Shane John">
            </div>
            <div>
            <h2>About Me</h2>
            <p>
               <b>I have</b>  a Frenchie named Kuzco and a Husky named Khora.<br>
                <b>I am</b> the fourth of six childern in my family.
            </p>
            </div>
        </div>
    </div>
  </div>    
 
</body>

</html>