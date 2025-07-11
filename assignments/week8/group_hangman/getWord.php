<?php
/*
  File: getWord.php
  Author: Shane John
  Date: 2025-07-10
  Course: CPSC 3750 – Web Application Development
  Purpose: Handles locating and getting a random word from the list for each game.
  Notes: A little different, but the logic is still close to the original. 
*/

// Get the word list 
$wordFile = __DIR__.'/../../../../words.txt';  
if (!file_exists($wordFile)) {          
    http_response_code(500);
    exit('Error loading word list-1');
}
// Get a random word
$words = file($wordFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (!$words) {                            
    http_response_code(500);
    exit('Error loading word list-2');
}
// Share that word
echo strtolower(trim($words[array_rand($words)]));
?>
