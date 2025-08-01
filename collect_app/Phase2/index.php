<!--
  File: collect.php
  Author: Shane John
  Date: 07-27-25
  Course: CPSC 3750 – Web Application Development
  Purpose: Home page for the collect app, provides live search and
           pre-loaded popular movies with further details and add buttons
           for each movie. 
  Notes: Which movies are added to the database is not tracked currently,
         refreshing the page will reset which ones were gray-ed out.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1.0">
    <title>Movie Scout - Home</title>
    <link rel="stylesheet" href="../../main_style.css">
    <link rel="stylesheet" href="css/collect.css">
</head>
<body>
    <!-- Common NavBar -->
    <div class="wrapper">
      <?php include '../../navbar.php'; ?>
    </div >
    <!-- Main Page -->
    <header>  
    <nav label="Main Navigation">
        <ul class="nav">
            <img src="images/ticket.png" alt="collectIcon"><h2>MovieScout</h2>
            <li><a href="index.php">Search Home</a></li>
            <li><a href="stats.php">Collection Stats</a></li>
            <li><a href="about.php">How to Scout</a></li>
            <li><a href="../index.php">Phase 1</a></li>
        </ul>
    </nav>
    </header>
    <main class="container">
        <h1>Search the Movie Database API</h1>
        <form id="searchForm">
            <input type="text" id="searchInput" name="title" placeholder="Enter a movie title">
            <button type="submit">Search</button>
        </form>
        <div id="results">
        <table>
            <thead>
                <tr>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Release Date</th>
                    <th>Rating Average</th>
                    <th>More Details</th>
                    <th>Add Moives</th>
                </tr>
            </thead>
            <tbody id="resultsBody">
                <!-- Populated by collect.js -->
            </tbody>
        </table>
        </div>
    </main>
    <script src="js/collect.js"></script>
</body>
</html>