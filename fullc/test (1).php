<?php
    require 'getEvents.php';
?>


<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src="https://www.jsdelivr.com/package/npm/fullcalendar"></script>
    <link href='fullcalendar/main.css' rel='stylesheet' />
    <script src='fullcalendar/main.js'></script>
    <script>
	
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        /*var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });*/
        var events = '<?= json_encode(getEvents()); ?>';
        var calendar = new FullCalendar.Calendar(calendarEl, {
    	    eventClick: function(info) {
    	    	alert('Event: ' + info.event.title);
        		alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
        		alert('View: ' + info.view.type);
        		// change the border color just for fun
        		info.el.style.borderColor = 'red';
    	    },
            events: '/fullc/testInit.php'
            
        });
        calendar.render();
      });
    // Sending and receiving data in JSON format using POST method
    function sendAndRecvJSON() {
	//
	var xhr = new XMLHttpRequest();
	var url = "url";
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-Type", "application/json");
	xhr.onreadystatechange = function () {
	    if (xhr.readyState === 4 && xhr.status === 200) {
	        var json = JSON.parse(xhr.responseText);
	        console.log(json.email + ", " + json.password);
	    }
	};
	var data = JSON.stringify({"email": "hey@mail.com", "password": "101010"});
	xhr.send(data);
    }
    </script>
  </head>
  <body>
    <div id='calendar'></div>
  </body>
</html>
