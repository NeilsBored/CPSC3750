/*
  File: jQuery.html
  Author: Shane John
  Date: 2025-06-27
  Course: CPSC 3750 – Web Application Development
  Purpose: Frontend fluff to implement the backend mess 
  Notes: The border radius change on the navbar is intentional, I wanted to showcase the back ground change a little more.
*/

$(document).ready(function(){
  
  $("div.content").hover(
    function(){ $(this).css("background-color", "yellow"); },
    function(){ $(this).css("background-color", "white"); }
  );
  
  $("#fade1").click(function(){ $("div.content").eq(0).fadeOut(); });
  $("#fade2").click(function(){ $("div.content").eq(1).fadeOut(); });
  $("#fade3").click(function(){ $("div.content").eq(2).fadeOut(); });


  //$("#datepicker").datepicker();

  //$("#accordion").accordion();
  
  $('#accordion').accordion({ heightStyle: 'content'});

 
  $('#datepicker').datepicker({
    onSelect: function(dateText) {
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


  var total = 20, elapsed = 0;
  $('#progressbar').progressbar({ value: 0 });
  setInterval(function(){
    elapsed++;
    var percent = Math.min((elapsed/total) * 100, 100);
    $('#progressbar').progressbar('value', percent);
  }, 1000);


  $("#progressbar").progressbar({ value: 0 });
  let val = 0;
  const timer = setInterval(function(){
    val += 5; // 5% per second - 20 seconds total
    $("#progressbar").progressbar("value", val);
    if(val >= 100) clearInterval(timer);
  }, 1000);
});
