<?php
require_once(str_replace("\public", "", dirname(__DIR__)) . '\vendor\autoload.php');

if (isset($_POST)) {
    $response = json_encode([
        'status' => false,
        'message' => "Request is empty!",
    ]); 
    if (!empty($_REQUEST['event'])) {
        
        $eventObject = new Core\Event();
        $eventDataObject = $eventObject->getEvent($_REQUEST['event']);
        $eventData = json_decode($eventDataObject)[0];
        $updatedStatus = ($eventData->status) ? 0 : 1;

        $eventDataToUpdate = [
            'status' => $updatedStatus,
        ];
        $whereClause = [
            ['id', '=', $_REQUEST['event']],
        ];
        $status = $eventObject->updateEvent($eventDataToUpdate, $whereClause);
        unset($_REQUEST);
        
        $response = json_encode([
            'status' => true,
            'message' => "Event marked as done.",
            'data' => [
                'event_status' => $updatedStatus,
            ]
        ]);
        
    }

    echo $response;
}