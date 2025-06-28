/*
  File: KeyPress.js
  Author: Shane John
  Date: 2025-06-27
  Course: CPSC 3750 – Web Application Development
  Purpose: Handles user input to translate the keyPress events into action
  Notes: I orginally had the vowel logic use if/then statements, but I thought it would be cool to test a regex solution. Hope that's okay!
*/

// Waits until fully loaded
$(document).ready(function() {
  // Keypress event handler
  $(document).keypress(function(e) 
  {
    var ch    = String.fromCharCode(e.which);
    // Force vowels to uppercase
    var keyDisplay  = /[aeiou]/i.test(ch) ? ch.toUpperCase() : ch;
    // Map background colors
    var colors = { r: 'red', g: 'green', b: 'blue' };
    var lower  = ch.toLowerCase();
      // Is the pressed key a vowel?
      if (colors[lower]) 
      {
        $('body').css(
        {
          backgroundColor:colors[lower],
          color: 'white'
        });
      } 
      // Not,Reset to default
      else 
      {
        $('body').css(
        {
          backgroundColor: 'white',
          color: 'black'
        });
      }
    // Display Final Character 
    $('#output').text(keyDisplay).css(
    {
      'font-size': '40px'
    });
  });
});