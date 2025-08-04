<!--
  File: details.php
  Author: Shane John
  Date: 07-27-25
  Course: CPSC 3750 – Web Application Development
  Purpose: Show details of the selected movie from search page
  Notes: It's amazing what box shadows do!
-->

<!-- Include for backend php -->
<?php require_once __DIR__ . '/php/details_logic.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($queryTitle) ?> &mdash; Details</title>
  <link rel="stylesheet" href="../../main_style.css">
  <link rel="stylesheet" href="css/collect.css">
</head>
<body>
  <main class="container">
    <?php if ($movieData): ?>
      <h1><?= htmlspecialchars($movieData['title']) ?></h1>
      <div class="details">
        <!-- Image -->
        <?php if (!empty($movieData['poster_path'])): ?>
          <img src="<?= htmlspecialchars($tmdbImageBase . $movieData['poster_path']) ?>"
               alt="Poster for <?= htmlspecialchars($movieData['title']) ?>">
        <?php endif; ?>
        <!-- Details -->
        <div class="info">
          <p><b>Original Title:</b> <?= htmlspecialchars($movieData['original_title']) ?></p>
          <p><b>Release Date:</b> <?= htmlspecialchars($movieData['release_date']) ?></p>
          <p><b>Rating:</b> <?= htmlspecialchars($movieData['vote_average']) ?></p>
          <p><b>Vote Count:</b> <?= htmlspecialchars($movieData['vote_count']) ?></p>
          <p><b>Language:</b> <?= htmlspecialchars($movieData['original_language']) ?></p>
          <p><b>Overview:</b> <?= nl2br(htmlspecialchars($movieData['overview'])) ?></p>
        </div>
      </div>
    <?php else: ?>
      <p>No details found for “<em><?= htmlspecialchars($queryTitle) ?></em>”.</p>
    <?php endif; ?>
  </main>
</body>
</html>