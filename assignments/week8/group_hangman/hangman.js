// Helper to set a cookie
function setCookie(name, value, days) {
  const expires = new Date(Date.now() + days * 864e5).toUTCString();
  document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + expires + '; path=/';
}

// Helper to get a cookie value
function getCookie(name) {
  return document.cookie.split('; ').reduce((r, v) => {
    const parts = v.split('=');
    return parts[0] === name ? decodeURIComponent(parts[1]) : r;
  }, '');
}

let selectedWord;
let guessedLetters = new Set();
let attemptsLeft = 6;

function updateWordDisplay() {
  const wordDisplay = document.getElementById('wordToGuess');
  let display = '';
  for (const letter of selectedWord) {
    if (letter === ' ') {
      
      display += '  ';
    } else if (guessedLetters.has(letter)) {
      display += letter.toUpperCase() + ' ';
    } else {
      display += '_ ';
    }
  }
  wordDisplay.textContent = display.trim();
}

function updateAttempts() {
  document.getElementById('attemptsLeft').textContent = `Attempts left: ${attemptsLeft}`;
  document.getElementById('gallowsImg').src = `images/gallows${6 - attemptsLeft}.jpeg`;
}

function guessLetter(letter) {
  if (guessedLetters.has(letter) || attemptsLeft === 0) {
    return;
  }
  guessedLetters.add(letter);
  document.querySelectorAll('.letter-btn').forEach(btn => {
    if (btn.textContent.toLowerCase() === letter) {
      btn.disabled = true;
    }
  });

  if (selectedWord.includes(letter)) {
    updateWordDisplay();
    if ([...selectedWord].every(l => guessedLetters.has(l))) {
      document.getElementById('status').textContent = 'You won!';
    }
  } else {
    attemptsLeft--;
    updateAttempts();
    if (attemptsLeft === 0) {
      document.getElementById('status').textContent = `Game over! The word was: ${selectedWord.toUpperCase()}`;
      document.querySelectorAll('.letter-btn').forEach(btn => btn.disabled = true);
    }
  }
}

fetch('getWord.php')
  .then(res => res.text())
  .then(word => {
    selectedWord = word.trim().toLowerCase();
    updateWordDisplay();
    updateAttempts();
    // After initializing the display, respect stored cheat-mode cookie
    if (getCookie('cheatMode') === 'true') {
      document.getElementById('cheatMode').checked = true;
      alert(`Cheat mode enabled! The word is: ${selectedWord}`);
    }
  });

// Sync cheat-mode checkbox to cookie
document.addEventListener('DOMContentLoaded', () => {
  const cheatCheckbox = document.getElementById('cheatMode');
  // Restore from cookie
  if (getCookie('cheatMode') === 'true') {
    cheatCheckbox.checked = true;
  }
  cheatCheckbox.addEventListener('change', () => {
    setCookie('cheatMode', cheatCheckbox.checked, 7);
  });
});