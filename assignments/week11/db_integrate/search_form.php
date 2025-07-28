<!--
  File: list.php
  Author: Shane John
  Date: 2025-07-27
  Course: CPSC 3750 – Web Application Development
  Purpose: Allows user to search by last name
  Notes: Just one more form.
-->

 <!-- Search Frontend Form -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search by Last Name</title>
</head>
<body>
  <nav><a href="insert_form.php">Back to Add</a></nav>
  <h1>Find Persons by Last Name</h1>
  <form action="search.php" method="get">
    <p>
      <label>Last Name:<br>
      <input type="text" name="last_name" required></label>
    </p>
    <button type="submit">Search</button>
  </form>
</body>
</html>