/*
  File: newLoops.js
  Author: Shane John
  Date: 2025-06-19
  Course: CPSC 3750 – Web Application Development
  Purpose: Updated Loops.js for Card Object Assignment
  Notes: The orignal loops.js to still prompt for entry, I made a second doc for cards.html
*/

// Show/Hide Toggles
function show(el) { el.classList.remove('hidden'); }
function hide(el) { el.classList.add('hidden'); }

// Event Listeners
function cardApp(options) {
  options = options || {};
  const addButton = document.getElementById('Add');
  const displayButton = document.getElementById('Display');
  const form = document.getElementById('cardForm');
  const saveButton = document.getElementById('cardSave');
  const tableDiv = document.getElementById('tableContainer');
  const tableBody = document.getElementById('tableBody');

  const doAdd = function() {
    hide(tableDiv);
    show(form);
  };

    addButton.addEventListener('click', doAdd);

    displayButton.addEventListener('click', function() {
      hide(form);
      tableSetup(cards, tableBody);
      show(tableDiv);
    });

    saveButton.addEventListener('click', function() {
      const newCard = new Card(
        document.getElementById('name').value,
        document.getElementById('email').value,
        document.getElementById('address').value,
        document.getElementById('phone').value,
        document.getElementById('birthdate').value
      );
      cards.push(newCard);
      form.reset();
      hide(form);
    });

  // Pre-load for Provided Example Data
  hide(form);
  tableSetup(cards, tableBody);
  show(tableDiv);
}