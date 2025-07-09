<?php
// 1) Build a filesystem path to words.txt, one directory above this script
$wordFile = __DIR__ . '/../../../../words.txt';

// 2) Read all non-blank lines into array
$words = file(
  $wordFile,
  FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
);

// 3) Pick at random, trim it, lowercase it, and output it
if ($words) {
  $random = $words[array_rand($words)];
  echo strtolower(trim($random));
} else {
  // if the file cant be read
  http_response_code(500);
  echo 'Error loading word list.';
}
?>
