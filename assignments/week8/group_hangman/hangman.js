/*
  File: hangman.js
  Author: Shane John
  Date: 2025-07-10
  Course: CPSC 3750 – Web Application Development
  Purpose: Implements the generation of the letter buttons and their extended activites, as well as calling getWord.php and my first attempt at cookies
  Notes: I made it so cheat mode only happens after refresh, due to this line in the rubric, "alert box when the game starts".
         I gave the user an alert to refresh, just in case.
*/

// Almost direct copy from HangmanV2 - added class name for css
function generateLetterButtons() {
    const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const lettersDiv = document.getElementById('letters');
    letters.split('').forEach(letter => {
        const button = document.createElement('button');
        button.textContent = letter;
        button.className = 'letter-btn';
        button.onclick = () => guessLetter(letter);
        lettersDiv.appendChild(button);
    });
}

// Global Calls and mode verifcation
let listWord,
    guessedLetters = new Set(),
    attemptsTotal = 12,
    attemptsRemaining = attemptsTotal;
var cheatCheck = document.getElementById('cheatMode');
    
// Logic for the game's word display
function updateWordDisplay()
{
    let display = '';
    // Letter by letter 
    for (const letter of listWord)
    {   
        // Blank between words (I know hangman is usally one word, but it was easier to make the list of clemson stuff)
        if(letter === ' ')
        {
            display += '  ';
        }
        // hey got one!
        else if (guessedLetters.has(letter))
        {
            display += letter.toUpperCase() + ' ';
        }
        // Will Mr.Stick Figure live?...Stay tuned.
        else 
        {
            display += '_ '
        }
    }
    // Update page display
    document.getElementById('wordToGuess').textContent = display.trim();
}

// Update for Attempt elements
function updateAttempts() 
{
  document.getElementById('attemptsLeft').textContent = `Remaining Attempts: ${attemptsRemaining}`;
  document.getElementById('gallowsImg').src = `images/gallows${attemptsTotal - attemptsRemaining}.jpeg`;
}

// Letter Sorting
function guessLetter(letter)
{
    // Is the letter been found already or is the game over?
    if (guessedLetters.has(letter.toLowerCase()) || attemptsRemaining === 0)
    {
        return;
    }
    // ..Then add it.
    guessedLetters.add(letter.toLowerCase());

    // Update the button to disabled and change visually
    document.querySelectorAll('.letter-btn').forEach(btn => 
    {
        if (btn.textContent.toLowerCase() === letter.toLowerCase())
        {
            btn.disabled = true;
            btn.style.backgroundColor = 'white';
            btn.style.color = '#f28f44c9';
        }
    });

    // Current State Check
    let status = document.getElementById('status')
    // Was the letter added?
    if (listWord.includes(letter.toLowerCase()))
    {
        updateWordDisplay();
        // Check for a win
        if ([...listWord].every(l => l === ' ' || guessedLetters.has(l)))
        {
            // Special Message for Cheaters
            if (getCookie('cheatMode') === 'true')
            {
                status.textContent = 'Congrats! You Cheated The Hangman!' 
            }
            else
            {
                status.textContent = 'Congrats! You Won!'  
            }  
            // Lock down remaining buttons
            document.querySelectorAll('.letter-btn').forEach(btn => 
            {   
                btn.disabled = true;
                btn.style.backgroundColor = '#f28f44c9'; 
                btn.style.color = '#f28f44c9'; 
            }); 
        }
    }
    else
    {
        // WRONG - lose one attempt
        attemptsRemaining--;
        updateAttempts();
        // How many left?
        if (attemptsRemaining === 0) 
        {
            status.textContent = `Game Over! The Word Was: ${listWord.toUpperCase()}`;
            // Lock down remaining buttons
            document.querySelectorAll('.letter-btn').forEach(btn => 
            {
                btn.disabled = true;
                btn.style.backgroundColor = '#f28f44c9'; 
                btn.style.color = '#f28f44c9'; 
            });
        }
    }
    
}

// getWord setup
fetch('getWord.php')
        .then(res => res.text())
        .then(word =>
        {
            listWord = word.trim();
            updateWordDisplay();
            updateAttempts();
            // Inital check for cookie status
            if (getCookie('cheatMode') === 'true')
            {
                cheatCheck.checked = true;
                alert(`Cheat Mode Engaged! The Word Is: ${listWord.toUpperCase()}`);
            }
        });

// Cookies get and set
function setCookie(name, mode, days)
{
    const expiration = new Date(Date.now() + (days * 864e5)).toUTCString();
    document.cookie = name + '=' + encodeURIComponent(mode) + '; expires=' + expiration + '; path=/';
}
function getCookie(name)
{
    return document.cookie.split('; ').reduce((r, v) => 
    {
        const crumbs = v.split('=');
        return crumbs[0] === name ? decodeURIComponent(crumbs[1]) : r;
    }, '');
}

// Sync cheat-mode to cookie status
document.addEventListener('DOMContentLoaded', () => 
{
    // Restore check from cookie
    if (getCookie('cheatMode') === 'true') 
    {
        cheatCheck.checked = true;
    }
    cheatCheck.addEventListener('change', () => 
    {
        //Cookie should go stale after one day
        setCookie('cheatMode', cheatCheck.checked, 1);
            if (getCookie('cheatMode') === 'true') 
            {
                alert(`Refresh Game To Start In Cheat Mode!`);
            }
    });
}); 

//Create buttons
generateLetterButtons();