<!--
  File: page3.php
  Author: Shane John
  Date: 2025-05-10
  Course: CPSC 3750 – Web Application Development
  Purpose: A quick review of a movie I like a lot
  Notes: The movie is "The Hitchhiker's Guide to the Galaxy" and if you like the movie, the books are even better!
-->

<!DOCTYPE html>
<html lang="en">
	<head>
    	<title>Cirtic Corner</title>
    	<link rel="stylesheet" type="text/css" href="styles.css">
        <link rel="stylesheet" href="/main_style.css">
	</head>
  
	<body>
         <div class="wrapper" style="border-radius: 20px;">
      		<?php include '../../../navbar.php'; ?>
  		</div>
		<header>
			<img src="images_critic/Image.png" alt="Colorful camera icon"><h1>Shane's Critic Corner</h1>
		</header>

        <nav> <a href="page1.php">Welcome</a>
        | <a href="page2.php">My Personal Favorites</a> 
        | <a href="page3.php">A Movie Review</a> 
        | <a href="mailto:shanej@clemson.edu">Send me an email</a>
        </nav>
        <main>
            <section id="review">
                    <div>
                        <img src="images_critic/hitchhikersguide.jpg">
                        <a href="https://www.youtube.com/watch?v=xDRJRXSNqzw&t=4536s">Want to watch this movie for free? Click here.</a>
                    </div>
                    <div>
                        <header>
                            <h2><b>Movie Title:</b> The Hitchhiker's Guide to the Galaxy</h2>
                            <h2><b>Director:</b> Garth Jennings</h2>
                            <h2><b>Release Year:</b> 2005</h2>
                            <h2><b>Genre:</b> Science Fiction, Comedy</h2>
                            <h2><b>Starring:</b> Martin Freeman, Mos Def, Zooey Deschanel, Sam Rockwell</h2>
                            <h2><b>Summary:</b> A hilarious and imaginative adaptation of Douglas Adams' beloved book, filled with quirky characters and existential musings.</h2>
                        </header>
                        <footer>
                            <h2>"This movie balances absurd humor and thoughtful ideas in a way that's both clever and entertaining. The cast delivers 
                                strong performances and the story doesn't shy away from the strange or philosophical. It may not be for everyone, but for me, 
                                it captures the charm and curiosity of Douglas Adams' work in a really enjoyable way."
                            </h2>
                            <h2>Date: May 2025</h2>
                            <h2>Rating: 4.9 out of 5</h2>   
                        </footer>
                    </div>
                </div>
            </section>
        </main>

        <footer>	
            CPSC-3750-001
        </footer>
	</body>
</html>