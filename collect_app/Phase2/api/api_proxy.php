<?php
/*
  File: api_proxy.php
  Author: Shane John
  Date: 2025-07-22
  Course: CPSC 3750 – Web Application Development
  Purpose: Interface for TMDb API calls
  Notes: If there is anything I have learned from this project,
         it is that choosing the best API for a task is directly related to time and effort.
*/

// Include for API key + info
require_once __DIR__ . '/api_config.php';

/*
 * Parameters: $endpoint(string) - A fully formed TMDb URL call.
 * Return:     $data(array) - Decoded JSON array, or nothing at all.
 * Fetches JSON from a TMDb endpoint.
 */
function fetchFromTMDb(string $endpoint): array 
{
    // create cURL handle
    $handle = curl_init($endpoint);
    // Output Formatting
    curl_setopt_array($handle, 
[
        // String for JSON
        CURLOPT_RETURNTRANSFER => true,
        // I don't like waiting
        CURLOPT_TIMEOUT => 10,
    ]);
    // grab cURL response + close 
    $response = curl_exec($handle);
    $error = curl_error($handle);
    curl_close($handle);
    // Check for return from api
    if ($response === false) 
    {
        return ['error' => true, 'message' => 'Unable to reach TMDb API: ' . $error];
    }
    // Parse for JSON 
    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) 
    {
        return ['error' => true, 'message' => 'Invalid JSON Received'];
    }
    // Output data
    return $data;
}

/*
 * Parameters: none (reads from 'title' and 'max')
 * Return:     array [string $title, int $maxResults]
 * Parses and sanitizes GET requests.
 */
function parseRequestParams(): array 
{
    $title = isset($_GET['title']) ? trim($_GET['title']) : '';
    $maxResults = isset($_GET['max']) ? (int) $_GET['max'] : 100;
    return [$title, $maxResults];
}

/*
 * Parameters: $title(string) - Movie title to search for (popular="")
 * Return:     URL(string) - Fully formed TMDb API endpoint
 * Builds api call based on the provided title.
 */
function buildEndpoint(string $title): string 
{
    // Get creds
    global $tmdbApiBase, $tmdbApiKey;
    // Check input for blank
    if ($title !== '') 
    {
        // Create title search
        return "{$tmdbApiBase}/search/movie?api_key={$tmdbApiKey}&language=en-US"
             . "&query=" . urlencode($title) . "&page=1&include_adult=false";
    }
    // Default
    return "{$tmdbApiBase}/movie/popular?api_key={$tmdbApiKey}&language=en-US&page=1";
}

/*
 * Parameters: $rawResults(array) - initail results from TMDb API
 *             $maxResults(int) - Maximum number of results to be included
 * Return:     $formatted(array) - Simplified array of movie data for JSON output
 * Transforms TMDb results into a simplified format.
 */
function formatResults(array $rawResults, int $maxResults): array {
    global $tmdbImageBase;
    $formatted = [];
    foreach (array_slice($rawResults, 0, $maxResults) as $m) 
    {
        $formatted[] = 
        [
            'title' => $m['title'] ?? '',
            'original_title' => $m['original_title'] ?? '',
            'release_date' => $m['release_date'] ?? '',
            'rating' => $m['vote_average'] ?? '',
            'vote_count' => $m['vote_count'] ?? '',
            'overview' => $m['overview'] ?? '',
            'poster_url' => isset($m['poster_path']) ? "{$tmdbImageBase}{$m['poster_path']}" : ''
        ];
    }
    return $formatted;
}

// Only outputs JSON if accessed directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) 
{
    // Set header
    header('Content-Type: application/json');
    // Main flow (might change in phase 2)
    list($title, $maxResults) = parseRequestParams();
    $endpoint = buildEndpoint($title);
    $result   = fetchFromTMDb($endpoint);
    // Last check for errors
    if (isset($result['error'])) 
    {
        echo json_encode($result);
        exit;
    }
    // Format and output for use
    $results = formatResults($result['results'] ?? [], $maxResults);
    echo json_encode($results);
}