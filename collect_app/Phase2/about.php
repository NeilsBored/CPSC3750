<!--
  File: about.php
  Author: Shane John
  Date: 07-29-25
  Course: CPSC 3750 – Web Application Development
  Purpose: Introduction to the collection item that was chosen for the project and the api that goes along with it.
  Notes: "About This Collection App" section was written to be all you really need to read to use the app.
-->

<?php require_once __DIR__ . '/db/usersTable/usersTable_auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Movie Scouting</title>
    <link rel="stylesheet" href="../../main_style.css">
    <link rel="stylesheet" href="css/collect.css">
</head>
<body>
    <!-- Common NavBar -->
    <div class="wrapper">
      <?php include '../../navbar.php'; ?>
    </div >
     <!-- Collect NavBar -->
    <header>  
        <?php include 'collect_nav.php'; ?>
    </header>
    <main class="container">
        <h1>About This Collection App</h1>
            <p>
                MovieScout lets users search TMDb's (The Movie Database) API and add movies to a shared public and personal collection.
                Each result displays the original title, release date, average rating, synopsis, and poster image.
                Selecting <b>"add to collection"</b> stores the movie in MovieScoutDB, and your choices now persists when the Page resets.
            </p>
            <p>
                Creating a profile lets you keep a personal collection, mark favorite movies, and view your profile details.
                Admin users can also browse all user accounts and every saved collection item.
            </p>
            <br>
        <h2>API Data Source</h2>
            <p>TMDb is a community-maintained database. You can obtain your own API key, if you wish too, using the link below.</p>
            <p>All searched movie data is retrieved live from the <b>TMDb API (version 3)</b>.</p>
            <br>
                <p><i><a href="https://developer.themoviedb.org/">Click Here for TMDb API Documentation</a></i></p>
            <br>
        <h2>Movies in The Public Collection</h2>
            <p>
               Movies are used as the public collection for the MovieScout app. When users push the "add to collection"
               button during their search, that movie's information is added to the movies table in the MovieScoutDB.
            </p><br>
            <p><i>Below is a list of the movies currently featured in <b>MovieScoutDB</b>:</i></p>
            <ul style="list-style: circle;">
                <?php
                $sql = $connection->prepare("SELECT DISTINCT title FROM movies");
                $sql->execute();
                $result = $sql->get_result();
                while ($row = $result->fetch_assoc()) 
                {
                    echo '<li>' . htmlspecialchars($row['title']) . '</li>';
                }
                ?>
            </ul>
    </main>
</body>
</html>