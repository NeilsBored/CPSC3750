/* 
  File: debug.js
  Author: Shane John
  Date: 2025-07-19
  Course: CPSC 3750 – Web Application Development
  Purpose: Client side handling of checkbox change for debug window     
  Notes: If I had more time to work on this I would try to evaluate the 
         balance between functions on client and server side, maybe more than debug show toggle.
*/

document.addEventListener('DOMContentLoaded', function() 
{
  const checkbox = document.querySelector('input[name="debug"]');
  const debugSection = document.getElementById('debug-section');
  if (checkbox && debugSection) 
  {
    checkbox.addEventListener('change', function() 
    {
      debugSection.classList.toggle('hidden', !this.checked);
    });
  }
});