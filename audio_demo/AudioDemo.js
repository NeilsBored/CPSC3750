/*
  File: AudioDemo.js
  Author: Shane John
  Date: 2025-07-06
  Course: CPSC 3750 – Web Application Development
  Purpose: Implements AudioDemo application features established in the requirements of the Project Instructions 
  Notes: I wasn't 100% sure if I should used jQuery or not, so I opted for a little more practice with plain ol' JavaScript.
*/

// AudioDemo Element Variables
var fileName = document.getElementById('fileName'),
      audio = document.getElementById('theAudio'),
      currentTime = document.getElementById('currentTime'),
      playPauseButton = document.getElementById('playPauseButton'),
      rewindButton = document.getElementById('rewindButton'),
      forwardButton = document.getElementById('fastForwardButton'),
      playlist = document.getElementById('playlist'),
      addTitleButton = document.getElementById('addTitle'),
      removeTitleButton = document.getElementById('removeTitle');

// Interval timer for updating playback position
let timer = null;
function updateTime()
{
    // Get current playback time
    var t = audio.currentTime;
     // Check if current segment has ended
    if (currentSegment && t >= currentSegment.end) 
    {
        audio.pause();
        playPauseButton.textContent = 'Play';
        // Clear the update timer
        clearInterval(timer);
    }
}

// Toggle for play/pause 
playPauseButton.onclick = () => 
{
    if (audio.paused) 
    {
        audio.play();
        playPauseButton.textContent = 'Pause';
            // Dynamic Color Change
            playPauseButton.style.backgroundColor = 'white';
            playPauseButton.style.color = 'black';
            playPauseButton.style.border = 'solid black';
        // Start update timer
        timer = timer || setInterval(updateTime, 250);
    }
    // Pause playback
    else
    {
        audio.pause();
        playPauseButton.textContent = 'Play';
            // Dynamic Color Change
            playPauseButton.style.backgroundColor = 'cornflowerblue';
            playPauseButton.style.color = 'white';
            playPauseButton.style.border = 'none';
        // Stop update timer
        clearInterval(timer);
    }
}; 
// Rewind and Forward Buttons
rewindButton.onclick = ()  => { audio.currentTime = Math.max(0, audio.currentTime - 10); };
forwardButton.onclick = () => { audio.currentTime = Math.min(audio.duration, audio.currentTime + 10); };

// Playlist Segments
// I tried to make genuine titles that fit the theme, but admittedly, this is not my strong suit.
let segments =
[
    {title: 'First Light Over Venus', start: 0, end: 45},
    {title: 'Floating in Stillness', start: 45, end: 90},
    {title: 'Celestial Breath', start: 90, end: 135},
    {title: 'Orbits in Harmony', start: 135, end: 180},
    {title: 'The Heartbeat of Peace', start: 180, end: 225},
    {title: 'The Air Turns Blue', start: 225, end: 270},
    {title: 'Divine Reflection', start: 270, end: 315},
    {title: 'Crater Shadows and Cloudlight', start: 315, end: 360},
    {title: 'Final Ascent', start: 360, end: 405},
    {title: 'Departure into Silence', start: 405, end: 480}
];

// Currently active segment (used elsewhere)
let currentSegment = null;
// Plays that active segment
function playSegment(i)
{
    // Select segment to play
    currentSegment = segments[i];
    audio.currentTime = currentSegment.start;
        audio.play()
        playPauseButton.textContent = 'Play';
    // Reset update timer
    clearInterval(timer);
    timer = setInterval (updateTime, 250);
}

// Load the playlist into the page
function loadPlaylist() 
{
    // Clear the playlist
    playlist.innerHTML = '';
    // Populate playlist with segment buttons
    segments.forEach((s,i) =>
    {
        // Create playlist entry elements
        const li = document.createElement('Li'),
              button = document.createElement('button');
        button.textContent = `${s.start} - ${s.title}`;
        // Attach playback handler to button
        button.onclick = () => playSegment(i);
        li.appendChild(button);
        playlist.appendChild(li);
    });
}
// Adds a new segment and title
addTitleButton.onclick = () =>
{   
    // Prompt user for segment title
    let newTitle = prompt('Enter A Title For Your Segment:')
        if(!newTitle) return;
    // Capture segment start time
    let t = Number(audio.currentTime.toFixed(0));
    let duration = parseFloat(prompt('How long in seconds is your segment?'));
        if (!duration) return;
    // Cut segment end to audio duration
    duration = Math.min(t + duration, audio.duration);
    // Add new segment to the list and sort
    segments.push({ title: newTitle, start: t, end: duration });
        segments.sort((a,b) => a.start-b.start);
        loadPlaylist();
};
// Removes the current segment
removeTitleButton.onclick = () =>
{
    if(!currentSegment) return alert('Please Select A Segment To Remove')
    // Update segments by filtering out the current segment
    segments = segments.filter(s => s !== currentSegment)
        currentSegment = null;
        loadPlaylist();
    audio.pause();
    playPauseButton.textContent = 'Play'
    // Clear update timer
    clearInterval(timer);
};

// Load the audio file and set the file name
window.onload = () => 
{   
    // Setup for the audio source title
    let nameEdit = audio.src.split('/').pop();
        nameEdit = nameEdit.replace(/\.mp3/i, '');
    fileName.textContent = nameEdit;
    loadPlaylist();
    audio.onloadedmetadata = () => 
    {   
        // Set the duration of the last segment to the audio duration
        segments[segments.length-1].end = audio.duration;
    };
};






