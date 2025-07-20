<?php
/*
  File: vowelsLogic.php
  Author: Shane John
  Date: 2025-05-19
  Course: CPSC 3750 – Web Application Development
  Purpose: backend server side scripting for Programming Exam 2
  Notes: Used this page for the user-defined sort: https://www.w3schools.com/php/func_array_usort.asp
*/

    // Get Words from file
    $wordsList = file(__DIR__ . '/exam_words.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    // 2-d array for counts-words
    $vowelTotals = [];
    foreach ($wordsList as $w)
    {
        // regEX match for all vowels
        preg_match_all('/[aeiou]/i', $w,$vowelsFound);
        // Count of vowels found
        $count = count($vowelsFound[0]);
        // Add to array w/ count
        $vowelTotals[$count][] = $w;
    }
    
    // Sort each count group by custom rule using string lengths. Is n't really a word by the way?
    foreach ($vowelTotals as &$words)
    {
        usort($words, fn($a, $b) => (strlen($a) - strlen($b)));
    }
    unset($words);

    // Sort for the vowel counts desc
    $counts = array_keys($vowelTotals);
    sort($counts);
?>