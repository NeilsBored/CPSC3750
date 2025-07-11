<!--
  File: hangman.php
  Author: Shane John
  Date: 2025-07-10
  Course: CPSC 3750 – Web Application Development
  Purpose: Frontend page for Clemson Hangman Game
  Notes: I though game were supposed to be fun, but now all I have is a headache.
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Group: Hangman</title>
        <link rel="stylesheet" href="hangman.css">
        <link rel="stylesheet" href="../../../main_style.css">
    </head>
    <body>
        <div class="wrapper">
            <?php include '../../../navbar.php'; ?>
        </div >
        <div id="game-container">
        <div id="game-left">
            <div id="background">
                <h1>The Clemson Hangman Game</h1>
                <p>Adapted By: Shane John</p>
            </div>
            <section style="padding:1%;">
                <div id="attemptsLeft" style="padding:3%;"></div>
                <img id="gallowsImg" src="images/gallows0.jpeg" alt="Gallow Stages">
                <div id="status"style="padding:2%;"></div>
                <div id="wordToGuess" style="padding:2%;"></div>
            </section>
        </div>
        <div id="game-right"></div>
            <section>
                <label>
                    <input type="checkbox" id="cheatMode">Cheat Mode
                </label>
                <div id="letters" class="letter-grid"></div>
            </section> 
        </div>
        </div>

        <script src="hangman.js"></script>
    </body>
    <footer></footer>
</html>