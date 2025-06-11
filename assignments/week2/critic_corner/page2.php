<!--
  File: page2.php
  Author: Shane John
  Date: 2025-05-08
  Course: CPSC 3750 – Web Application Development
  Purpose: Showcases my personal favorite movies/shows
  Notes: Includes a list of my all-time favorites and most rewatchable films.
-->

<!DOCTYPE html>
<html lang="en">
	<head>
    	<title>Critic Corner</title>
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
			<section id="my_favorites">
				<h2>All-time Favorites</h2>
				<marquee behavior="alternate" direction="left">
    				<img src="images_critic/bladerunner.jpg">
					<img src="images_critic/dune.jpeg">
					<img src="images_critic/hitchhikersguide.jpg">
					<img src="images_critic/atlanta.jpg">
					<img src="images_critic/last of us.jpg">
					<img src="images_critic/menu.jpg">
					<img src="images_critic/thebear.jpg">
  				</marquee>
				<h2>Rewatchables</h2>
					<li>Everything Everywhere All At Once</li>
					<li>No Country for Old Men</li>
					<li>Eternal Sunshine of the Spotless Mind</li>
					<li>Spirited Away</li>
					<li>Into the Spider-Verse</li>
					<li>Whiplash</li>
					<li>Shane</li>
					<li>The Man Who Knew Too Much</li>
				<br>
			</section>

		</main>	
		<footer>	
			CPSC-3750-001
		</footer>
	</body>
</html>