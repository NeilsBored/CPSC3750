 /*
  File: GroupAudio.js
  Author: Shane John
  Date: 2025-07-06
  Course: CPSC 3750 – Web Application Development
  Purpose: Supports the main AudioDemo application by providing audio playback controls, volume management, and time tracking capabilities.
  Notes: Orginally featured in GroupAudio Assignment, but used here to save time on the non-required features of the page.
*/

 $(document).ready(function()
      {
        // Element Variables
        var $audio = $('#theAudio'),
            audio = $audio[0],
            $volumeRange = $('#volumeRange'),
            $volume = $('#volumeValue'),
            $timeRange = $('#timeRange'),
            $currentTime = $('#currentTime'),
            $duration = $('#duration');
   
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
    
    
 
