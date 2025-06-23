// loops.js -- Not used and only minor changes 

  var nextName;
  do {
    nextName = prompt("Enter Name for next card (leave blank to cancel):", "");
    if (nextName) {
      var nextEmail = prompt("Enter Email:", "");
      var nextAddress = prompt("Enter Address:", "");
      var nextPhone = prompt("Enter Phone:", "");
      var nextBirthdate = prompt("Enter Birthdate (MM/DD/YYYY):", "");
      cards.push(new Card(
        nextName,
        nextEmail,
        nextAddress,
        nextPhone,
        nextBirthdate
      ));
    }
  } while (nextName);
