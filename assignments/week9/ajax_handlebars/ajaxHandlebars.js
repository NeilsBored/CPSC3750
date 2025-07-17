/*
  File: ajaxHandlebars.js
  Author: Shane John
  Date: 2025-07-15
  Course: CPSC 3750 – Web Application Development
  Purpose: Implements AJAX requests/responses, along with "handling" the render of Players info with Handlebars
  Note: At First, it seemed like a cool idea to organize by positions...then I started working on it. jk
*/

// Grabs players.json data on page load
window.onload = function() 
{
  var dataRequest = new XMLHttpRequest();
  dataRequest.open('GET', 'players.json', true);
  dataRequest.onreadystatechange = function() 
  {
    // Verify request is complete and successful
    if (dataRequest.readyState === 4 && dataRequest.status === 200) 
    {
      // Parse JSON response and render players grouped by position
      var data = JSON.parse(dataRequest.responseText);
      renderPositions(data);
    }
  };
  dataRequest.send();
};

function groupByPosition(players) 
{
  var map = {};
  players.forEach(function(p) 
  {
    // If the position does not exist yet, initialize empty array
    if (!map[p.position]) 
    {
      map[p.position] = [];
    }
    // Add current player to position array
    map[p.position].push(p);
  });
  // Convert the map to useable array
  return Object.keys(map).map(function(pos) 
  {
    return {position: pos, players: map[pos]};
  });
}

// Render Function Based on Provided Video
function renderPositions(data) 
{
  var groupedData = {positions: groupByPosition(data.players)};
  var templateSource = document.getElementById('players-template').innerHTML;
  var template = Handlebars.compile(templateSource);
  document.getElementById('players-container').innerHTML = template(groupedData);
}
