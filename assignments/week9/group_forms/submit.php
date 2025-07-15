<?php
/*
  File: submit.php
  Author: Shane John
  Date: 2025-07-14
  Course: CPSC 3750 – Web Application Development
  Purpose: Grabs and displays form vaules from elements in forms.php 
  Notes: A whole lotta echoes + some blank checking
*/
    echo "<h1>Verify User Form Submission</h1>";
    // Text
    echo "<strong>Name:</strong> " . htmlspecialchars($_POST['userName']) . "<br>";
    // Textarea
    echo "<strong>Personal Bio:</strong> " . nl2br(htmlspecialchars($_POST['userBio'])) . "<br>";
    // Hidden Data
    echo "<strong>Session ID:</strong> " . htmlspecialchars($_POST['sessionID']) . "<br>";
    // Password
    echo "<strong>Password:</strong> " . htmlspecialchars($_POST['userPwd']) . "<br>";
    // Array of Checkboxes
    echo "<strong>Major(s):</strong> ";
        if (!empty($_POST['userMajor'])) 
        {
            echo implode(", ", array_map('htmlspecialchars', $_POST['userMajor']));
        } 
        else 
        {
            echo "N/A";
        }
        echo "<br>";
    // Radio Buttons
    echo "<strong>Gender:</strong> " . (isset($_POST['userGender']) ? htmlspecialchars($_POST['userGender']) : "N/A") . "<br>";
    // Selection List
    echo "<strong>Country:</strong> " . htmlspecialchars($_POST['userOrigin']) . "<br>";
    // URL 
    echo "<strong>Website:</strong> ";
        if (!empty($_POST['userWebsite'])) 
        {
            $url = htmlspecialchars($_POST['userWebsite']);
            echo "<a href=\"$url\">$url</a>";
        }  
        else 
        {
            echo "N/A";
        }
        echo "<br>";
    // File
    echo "<strong>Uploaded Profile Picture:</strong> ";
        if (isset($_FILES['userImg']) && $_FILES['userImg']['error'] === UPLOAD_ERR_OK) 
        {
            $orignal = basename($_FILES['userImg']['name']);
            $safe = time() . "_" . preg_replace('/[^A-Za-z0-9._-]/', '_', $orignal);
                move_uploaded_file($_FILES['userImg']['tmp_name'], "uploads/$safe");
            echo "<a href=\"uploads/$safe\">$orignal</a>";
        } 
        else 
        {
            echo "N/A";
        }
        echo "<br>";
    // Link back to new form
    echo "<p><a href=\"forms.php\">Return to New Form Page</a></p>";
?>