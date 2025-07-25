<!--
  File: GroupCSS1.php
  Author: Shane John
  Date: 2025-05-10
  Course: CPSC 3750 – Web Application Development
  Purpose: Demo of Various Beginner CSS Properties
  Notes: covers videos the first 12 items on the w3schools CSS tutorial (Home - Height/Width).
-->

<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="/main_style.css">

<style>
    body {
        background-color: #000000;
    }

    /* This section is to demonstrate the use of CSS to set the background color, text color, and border color of a section. */
    #colors_section {
        background-color: #4b4e4a;
        color: #8fd791;
        width: 600px;
        border-style: solid;
        border-width: 5px;
        border-color: #cc8861;
        padding: 20px;
        font-family: Helvetica;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    /* This section is to demonstrate the use of CSS to adjust background properties. */
    #background_section {
        background-color: #000000;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: scroll;
        color: #ffffff;
        width: 600px;
        border-style: solid;
        border-width: 5px;
        border-color: #4644d5;
        padding: 20px;
        font-family: Helvetica;
        margin-bottom: 20px;
    }

    /* This section is to demonstrate the use of CSS to set up border styles, width, and colors. */
    #borders_section {
        background-color: #e7d4bf;
        color: #a34415;
        width: 600px;
        border-top-style: dotted;
        border-right-style: solid;
        border-bottom-style: dashed;
        border-left-style: double;
        border-width: 5px;
        border-radius: 10px;
        border-color: #db6927;
        padding: 20px;
        font-family: Helvetica;
    }

    /* This section is to demonstrate the use of CSS to adjust margins. */
    #margins_section {
        background-color: #d0eaea;
        color: #1c156c;
        margin-top: 70px;
        margin-left: 70px;
        width: 600px;
        border-style: solid;
        border-width: 5px;
        border-color: #1fa7ac;
        padding: 20px;
        font-family: Helvetica;
        margin-bottom: 20px;
    }

    /* This section is to demonstrate the use of CSS to adjust padding. */
    #padding_section {
        background-color: #bed2c7;
        color: #294d2b;
        width: 600px;
        border-style: solid;
        border-width: 5px;
        border-color: #1a8b1e;
        font-family: Helvetica;
        margin-bottom: 20px;
        padding: 30px 40px 30px 40px;
    }

    /* This section is to demonstrate the use of CSS to adjust height and width. */
    #heightwidth_section {
        background-color: #fde5e5;
        color: #932121;
        width: 500px;
        height: 300px;
        border-style: solid;
        border-width: 5px;
        border-color: #db3027;
        padding: 20px;
        font-family: Helvetica;
        margin-bottom: 20px;
       
    }
</style>
</head>

<body>
    <div class="wrapper">
        <?php include '../../../navbar.php'; ?>
    </div>
    <div id="colors_section" >
        <h1>COLORS</h1>
        <p>Demonstrates text, background, and border color.</p>
    </div>
    <div id="background_section">
        <h1>BACKGROUNDS</h1>
        <p>Has a black background, a background image with the attachment set to scroll, and uses the no-repeat style.</p>
    </div>
    <div id="borders_section">
        <h1>BORDERS</h1>
        <p>Demonstrates rounded borders with a width of 5px in an orange color and different border styles on each side.  </p>
    </div>
    <div id="margins_section">
        <h1>MARGINS</h1>
        <p>Demonstrates a left margin of 70px and a top margin of 70px.</p>
    </div>    
    <div id="padding_section">
        <h1>PADDING</h1>
        <p>Demonstrates a top and bottom padding of 30px and a left and right padding of 40px.</p>
    </div> 
    <div id="heightwidth_section">
        <h1>HEIGHT AND WIDTH</h1>
        <p>Demonstrates a width of 500px and a height of 300px.</p>  

</body>
</html>