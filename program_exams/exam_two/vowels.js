/*
  File: vowels.js
  Author: Shane John
  Date: 2025-05-19
  Course: CPSC 3750 – Web Application Development
  Purpose: Client side functions for Programming Exam 2
  Notes: Loosely adapted from codepen's JS version
*/

// Needed variables
var wordList = document.getElementById('word-list'),
    dropArea = document.getElementById('drop-area'),
    dropCounter = document.getElementById('drop-count');
let dropCount = 0;

// Show words based on selected vowel count
function showList(n)
{
    // Clear existing list
    wordList.innerHTML = '';
    // Cycle column to refill
    vowelTotals[n].forEach(word => 
    {
        const divElement = document.createElement('div');
            // features set for each element to hold similar characticistics as the Codepen verison
            divElement.textContent = word;
            divElement.className = word;
            divElement.draggable = true;
            divElement.addEventListener('dragstart', element => 
            {
                element.dataTransfer.setData('text/plain', word);
            });

            wordList.appendChild(divElement);
    });
}

// Listener event for vowel count buttons click
document.getElementById('buttons').addEventListener('click', element => 
{
    showList(element.target.dataset.count);
});
// Listener event for dragover dropArea from codepen
dropArea.addEventListener('dragover', element => element.preventDefault());
// Listener event for drop in dropArea mostly from codepen
dropArea.addEventListener('drop', element =>
{
    // Allows drop behavior
    element.preventDefault();
    // Creates new div from dropped word
    const word = element.dataTransfer.getData('text/plain');
    const divElement = document.createElement('div');
    divElement.textContent = word;
    divElement.classList = word;
    // Remove start message
    if (dropArea.textContent === "(Drop Words here)") dropArea.innerHTML = '';
    // Add new div to dropArea
    dropArea.appendChild(divElement);
    // Update drop count
    dropCounter.textContent = 'Dropped: ' + (++dropCount);
});