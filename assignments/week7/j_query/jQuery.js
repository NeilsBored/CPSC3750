/*
  File: jQuery.js
  Author: Shane John
  Date: 2025-06-27
  Course: CPSC 3750 – Web Application Development
  Purpose: Example Demo of jQuery Mouseover Effects, Fading Animations, Datepicker, Accordion, and Progress Bar
  Notes: The expiration dates are general accurate to the truth, but assumes minimum of estimates I found online.
*/

$(document).ready(function(){
  // Mouseover
  $("#jquery div.content").hover(
    function(){ $(this).css("background-color", "yellow"); },
    function(){ $(this).css("background-color", "white"); }
  );
  // Fading Effects
  $("#fade1").click(function(){ $("div.content").eq(1).fadeOut(); });
  $("#fade2").click(function(){ $("div.content").eq(2).fadeOut(); });
  $("#fade3").click(function(){ $("div.content").eq(3).fadeOut(); });

  // Accordion Animations
  $('#accordion').accordion({ heightStyle: 'content'});

  // Datepicker(or as I like to call it, "Giant Formatting Headache")..like why milliseconds for everything?
  $('#datepicker').datepicker
  ({
    onSelect: function(dateText) 
    {
      // Parse the selected date
      var selectedDate = $(this).datepicker('getDate');
        // Apples expiration: 5-7 days
          var expire1 = new Date(selectedDate.getTime() + 5 * 24 * 60 * 60 * 1000);
          $('#expire1').text($.datepicker.formatDate('mm/dd/yy', expire1));
        // Bananas expiration: 2-5 days
          var expire2 = new Date(selectedDate.getTime() + 2 * 24 * 60 * 60 * 1000);
          $('#expire2').text($.datepicker.formatDate('mm/dd/yy', expire2));
        // Carrots expiration: 14-21 days
          var expire3 = new Date(selectedDate.getTime() + 14 * 24 * 60 * 60 * 1000);
          $('#expire3').text($.datepicker.formatDate('mm/dd/yy', expire3));
    }
  });

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
