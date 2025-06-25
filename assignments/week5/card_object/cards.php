<!--
  File: cards.html
  Author: Shane John
  Date: 2025-06-19
  Course: CPSC 3750 – Web Application Development
  Purpose: Canibalized Version of cards.html, main HTML file for Card Objects Assignment
  Notes: Provides options to view new cards or display all cards.
-->

<!DOCTYPE html> 
<html lang="en">
<head>
  <title>Card Objects</title>
  <link rel="stylesheet" href="cards.css">
  <link rel="stylesheet" href="../../../main_style.css">
</head>
<body>
  <div class="wrapper">
    <?php include '../../../navbar.php'; ?>
  </div >

  <div style="margin: 20px;">
  <h1>JavaScript Business Cards</h1>
  <p>
    <button id="Add">Add New Card</button>
    <button id="Display">Display All Cards</button>
  </p>
  
  <!-- Form View -->
  <form id="cardForm" class="hidden">
    <fieldset>
      <legend><h4>Information Entry Form</h4></legend>
      <p>
        <label>Name:</label><br>
        <input type="text" id="name" required>
      </p>
      <p>
        <label>Email:</label><br>
        <input type="email" id="email" required>
      </p>
      <p>
        <label>Address:</label><br>
        <input type="text" id="address" required>
      </p>
      <p>
        <label>Phone:</label><br>
        <input type="tel" id="phone" required>
      </p>
      <p>
        <label>Birthdate:</label><br>
        <input type="date" id="birthdate" required>
      </p>
      <p><button type="button" id="cardSave">Save Card</button></p>
    </fieldset>
  </form>

  <!-- Table View-->
  <div id="tableContainer" class="hidden">
    <h3>Cards List</h3>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Address</th>
          <th>Phone</th>
          <th>Birthdate</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <!-- Rows get added. I promise -->
      </tbody>
    </table>
  </div>

  <!-- Script Files -->
  <script src="cards.js"></script>
  <script src="newLoops.js"></script>
  <script>
    cardApp();
  </script>
  </div>
</body>
</html>