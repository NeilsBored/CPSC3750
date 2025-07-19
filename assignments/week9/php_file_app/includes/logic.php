<?php
/*
  File: logic.php
  Author: Shane John
  Date: 2025-07-17
  Course: CPSC 3750 – Web Application Development
  Purpose: Not so simple Backend for sorting input numbers and storing them into the correct files
  Notes: Handles everything from classification checks, file interactions, cookies management,
         and feedback messaging.
*/

// Outside path to stored data files
$dataDir = __DIR__ . '/data';
// Location map for number files
$files =
[
    'prime' => "$dataDir/prime.txt",
    'armstrong' => "$dataDir/armstrong.txt",
    'fibonacci' => "$dataDir/fibonacci.txt",
    'none' => "$dataDir/none.txt",
];

// first-visit cookies setup
$cookieName = 'user';
$consent = $_COOKIE['cookie_consent'] ?? null;
$hasConsent = ($consent === 'yes');

// if cookies accepted, create empty files and set the vistor cookie
if ($hasConsent) 
{
    foreach ($files as $path) 
    {
        if (!file_exists($path)) 
        {
            file_put_contents($path, '');  // initialize empty file
        }
    }
    setcookie($cookieName, 'yes', time() + 86400, '/');
}

//Sorting Functions

//Prime Numbers
function isPrime(int $n): bool 
{
    // n=1
    if ($n < 2) return false;
    // n=2
    if ($n === 2) return true; 
        // n is divisible by 2
        if ($n % 2 === 0) return false;
    // Initalize final check at prime factor limit
    $max = (int) sqrt($n);
    // Loop (3-->[(n)^(1/2)]), increments at add-2 rate to catch remaining odd numbers
    for ($i = 3; $i <= $max; $i += 2) 
    {
        if ($n % $i === 0) return false;
    }
    // Most likely a prime number then
    return true;
}

//Armstrong Numbers
function isArmstrong(int $n): bool 
{
    // Split number by its digits
    $digits = str_split((string)$n);
    // Get power to raise to
    $power = count($digits);
    // Armstrong rule check
    $sum = array_sum(array_map(fn($d) => pow((int)$d, $power), $digits));
    return ($sum === $n);
}

// Square test - Fibonacci Helper
function isPerfectSquare(int $n): bool 
{
    $x = (int)$n;
    if ($x < 0) return false;
    // Number root
    $sqr = (int) floor(sqrt($x));
    return (($sqr * $sqr) === $x);
}
// Fibonacci Main
function isFibonacci(int $n): bool 
{
    $test1 = (5 * ($n ^ 2)) + 4;
    $test2 = (5 * ($n ^ 2)) - 4;
    return (isPerfectSquare($test1) || isPerfectSquare($test2));
}

// Control Functions

//Get for number type file
function readNumbers(string $path): array 
{
    if (!file_exists($path)) 
    {
        file_put_contents($path, '');
        return [];
    }
    return file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
}

// Add to number type file
function saveNumber(string $path, int $n): void 
{
    file_put_contents($path, "$n\n", FILE_APPEND);
}

// Main form controls - I wanted to try putting all the buttons in a form...I regret it.
$action = $_POST['action'] ?? '';
$messages = [];
$outputNumbers = [];
// Cookie Check
if (!$hasConsent) 
{
    $messages[] = 'Buttons Disabled: Cookies Have Not Been Accepted';
}

// Check Button
if ($action === 'CHECK') 
{
    // Setup input
    $input  = $_POST['numbers'] ?? '';
    $numbers = preg_split('/\D+/', $input, -1, PREG_SPLIT_NO_EMPTY);
    // Setup existing number check
    $existing    = [];
    foreach ($files as $type => $path) 
    {
        $existing[$type] = readNumbers($path);
    }
    // Sorting boxes
    $categorized = ['prime'=>[], 'armstrong'=>[], 'fibonacci'=>[], 'none'=>[]];
    $duplicates = ['prime'=>[], 'armstrong'=>[], 'fibonacci'=>[], 'none'=>[]];
    // Sorting Run
    foreach ($numbers as $n) 
    {
        $n = (int)$n;
        // String array of type matches
        $matched = [];
            if (isPrime($n)) $matched[] = 'prime';
            if (isArmstrong($n)) $matched[] = 'armstrong';
            if (isFibonacci($n)) $matched[] = 'fibonacci';
            if (empty($matched)) $matched[] = 'none';
        // Check duplicates and add to matched types
        foreach ($matched as $type) 
        {
            if (!in_array((string)$n, $existing[$type], true)) 
            {
                saveNumber($files[$type], $n);
                $categorized[$type][] = $n;
            } 
            else 
            {
                $duplicates[$type][] = $n;
            }
        }
    }
    // User feedback meessages
    // Sorted Number
    foreach ($categorized as $cat => $arr) 
    {
        if ($arr) 
        {
            $messages[] = ucfirst($cat) . ' Numbers Stored: ' . implode(', ', $arr);
        }
    }
    // Dupliate alerts
    foreach ($duplicates as $cat => $arr) 
    {
        if ($arr) 
        {
            $messages[] = ucfirst($cat) . ' Duplicates Skipped: ' . implode(', ', $arr);
        }
    }
} 
// Display selected number type list
elseif (in_array(strtolower($action), ['prime','armstrong','fibonacci','none'], true)) 
{
    $key = strtolower($action);
    $outputNumbers = readNumbers($files[$key]);

} 
// Clear Files and Cookies...BURN IT ALL.ERASE!
elseif ($action === 'RESET') 
{
    foreach ($files as $f) 
    {
        if (file_exists($f)) unlink($f);
    }
    setcookie($cookieName, '', time() - 3600, '/');
    $messages[] = 'All Data Reset! Reload to recreate number files.';
}
