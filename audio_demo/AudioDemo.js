var fileName = document.getElementById('fileName'),
      audio = document.getElementById('theAudio'),
      currentTime = document.getElementById('currentTime'),
      playPauseButton = document.getElementById('playPauseButton'),
      rewindButton = document.getElementById('rewindButton'),
      forwardButton = document.getElementById('fastForwardButton'),
      playlist = document.getElementById('playlist'),
      addTitleButton = document.getElementById('addTitle'),
      removeTitleButton = document.getElementById('removeTitle');

let timer = null;
function updateTime()
{
    var t = audio.currentTime;
    
    if (currentSegment && t >= currentSegment.end) 
    {
        audio.pause();
        playPauseButton.textContent = 'Play';
        clearInterval(timer);
    }
}

playPauseButton.onclick = () => 
{
    
    if (audio.paused) 
    {
        audio.play();
        playPauseButton.textContent = 'Pause';
            playPauseButton.style.backgroundColor = 'white';
            playPauseButton.style.color = 'black';
            playPauseButton.style.border = 'solid black';
        timer = timer || setInterval(updateTime, 250);
    }
    else
    {
        audio.pause();
        playPauseButton.textContent = 'Play';
            playPauseButton.style.backgroundColor = 'cornflowerblue';
            playPauseButton.style.color = 'white';
            playPauseButton.style.border = 'none';
        clearInterval(timer);
    }
};
rewindButton.onclick = ()  => { audio.currentTime = Math.max(0, audio.currentTime - 10); };
forwardButton.onclick = () => { audio.currentTime = Math.min(audio.duration, audio.currentTime + 10); };


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
let currentSegment = null;
function playSegment(i)
{
    currentSegment = segments[i];
        audio.currentTime = currentSegment.start;
        audio.play()
        playPauseButton.textContent = 'Play';

    clearInterval(timer);
    timer = setInterval (updateTime, 250);
}

function loadPlaylist() 
{
    playlist.innerHTML = '';
    segments.forEach((s,i) =>
    {
        const li = document.createElement('Li'),
              button = document.createElement('button');
        button.textContent = `${s.start} - ${s.title}`;

        button.onclick = () => playSegment(i);
        li.appendChild(button);
        playlist.appendChild(li);
    });
}

addTitleButton.onclick = () =>
{
    let newTitle = prompt('Enter A Title For Your Segment:')
        if(!newTitle) return;

    let t = audio.currentTime;
    let duration = parseFloat(prompt('How long in seconds is your segment?'));
        if (!duration) return;
    duration = Math.min(t + duration, audio.duration);

    segments.push({ title: newTitle, start: t, end: duration });
    segments.sort((a,b) => a.start-b.start);
    loadPlaylist();

};
removeTitleButton.onclick = () =>
{
    if(!currentSegment) return alert('Please Select A Segment To Remove')

    segments = segments.filter(s => s !== currentSegment)
    currentSegment = null;
    loadPlaylist();

    audio.pause();
    playPauseButton.textContent = 'Play'
    clearInterval(timer);
};




window.onload = () => 
{   
    let nameEdit = audio.src.split('/').pop();
        nameEdit = nameEdit.replace(/\.mp3/i, '');
    fileName.textContent = nameEdit;
    loadPlaylist();

    audio.onloadedmetadata = () => 
    {
        segments[segments.length-1].end = audio.duration;
    };
   
};





