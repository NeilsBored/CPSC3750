<?php
/*
  File: stats_logic.php
  Author: Shane John
  Date: 2025-07-29
  Course: CPSC 3750 – Web Application Development
  Purpose: Implements data grabs from movies db and movies api
  Notes: Almost there... I think.
*/

// Includes for movie db and api callbacks
require_once __DIR__ . '/../db/db_config.php';
require_once __DIR__ . '/../api/api_config.php';
require_once __DIR__ . '/../api/api_proxy.php';

/*
 * Parameters: $connection(mysqli) - A mysqli connection instance.
 * Return:     $total(int) - Total number of movies in the database.
 * Retrieves the total count of movies in the table.
 */
function getTotalMovies(mysqli $connection): int 
{
    if ($sql = $connection->prepare('SELECT COUNT(DISTINCT title) FROM movies')) 
    {
        $sql->execute();
        $sql->bind_result($total);
        $sql->fetch();
        $sql->close();
        return (int)$total;
    }
    return 0;
}

/*
 * Parameters: $connection(mysqli) - A mysqli connection instance.
 * Return:     $data(array) - Most frequent movie title and its count.
 * Retrieves the most repeated movie title in the database.
 */
function getMostRepeatedMovie(mysqli $connection): array 
{
    if ($sql = $connection->prepare('SELECT title, COUNT(*) as count FROM movies 
                                            GROUP BY title ORDER BY count DESC LIMIT 1')) 
    {
        $sql->execute();
        $sql->bind_result($title, $count);
        $sql->fetch();
        $sql->close();
        return ['title' => $title, 'count' => $count];
    }
    return ['title' => 'N/A', 'count' => 0];
}

/*
 * Parameters: $connection(mysqli) - A mysqli connection instance.
 * Return:     $data(array) - Highest rated movie title and its rating.
 * Retrieves the movie with the highest rating.
 */
function getHighestRatedMovie(mysqli $connection): array 
{
    if ($sql = $connection->prepare('SELECT title, MAX(rating) FROM movies')) 
    {
        $sql->execute();
        $sql->bind_result($top_title, $top_rating);
        $sql->fetch();
        $sql->close();
        return ['title' => $top_title, 'rating' => $top_rating];
    }
    return ['title' => 'N/A', 'rating' => 'N/A'];
}

/*
 * Parameters: $apiBase(string) - API base URL.
 *             $apiKey(string) - API key.
 *             $period(string) - Trending period.
 *             $limit(int) - Number of items to return.
 * Return:     $out(array) - List of trending movies (with title and rating).
 * Fetches trending movie data from TMDb.
 */
function getTrendingMovies(string $apiBase, string $apiKey, string $period = 'day', int $limit = 5): array 
{
    $url = "{$apiBase}/trending/movie/{$period}?api_key={$apiKey}";
    $result = fetchFromTMDb($url);
    $out = [];
    if (!empty($result['results']) && !isset($result['error'])) 
    {
        foreach (array_slice($result['results'], 0, $limit) as $item) 
        {
            $out[] = ['title' => $item['title'] ?? 'Unknown', 'rating' => $item['vote_average'] ?? 'N/A'];
        }
    }
    return $out;
}

/*
 * Parameters: $apiBase(string) - API base URL.
 *             $apiKey(string) - API key.
 *             $type(string) - Resource type.
 *             $period(string) - Trending period.
 * Return:     $result(array) - Array of trending items.
 * Fetches trending data for the given type and timeframe.
 */
function getTrending(string $apiBase, string $apiKey, string $type, string $period): array 
{
    $url = "{$apiBase}/trending/{$type}/{$period}?api_key={$apiKey}";
    $result = fetchFromTMDb($url);
    return $result['results'] ?? [];
}

// Movies Table Stats
$stats['total_movies'] = getTotalMovies($connection);
$stats['most_repeated'] = getMostRepeatedMovie($connection);
$stats['highest_rated'] = getHighestRatedMovie($connection);
// Movie Database API Stats
$stats['trending_movies'] = getTrendingMovies($tmdbApiBase, $tmdbApiKey, 'day', 5);
$stats['trending_weekly_movies'] = getTrending($tmdbApiBase, $tmdbApiKey, 'movie', 'week');
$stats['trending_weekly_shows'] = getTrending($tmdbApiBase, $tmdbApiKey, 'tv', 'week');
$stats['trending_daily_shows'] = getTrending($tmdbApiBase, $tmdbApiKey, 'tv', 'day');
$stats['trending_weekly_people'] = getTrending($tmdbApiBase, $tmdbApiKey, 'person', 'week');
$stats['trending_daily_people'] = getTrending($tmdbApiBase, $tmdbApiKey, 'person', 'day');
?>