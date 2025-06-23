/*
  File: cards.css
  Author: Shane John
  Date: 2025-06-19
  Course: CPSC 3750 – Web Application Development
  Purpose: Updated cards.js for Card Object Assignment
  Notes: Completed requested changes and added a few of my own.
*/

// Method to print a card to the document (Not Used)
function printCard() {
  document.write(
    "<strong>Name:</strong> " + this.name + "<br>" +
    "<strong>Email:</strong> " + this.email + "<br>" +
    "<strong>Address:</strong> " + this.address + "<br>" +
    "<strong>Phone:</strong> " + this.phone + "<br>" +
    "<strong>Birthdate:</strong> " + this.birthdate + "<hr>"
  );
}
 
// Card constructor
function Card(name, email, address, phone, birthdate) {
  this.name = name;
  this.email = email;
  this.address = address;
  this.phone = phone;
  this.birthdate = birthdate;
  this.printCard = printCard;
}

// Object for Provided Example Data
var cards = [
  new Card(
    "Sue Suthers", 
    "sue@suthers.com",
    "123 Elm Street, Yourtown ST 99999",
    "555-555-9876",
    "1998-04-24"
  ),
  new Card(
    "Fred Fanboy",
    "fred@fanboy.com",
    "233 Oak Lane, Sometown ST 99399",
    "555-555-4444",
    "2001-07-10"
  ),
  new Card(
    "Jimbo Jones",
    "jimbo@jones.com",
    "233 Walnut Circle, Anotherville ST 88999",
    "555-555-1344",
    "2004-11-08"
  )
];

// Table Display
function tableSetup(cards, tableBody) {
  //Reset
  tableBody.innerHTML = '';

//Fill Pre-load Data
cards.forEach
(card => { 
    const row = document.createElement('tr');
    row.innerHTML = 
      `<td>${card.name}</td>
        <td>${card.email}</td>
        <td>${card.address}</td>
        <td>${card.phone}</td>
        <td><input type="date" class="user-birthDate" value="${card.birthdate}"></td>`;
    tableBody.appendChild(row);

    // User B-Day Update Listener
    const dateInput = row.querySelector('.user-birthDate');
      dateInput.addEventListener('change', () => {card.birthdate = dateInput.value;});
  }
);
}