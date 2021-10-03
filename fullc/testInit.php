<?php
include 'getEvents.php';

$events = getEvents();
print(json_encode($events));
//print_r($events);
?>