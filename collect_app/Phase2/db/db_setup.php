<?php
/*
  File: db_setup.php
  Author: Shane John
  Date: 2025-07-30
  Course: CPSC 3750 – Web Application Development
  Purpose: One-time run to create database with the needed table
  Notes: This was actually run through a php server, I got it to work with Hostinger!
*/

// Include for db connection credentials
require_once __DIR__ . '/db_config.php';


// Double Check connection to db works
if ($connection->connect_error) 
{
    die('Connection failed at setup: ' . $connection->connect_error);
}


/*
 * Parameters: none
 * Return:     void
 * Initializes database schema by creating required tables.
 */
function initialize_database(): void
{
    global $connection;
    $queries = 
    [
        // Users Table - holds account info and login stats
        'CREATE TABLE IF NOT EXISTS users 
        (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            password_hash TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            last_login_at TIMESTAMP,
            login_count INTEGER DEFAULT 0,
            security_question TEXT,
            security_answer TEXT,
            failed_login_count INTEGER DEFAULT 0,
            is_locked INTEGER DEFAULT 0,
            is_admin INTEGER DEFAULT 0
        )',

        'CREATE TABLE IF NOT EXISTS movies 
        (   
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            release_date DATE NULL,
            rating FLOAT NULL,
            overview TEXT,
            poster VARCHAR(255),
            added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )',
        // Collection table records which user has added which item and when
        'CREATE TABLE IF NOT EXISTS collection 
        (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            user_id INTEGER NOT NULL,
            movie_id INTEGER NOT NULL,
            added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
            UNIQUE(user_id, movie_id)
        )',
        // Favorites table records which items a user has marked as favorite
        'CREATE TABLE IF NOT EXISTS favorites 
        (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            user_id INTEGER NOT NULL,
            movie_id INTEGER NOT NULL,
            favorited_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
            UNIQUE(user_id, movie_id)
        )'
    ];

    foreach ($queries as $query) 
    {
        if ($sql = $connection->prepare($query)) 
        {
            $sql = $connection->prepare($query);
        if (! $sql) 
        {
            die('Prepare failed: ' . $connection->error);
        }
        if (! $sql->execute()) 
        {
            die('Execution failed: ' . $sql->error);
        }
        $sql->close();
        }
     }    
         // Create default admin account if it doesn't exist
        $adminEmail = 'admin@fake.com';
        $sql = $connection->prepare('SELECT id FROM users WHERE email = ?');
        $sql->bind_param('s', $adminEmail);
        $sql->execute();
        if (!$sql->get_result()->fetch_assoc()) 
        {
            $sql->close();
            $password = password_hash('admin123', PASSWORD_DEFAULT);
            $name = 'Admin';
            $insert = $connection->prepare('INSERT INTO users (name, email, password_hash, is_admin) VALUES (?, ?, ?, 1)');
            $insert->bind_param('sss', $name, $adminEmail, $password);
            $insert->execute();
            $insert->close();
        } 
        else 
        {
            $sql->close();
        }
   
}


// Run initialization
try 
{
    initialize_database();
    echo "Database and Tables Initialized Successfully!";
} 
// Is it a bad idea to name error variables error... I've been debate this.
catch (Exception $error) {
    error_log($error->getMessage());
    die('Database initialization failed.');
}
// End transmission
$connection->close();
