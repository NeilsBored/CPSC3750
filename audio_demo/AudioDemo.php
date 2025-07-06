<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project 1: Audio Demo</title>
    <link rel="stylesheet" href="../main_style.css">
    <link rel="stylesheet" href="AudioDemo.css">
</head>
<body>

     <div class="wrapper" style="border-radius: 20px;">
        <?php include '../navbar.php'; ?>
    </div>

    <header>
        <h2>Project 1: Audio Changer</h2>
        <h3 id="fileName">audio_name.mp3</h3>
    </header>
    <main style="background-color: black;">
    <div class="hero-section" style="border-radius: 50px; height: 600px;">
        <img src="venus-mariner.jpg" style=" background-color:black; height: 80%; object-fit: contain;">
       
        <div class="content" style="margin-top: 6%;">
            <div style="padding: 20px;margin-left:-30px;">
                <audio id="theAudio" preload="metadata" src="Venus_theBringerOfPeace.mp3" type="audio/mpeg"></audio>
                
                

                <!-- Volume -->
                <div class="control" style="display: flex; gap: 25px;">
                    <button id="playPauseButton">Play</button>
                    <div style="display:block">
                        <label>Volume Control</label>
                        <input id="volumeRange" type="range" min="0" max="1" step="0.05" value="1">
                        <span id="volumeValue">100%</span>  
                    </div>
                  
                </div>
                <!-- Time Changer-->
                <div class="control" >
                    <label>Playback Slider</label>
                    <input type="range" id="timeRange" min="0" max="0" step="0.01" value="0">
                </div>
                    <div style="display: flex;">
                        <button id="rewindButton">Back 10 Seconds</button>

                        <button id="fastForwardButton">Forward 10 Seconds</button>
                    </div>
                    
                    
                
            </div>

           <div id="controls" style="margin-left: -90px; padding: 20px;">               
                    <!-- Audio Info Display -->
                    <div>
                    <div class="playback">
                        <label>Current Time</label>
                        <span id="currentTime">–</span> seconds 
                    </div>
                    <div class="playback">
                        <label>Full Track Length</label>
                        <span id="duration">–</span> seconds
                    </div> 
                    </div>
                <div id="title-controls" style="display: flex;">
                    <button id="addTitle">Add Title</button>
                    <button id="removeTitle">Remove Title</button>
                </div>
            </div>
            
        </div>
        </div>
        <div class="chevron"><span class="chevron-line"></span></div>

        <h4> Gustav Holst's The Planets, Op. 32 -  II. Venus: The Bringer of Peace</h4>
        <ul id="playlist"></ul>
 
    </main>

    <script src="../assignments/week7/jquery-3.7.1.min.js"></script>  
    <script src="AudioDemo.js"></script>
    <script src="GroupAudio.js"></script>
</body>





</html>