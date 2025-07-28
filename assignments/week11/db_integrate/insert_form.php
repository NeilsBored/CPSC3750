<!--
    File: insert_form.php
    Author: Shane John
    Date: 2025-07-27
    Course: CPSC 3750 – Web Application Development
    Purpose: Main page, focuses on allowing the user to add persons, 
             but includes options for showing the table and last name search
    Notes: I think this allow for infinite entries, but it is kind of hard to fully test.
-->
<! DOCTYPE html>
<html lang="en">
<head>
    <title> DB - Add Person</title>
    <link rel="stylesheet" href="../../../main_style.css">
</head>
<body>
    // Common NavBar
    <div class="wrapper">
      <?php include '../../../navbar.php'; ?>
    </div >
    // basically db_integrate assignment's central command
    <div style="justify-items: center; text-align: center; margin: 10px;">
        <h1>Add a Person</h1>
        <form action="insert.php" method="post" >
            <div>
                <label>First Name:</label><br>
                <input type="text" name="first_name" required>
            </div>
            <div>
                <label>Last Name:</label><br>
                <input type="text" name="last_name" required>
            </div>
            <div>
                <label>Email:</label><br>
                <input type="email" name="email" required>
            </div>
            <button type="submit" style="padding: 5px; margin-top: 10px; margin-bottom: 20px; background-color:Royalblue; color: white;">
                Insert New Person
            </button>
        </form>
        <form action="list.php" method="get" style="padding: 5px; margin: 5px;">
            <button type="submit">Show All Persons</button>
        </form>
        <form action="search_form.php" method="get" style="padding: 5px; margin: 5px;">
            <button type="submit">Search by Last Name</button>
        </form>    
    </div>
</body>
</html>