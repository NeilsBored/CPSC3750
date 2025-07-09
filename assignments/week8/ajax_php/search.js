/*
  File: search.js
  Author: Shane John
  Date: 2025-07-08
  Course: CPSC 3750 – Web Application Development
  Purpose: Implements search functions from chp 11 source code.
  Notes: Some words were changed to capital(s).
*/

// global variable to manage the timeout
var t;

// Start a timeout with each keypress
function startSearch() {
   if (t) window.clearTimeout(t);
   t = window.setTimeout("liveSearch()",200);
}

// Perform the search
function liveSearch() {
   // assemble the PHP filename
   query = document.getElementById("searchlive").value;
   filename = "search.php?query=" + query;
   // DisplayResults will handle the Ajax response
   ajaxCallback = displayResults;
   // Send the Ajax request
   ajaxRequest(filename);
}

// Display search results
function displayResults() {
   // remove old list
   ul = document.getElementById("list");
   div = document.getElementById("results");
   div.removeChild(ul);
   
   // make a new list
   ul = document.createElement("ul");
   ul.id="list";
   capitols = ajaxreq.responseXML.getElementsByTagName("capitol");
   for (i = 0; i < capitols.length; i++) {
      li = document.createElement("li");
      capitol = capitols[i].firstChild.nodeValue;
      text = document.createTextNode(capitol);
      li.appendChild(text);
      ul.appendChild(li);
   }
   if (capitols.length==0) {
      li = document.createElement("li");
      li.appendChild(document.createTextNode("No results"));
      ul.appendChild(li);
   }

   // display the new list
   div.appendChild(ul);
}

// set up event handler
obj=document.getElementById("searchlive");
obj.onkeydown = startSearch;