<?php
require_once(str_replace("\public", "", dirname(__DIR__)) . '\vendor\autoload.php');

use Core\Event;

if (isset($_POST)) {
    $eventObject = new Event();

    $response = json_encode([
        'status' => true,
        'message' => "Something went wrong!",
    ]);
    $eventId = (int) $_REQUEST['event'];

    $eventObject->deleteEvent($eventId);
    $response = json_encode([
        'status' => true,
        'message' => "Event is deleted!",
    ]);
    
    echo $response;
}