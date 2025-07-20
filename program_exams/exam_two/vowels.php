<!--
  File: vowels.php
  Author: Shane John
  Date: 2025-05-19
  Course: CPSC 3750 – Web Application Development
  Purpose: Main Page for Programming Exam 2 - Vowel Counter Contraption!
  Notes: Is it over yet?
-->

<!-- Include for Logic -->
<?php
    require __DIR__. '/vowelsLogic.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Program Exam - Two </title>
    <link rel="stylesheet" href="../../main_style.css">
    <link rel="stylesheet" href="vowels.css">
</head>
<body>
    <!-- Common Navbar -->
    <div class="wrapper">s
        <?php include '../../navbar.php'; ?>
    </div >
    <!-- Exam Implementation Area -->
    <div class="E2">
        <h1> Vowel Counter Contraption </h1>
        <!-- Buttons with Number of vowels -->
        <div id="buttons"> 
        <h3> Browse Words By Number Of Vowels </h3>    
            <?php foreach ($counts as $c): ?>
                <button data-count="<?= $c ?>"><?= $c ?></button>
            <?php endforeach; ?>
        </div>
        <!-- Original word.txt word dispay, sorted by vowel numbe buttons and scrollable -->
        <div id="word-list"><p>(Click-A-Button To Show Word List)</p></div>

        <!-- Drag and Dropped words or "favorites" -->
        <div id="favs">
            <h3> Drag-N-Drop Your Favorite Words:</h3>
            <div id="drop-area">(Drop Words here)</div>
            <div id="drop-count"><i>Dropped: 0</i></div> 
        </div>
           
    </div>
    <!-- Transfer for php-to-js -->
    <script>
        const vowelTotals = <?= json_encode($vowelTotals, JSON_HEX_TAG) ?>;
    </script>
    <!-- Main Script -->
    <script src="vowels.js"></script>
</body>
</html>