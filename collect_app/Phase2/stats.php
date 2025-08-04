<!--
  File: stats.php
  Author: Shane John
  Date: 07-27-25
  Course: CPSC 3750 – Web Application Development
  Purpose: Displays Statistics from the movies table
           and available trending stats from the api.
  Notes: Even though the movies that are added to the collect are not tracked for repeats,
         I thought it would be cool to so the most repeated movies.
-->

<!-- Include for backend php -->
<?php 
    require_once __DIR__ . '/php/stats_logic.php';
    require_once __DIR__ . '/db/usersTable/usersTable_auth.php'; 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Statistics</title>
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
        <!-- Statistics from Movies table -->
        <div class="db-stats">
        <h1>Public Collection Statistics</h1>
            <p><b>Total Movies in Collection:</b> <?= htmlspecialchars($stats['total_movies']) ?></p>
            <p><b>Most Repeated Movie:</b> 
                <?= htmlspecialchars($stats['most_repeated']['title']) ?> 
                (<?= htmlspecialchars($stats['most_repeated']['count']) ?> times)
            </p>
            <p><b>Highest Rated Movie:</b> 
                <?= htmlspecialchars($stats['highest_rated']['title']) ?> 
                (Rating: <?= htmlspecialchars($stats['highest_rated']['rating']) ?>)
            </p>
        </div>
        <!-- Statistics from api calls -->
        <div class="api-stats">
        <h1>Movie Database API Statistics </h1>

        <!-- Trending Movies (Today) -->
        <?php if (!empty($stats['trending_movies'])): ?>
            <section class="api-table">
                <h3>Trending Movies (Today)</h3>
                <table>
                    <thead>
                        <tr id="movies"><th>Movie Title</th><th>Average Rating</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stats['trending_movies'] as $m): ?>
                            <tr>
                                <td><?= htmlspecialchars($m['title']) ?></td>
                                <td><?= htmlspecialchars($m['rating']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section class="api-table">
        <?php endif; ?>
        <!-- Trending Movies (This Week) -->
        <?php if (!empty($stats['trending_weekly_movies'])): ?>
            <section class="api-table">
                <h3>Trending Movies (This Week)</h3>
                <table>
                    <thead>
                        <tr id="movies"><th>Movie Title</th><th>Average Rating</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach (array_slice($stats['trending_weekly_movies'], 0, 5) as $m): ?>
                            <tr>
                                <td><?= htmlspecialchars($m['title'] ?? $m['name'] ?? 'Unknown') ?></td>
                                <td><?= htmlspecialchars($m['vote_average'] ?? 'N/A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php endif; ?>

         <!-- Trending TV Shows (Today) -->
        <?php if (!empty($stats['trending_daily_shows'])): ?>
            <section class="api-table">
                <h3>Trending TV Shows (Today)</h3>
                <table>
                    <thead>
                        <tr id="shows"><th>Show Title</th><th>Average Rating</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach (array_slice($stats['trending_daily_shows'], 0, 5) as $s): ?>
                            <tr>
                                <td><?= htmlspecialchars($s['name'] ?? 'Unknown') ?></td>
                                <td><?= htmlspecialchars($s['vote_average'] ?? 'N/A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php endif; ?>
        <!-- Trending TV Shows (This Week) -->
        <?php if (!empty($stats['trending_weekly_shows'])): ?>
            <section class="api-table">
                <h3>Trending TV Shows (This Week)</h3>
                <table>
                    <thead>
                        <tr id="shows"><th>Show Title</th><th>Average Rating</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach (array_slice($stats['trending_weekly_shows'], 0, 5) as $s): ?>
                            <tr>
                                <td><?= htmlspecialchars($s['name'] ?? 'Unknown') ?></td>
                                <td><?= htmlspecialchars($s['vote_average'] ?? 'N/A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php endif; ?>
       
         <!-- Trending People (Today) -->
        <?php if (!empty($stats['trending_daily_people'])): ?>
            <section class="api-table">
                <h3>Trending People (Today)</h3>
                <table>
                    <thead>
                        <tr id="people"><th>Person Name</th><th>Average Rating</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach (array_slice($stats['trending_daily_people'], 0, 5) as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['name'] ?? 'Unknown') ?></td>
                                <td><?= htmlspecialchars($p['popularity'] ?? 'N/A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php endif; ?>
        <!-- Trending People (This Week) -->
        <?php if (!empty($stats['trending_weekly_people'])): ?>
            <section class="api-table">
                <h3>Trending People (This Week)</h3>
                <table>
                    <thead>
                        <tr id="people"><th>Person Name</th><th>Average Rating</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach (array_slice($stats['trending_weekly_people'], 0, 5) as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['name'] ?? 'Unknown') ?></td>
                                <td><?= htmlspecialchars($p['popularity'] ?? 'N/A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php endif; ?>
       </div>
    </main>
</body>
</html>