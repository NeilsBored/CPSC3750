<!--
  File: AudioDemo.php
  Author: Shane John
  Date: 2025-07-06
  Course: CPSC 3750 – Web Application Development
  Purpose: Application Driver for AudioDemo, features loaded audio title, playback and playlist title control, and the 
  Notes: There "may"...Okay, there totally is random stylings in a few places. Sorry, If I had more time I promise they wouldn't be there.
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Project 1: Audio Demo</title>
    <link rel="stylesheet" href="../main_style.css">
    <link rel="stylesheet" href="AudioDemo.css">
</head>
<body>
    <!-- Common NavBar -->
    <div class="wrapper">
        <?php include '../navbar.php'; ?>
    </div>
    
    <nav class="user-test">
     <a href="Shane John - User_test_notes_raw.pdf">Test Notes(Raw)</a>
     <a href="Shane John - User_test_notes_typed.pdf">Test Notes(Typed)</a>
     <a href="Shane John - before.png">Before Changes</a>
    </nav> 

    <header>
        <h2>Project 1: Audio Changer</h2>
        <h3 id="fileName">audio_name.mp3</h3>
    </header>
    <main style="background-color: black;">
        <!-- Hero section from main styles (Background image box) -->
        <div class="hero-section" style="border-radius: 50px; height: 600px;">
            <img src="venus-mariner.jpg" style=" background-color:black; height: 80%; object-fit: contain;">
            <!-- Content from main styles (Container for controls) -->
            <div class="content" style="margin-top: 6%;">
                <!-- Right-Side Controls -->
                <div style="padding: 20px;margin-left:-30px;">
                    <!-- Audio Element-->
                    <audio id="theAudio" preload="metadata" src="Venus_theBringerOfPeace.mp3" type="audio/mpeg"></audio>
                    <!-- Audio Controls -->
                    <div class="control" style="display: flex; gap: 25px;">
                        <!-- Play/Pause -->
                        <button id="playPauseButton">Play</button>
                        <!-- Volume (See GroupAudio Assignment) -->
                        <div style="display:block">
                            <label>Volume Control</label>
                            <input id="volumeRange" type="range" min="0" max="1" step="0.05" value="1">
                            <span id="volumeValue">100%</span>  
                        </div>
                    </div>
                    <!-- Time Changer (See GroupAudio Assignment)-->
                    <div class="control" >
                        <!-- Time Slider (See GroupAudio Assignment) -->
                        <label>Playback Slider</label>
                        <input type="range" id="timeRange" min="0" max="0" step="0.01" value="0">
                    </div>
                    <div style="display: flex;">
                        <!-- Skip Back/Forward Buttons (10 seconds felt right) -->
                        <button id="rewindButton">Back 10 Seconds</button>
                        <button id="fastForwardButton">Forward 10 Seconds</button>
                    </div>
                </div>
                <!-- Left-Side Controls -->
                <div id="controls" style="margin-left: -90px; padding: 20px;">               
                    <!-- Audio Info Display -->
                    <div>
                        <!-- Elasped Track Time (See GroupAudio Assignment) -->
                        <div class="playback">
                            <label>Current Time</label>
                            <span id="currentTime">–</span> seconds 
                        </div>
                        <!-- Total Track Time (See GroupAudio Assignment) -->
                        <div class="playback">
                            <label>Full Track Length</label>
                            <span id="duration">–</span> seconds
                        </div> 
                    </div>
                    <!-- Title Playlist Controls-->
                    <div style="display: flex;">
                        <button id="addSegment">Add Segments</button>
                        <button id="removeSegment">Remove Segments</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Down-Arrow Indicator for Titles Playlist -->
        <div class="chevron"><span class="chevron-line"></span></div>
        <!-- Title Playlist -->
        <div>
            <h4> Gustav Holst's The Planets, Op. 32 -  II. Venus: The Bringer of Peace</h4>
            <ul id="playlist"></ul> 
        </div>
    </main>
    <!-- JavaScript For this Assignment -->
    <script src="AudioDemo.js"></script>
    <!-- Port of GroupAudio jQuery Script -->
    <script src="../assignments/week7/jquery-3.7.1.min.js"></script>  
    <script src="GroupAudio.js"></script>
</body>
</html>