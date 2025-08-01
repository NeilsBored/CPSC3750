<?php
/*
  File: details_logic.php
  Author: Shane John
  Date: 2025-07-28
  Course: CPSC 3750 – Web Application Development
  Purpose: Pulls and displays selected movie's extended detail
  Notes: It's amazing what box shadows do!
*/

// Includes for api callbacks
require_once __DIR__ . '/../api/api_config.php';
require_once __DIR__ . '/../api/api_proxy.php';

// Setup Selected Movie Data
$queryTitle = isset($_GET['title']) ? trim($_GET['title']) : '';
if ($queryTitle === '') 
{
    http_response_code(400);
    echo '<p>No movie title provided.</p>';
    exit;
}
// Build URL/ Grab Data
$searchUrl = "{$tmdbApiBase}/search/movie?api_key={$tmdbApiKey}&language=en-US"
             . "&query=" . urlencode($queryTitle) . "&page=1";
$searchResult = fetchFromTMDb($searchUrl);
if (isset($searchResult['error'])) 
{
    echo '<p>Error: ' . htmlspecialchars($searchResult['message']) . '</p>';
    exit;
}
// Map response for the page
$movieData = null;
if (!empty($searchResult['results'][0]['id'])) 
{
    $id = (int)$searchResult['results'][0]['id'];
    $detailUrl = "{$tmdbApiBase}/movie/{$id}?api_key={$tmdbApiKey}&language=en-US";
    $detailResult = fetchFromTMDb($detailUrl);
    if (!isset($detailResult['error'])) 
    {
        $movieData = $detailResult;
    } 
    else 
    {
        echo '<p>Error: ' . htmlspecialchars($detailResult['message']) . '</p>';
        exit;
    }
}
?>