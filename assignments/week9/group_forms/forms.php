<!--
    File: forms.php
    Author: Shane John
    Date: 2025-07-14
    Course: CPSC 3750 – Web Application Development
    Purpose: Implements an example of a typical user data entry form, along with a test of the post function
    Notes: I really enjoy the ability to just set an action and method with forms.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Group: Forms</title>
    <link rel="stylesheet" href="forms.css">
    <link rel="stylesheet" href="../../../main_style.css">
</head>
<body>
    <div class="wrapper">
        <?php include '../../../navbar.php'; ?>
    </div >

    <h1>User Form Demo</h1>
    <form class="userForm" action="submit.php" method="post" enctype="multipart/form-data">
    <!-- Hidden Data -->
    <input type="hidden" name="sessionID" id="sessionID" value="JS/07M378">
    <!-- Text -->
    <label for="userName">[Text] Name:</label>
        <input type="text" name="userName" id="userName"><br>
    <!-- Password -->
    <label for="userPwd">[Password] Password:</label>
        <input type="password" name="userPwd" id="userPwd"><br>
    <!-- Radio Buttons -->
    <label>[Radio] Gender:</label>
        <input type="radio" name="userGender" id="genderMale" value="M">
            <label for="genderMale">Male</label>
        <input type="radio" name="userGender" id="genderFemale" value="F">
            <label for="genderFemale">Female</label><br>
    <!-- Selection List -->
    <label for="userOrigin">[Select] Country:</label>
        <select name="userOrigin" id="userOrigin">
            <option value="">--Select--</option>
            <option value="USA">United States</option>
            <option value="CAN">Canada</option>
            <option value="MEX">Mexico</option>
            <option value="PER">Peru</option>
            <option value="JAP">Japan</option>
        </select><br>
    <!-- Textarea -->
    <label for="userBio">[TextArea] Personal Bio:</label><br>
        <textarea name="userBio" id="userBio"></textarea><br>
    <!-- Array of Checkboxes -->
    <label>[Checkboxes] Major(s):</label><br>
        <input type="checkbox" name="userMajor[]" id="majorCS" value="CS">
            <label for="majorCS">Computer Science</label>
        <input type="checkbox" name="userMajor[]" id="majorENG" value="ENG">
            <label for="majorENG">Engineering</label><br>
        <input type="checkbox" name="userMajor[]" id="majorBIO" value="BIO">
            <label for="majorBIO">Biology</label>
        <input type="checkbox" name="userMajor[]" id="majorCHEM" value="CHEM">
            <label for="majorCHEM">Chemistry</label>
        <input type="checkbox" name="userMajor[]" id="majorMAT" value="MAT">
            <label for="majorMAT">Mathematics</label><br>
    <!-- File -->
    <label for="userImg">[File] Upload Profile Picture:</label>
        <input type="file" name="userImg" id="userImg"><br>
    <!-- URL -->
    <label for="userWebsite">[URL] Personal Website:</label>
        <input type="url" name="userWebsite" id="userWebsite" placeholder="https://yourPortfolio.com"><br>
        
    <!-- Submit Button -->
        <input type="submit" value="SUBMIT FORM">
    </form>
</body>
</html>