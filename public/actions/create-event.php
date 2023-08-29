<?php
require_once(str_replace("\public", "", dirname(__DIR__)) . '\vendor\autoload.php');

if (isset($_POST)) {
    $response = json_encode([
        'status' => false,
        'message' => "Request is empty!",
    ]); 
    if (!empty($_REQUEST['name']) && !empty($_REQUEST['date'])) {
        $event = new Core\Event();
        $eventDataToInsert = [
            'event' => $_REQUEST['name'],
            'scheduled_at' => $_REQUEST['date'],
        ];
        $status = $event->createEvent($eventDataToInsert);
        unset($_REQUEST);
        
        $response = json_encode([
            'status' => true,
            'message' => "Event is scheduled.",
        ]);
    }

    echo $response;
}