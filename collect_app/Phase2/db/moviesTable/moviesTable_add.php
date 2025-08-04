<?php
/*
  File: moviesTable_add.php
  Author: Shane John
  Date: 2025-07-23
  Course: CPSC 3750 – Web Application Development
  Purpose: Handles getting data from api JSON, sanitizes it for the db, 
           and then adds the values into the table
  Notes: This file will be changed a lot in part 2.
*/

// Include for db connection credential
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/../usersTable/usersTable_auth.php';
require_login();

/*
 * Parameters: none
 * Return:     $data(array) - Decoded JSON 
 * Reads/decodes JSON input (or 400 errors and then exits).
 */
function getJsonPayload(): array 
{
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) 
    {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON payload response']);
        exit;
    }
    return $data;
}

/*
 * Parameters: $data(array) - Received payload data
 * Return:     $insertableData(array) - Sanitized movie data
 * Validates required fields and sanitizes values.
 */
function validateMovieData(array $data): array 
{
    $title = trim($data['title'] ?? '');
    if ($title === '') 
    {
        http_response_code(400);
        echo json_encode(['error' => 'Missing movie title']);
        exit;
    }
    $insertableData = 
    [
        'title'        => $title,
        'release_date' => $data['release_date'] ?? null,
        'rating'       => isset($data['rating']) ? (float) $data['rating'] : null,
        'overview'     => $data['overview'] ?? '',
        'poster'       => $data['poster'] ?? '',
    ];
    return $insertableData;  
}

/*
 * Parameters: $connect(mysqli Connection) - Connection session to db
 *             $movie(array) - Sanitized movie data
 * Return:     void
 * Prepares, verifies, the executes the insert in to movies tables (or sends error and exits).
 */
function insertMovie(mysqli $connect, array $movie): int 
{
    // Blank Temp Add Statement
    $sqlAdd = $connect->prepare
    (
'INSERT INTO movies (title, release_date, rating, overview, poster)
        VALUES (?, ?, ?, ?, ?)'
    );
    if (! $sqlAdd) 
    {
        http_response_code(500);
        echo json_encode(['error' => 'Prepare failed: ' . $connect->error]);
        exit;
    }
    // Verify/map insert data
    $sqlAdd->bind_param
    (
        'ssdss',
        $movie['title'],
        $movie['release_date'],
        $movie['rating'],
        $movie['overview'],
        $movie['poster']
    );
    // Add values to table + verify
    if (! $sqlAdd->execute()) 
    {
        http_response_code(500);
        echo json_encode(['error' => 'Insert failed: ' . $sqlAdd->error]);
        $sqlAdd->close();
        exit;
    }
    // Close connection
    $id = $connect->insert_id;
    $sqlAdd->close();
    return $id;
}

// Main flow
$payload = getJsonPayload();
$movie   = validateMovieData($payload);
$movieId = insertMovie($connection, $movie);
$collection = $connection->prepare('INSERT INTO collection (user_id, movie_id) VALUES (?, ?)');
if ($collection) {
    $collection->bind_param('ii', $_SESSION['user_id'], $movieId);
    if (! $collection->execute()) {
        http_response_code(500);
        echo json_encode(['error' => 'Insert collection failed: ' . $collection->error]);
        $collection->close();
        $connection->close();
        exit;
    }
    $collection->close();
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Prepare collection failed: ' . $connection->error]);
    $connection->close();
    exit;
}
// Close/ Success message
echo json_encode(['status' => 'success']);
$connection->close();