<?php
/*
  File: carSelection.php
  Author: Shane John
  Date: 2025-07-14
  Course: CPSC 3750 – Web Application Development
  Purpose: 
  Notes: 
*/

session_start();

// 1. On first run, create the four data files and set a cookie
if (!isset($_COOKIE['initialized'])) {
    file_put_contents(__DIR__ . '/data/prime.txt', '');
    file_put_contents(__DIR__ . '/data/armstrong.txt', '');
    file_put_contents(__DIR__ . '/data/fibonacci.txt', '');
    file_put_contents(__DIR__ . '/data/none.txt', '');
    setcookie('initialized', '1', time() + 365*24*3600, '/');
}

// 2. Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nums = array_filter(array_map('trim', explode(',', $_POST['numbers'] ?? '')));
    switch ($_POST['action'] ?? '') {
        case 'check':
            foreach ($nums as $n) {
                if (is_prime($n)) {
                    file_append(__DIR__ . '/data/prime.txt', $n);
                } elseif (is_armstrong($n)) {
                    file_append(__DIR__ . '/data/armstrong.txt', $n);
                } elseif (is_fibonacci($n)) {
                    file_append(__DIR__ . '/data/fibonacci.txt', $n);
                } else {
                    file_append(__DIR__ . '/data/none.txt', $n);
                }
            }
            break;
        case 'armstrong':
        case 'fibonacci':
        case 'prime':
        case 'none':
            $content = file_get_contents(__DIR__ . "/data/{$_POST['action']}.txt");
            $GLOBALS['display'] = $content === '' ? [] : explode(',', rtrim($content, ','));
            break;
        case 'reset':
            foreach (['prime','armstrong','fibonacci','none'] as $f) {
                @unlink(__DIR__ . "/data/{$f}.txt");
            }
            setcookie('initialized', '', time() - 3600);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
    }
}

// 3. Utility functions

function file_append(string $file, $n): void {
    file_put_contents($file, $n . ',', FILE_APPEND);
}

function is_prime($n): bool {
    if (!ctype_digit(strval($n)) || $n < 2) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i === 0) return false;
    }
    return true;
}

function is_armstrong($n): bool {
    $digits = str_split($n);
    $power = count($digits);
    return array_sum(array_map(fn($d) => $d**$power, $digits)) == $n;
}

function is_fibonacci($n): bool {
    // A number is Fibonacci if one of 5*n^2+4 or 5*n^2-4 is a perfect square
    $check = fn($x) => (int)sqrt($x) ** 2 === $x;
    return $check(5*$n*$n + 4) || $check(5*$n*$n - 4);
}
