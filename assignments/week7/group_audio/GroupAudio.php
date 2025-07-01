<!--
  File: GroupAudio.html
  Author: Shane John
  Date: 06-30-25
  Course: CPSC 3750 – Web Application Development
  Purpose: A showcase of a simple audio control element, along with individual controls for volume and track time control
  Notes: I had to change the format to PHP to get the common nav to port in correctly, also I am scared of the project version of this assignment :(
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Group: Audio</title>
  <script src="../jquery-3.7.1.min.js"></script>  
   <link rel="stylesheet" href="../../../main_style.css">

   <!-- Internal Styling -->
  <style>
    /* Main div */
    div.music 
    { 
      font-family: sans-serif; 
      padding: 10px; 
      display: flex;
    }
    /* Control Element */
    .control 
    {
      margin-bottom: 20px; 
      margin-left: 30px;
    }
    /* Accented header, paragraph */
    h1.music, p.music 
    { 
      color: rgb(2, 80, 225);
      margin-top: 15px;
      margin-left: 10px;
    }
    /* Element Labels */ 
    label 
    { 
      display: block; 
      font-weight: bold; 
      padding-bottom: 5px;
    }
    /* Time Slider */
    #timeRange 
    {
      width: 250px;
    }
    /* Playback Information */
    .playback
    {
      margin-top: 30px;
      margin-left: 50px;
    }
  </style>

</head>
<body>
  <!--Common NavBar-->
  <div class="wrapper" style="border-radius: 20px;">
    <?php include '../../../navbar.php'; ?>
  </div>
  <!--Cool Page Title-->
  <h1 class="music">HTML DOM Audio Object Sampler</h1>
 
  <div class="music">
    <!-- Audio Element -->
    <div>
      <label>Audio Element</label>
      <p class="music"><i>Spiritual</i> - John Coltrane </p>
      <audio id="myAudio" controls preload="metadata"> 
        <source src="Spiritual.mp3" type="audio/mpeg">
      </audio>
    </div>
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
    <!-- Playback Controls -->
    <div>
      <!-- Play / Pause -->
      <div class="control">
        <label>Play / Pause Control</label>
        <button id="playButton">Play</button>
        <button id="pauseButton">Pause</button>
      </div>
      <!-- Volume -->
      <div class="control">
        <label>Volume Control</label>
        <input id="volumeRange" type="range" min="0" max="1" step="0.05" value="1">
        <span id="volumeValue">100%</span>
      </div>
      <!-- Time Changer-->
      <div class="control">
        <label>Playback Slider</label>
        <input type="range" id="timeRange" min="0" max="0" step="0.01" value="0">
      </div>
  </div>

  <!-- Internal js(with jQuery) -->
  <script>
    $(document).ready(function()
      {
        // Element Variables
        var $audio = $('#myAudio'),
            audio = $audio[0],
            $playButton = $('#playButton'),
            $pauseButton = $('#pauseButton'),
            $volumeRange = $('#volumeRange'),
            $volume = $('#volumeValue'),
            $timeRange = $('#timeRange'),
            $currentTime = $('#currentTime'),
            $duration = $('#duration');
        // Play/Pause Click Event
        $playButton.click(function() {audio.play();});
        $pauseButton.click(function() {audio.pause();});
        // Volume Change Event
        $audio.on('volumechange', function() 
        {
          $volume.text((audio.volume * 100).toFixed(0) + '%');
        });
        $volumeRange.on('input', function() {audio.volume = this.value;});
        // Metadata Grab for Display
        $audio.on('loadedmetadata', function() 
        {
          $duration.text(audio.duration.toFixed(0));
          $timeRange.attr({max: audio.duration, step: 0.01 }).val(0);
        });
        // Playback Time Update
        $audio.on('timeupdate', function() 
        {
          $currentTime.text(audio.currentTime.toFixed(0));
          $timeRange.val(audio.currentTime);
        });
        $timeRange.on('input', function() {audio.currentTime = this.value;});
      });
  </script>
</body>
</html>
