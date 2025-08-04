<!--
  File: index.php
  Author: Shane John
  Date: 07-27-25
  Course: CPSC 3750 – Web Application Development
  Purpose: Home page for the collect app, provides live search and
           pre-loaded popular movies with further details and add buttons
           for each movie. 
  Notes: The "Add to Collection" button is disabled for movies already
         in the user's collection.
-->

<?php require_once __DIR__ . '/db/usersTable/usersTable_auth.php'; 
       
if (!isset($_GET['r'])) 
{
    $token = bin2hex(random_bytes(5));
    header("Location: index.php?r=$token");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1.0">
    <title>Movie Scout Search</title>
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
     <!-- Main Page -->
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
                    <th>Add Movies</th>
                </tr>
            </thead>
            <tbody id="resultsBody">
                <!-- Populated by collect.js -->
            </tbody>
        </table>
        </div>
    </main>
     <div class="modal" id="detailsModal">
        <div class="modal-content">
            <button id="modalClose" label="Close Details">&times;</button>
            <iframe id="detailsFrame" title="Movie Details"></iframe>
        </div>
    </div>
    <script>window.isLoggedIn = <?php echo is_logged_in() ? 'true' : 'false'; ?>;</script>
    <script src="js/collect.js"></script>
</body>
</html>