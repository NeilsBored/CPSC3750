 $(document).ready(function()
      {
        // Element Variables
        var $audio = $('#myAudio'),
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
      
        // Progress Bar Animation
  $("#progressbar").progressbar({ value: 0 });
  let val = 0;
  const timer = setInterval(function()
  {
    // 5% per second (20 seconds total)
      val += 5; 
      if (val >= 100) 
      {
        clearInterval(timer);
        var widget = $("#progressbar").progressbar("widget");
        widget.find(".ui-progressbar-value").css("background-color", "red");
      }
      $("#progressbar").progressbar("value", val);

  }, 1000);
});
    
    
 
