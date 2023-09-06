<?php
require_once(str_replace("\public", "", dirname(__DIR__)) . '\vendor\autoload.php');

if (isset($_POST)) {
    $response = json_encode([
        'status' => false,
        'message' => "Request is empty!",
    ]); 
    if (!empty($_REQUEST['name']) && !empty($_REQUEST['date'])) {
        $eventObject = new Core\Event();
        $eventJsonData = $eventObject->getEvent($_REQUEST['event']);
        $eventDataObject = json_decode($eventJsonData)[0];

        $dateObject = new Core\DateTimeHelper();
        $eventDate = $dateObject->initialze($eventDataObject->time);
        $dateToUpdate = $dateObject->initialze($_REQUEST['date']);
        $isDateValid = $dateObject->isValidDate($_REQUEST['date']);

        $response = json_encode([
            'status' => false,
            'message' => "Date is not valid",
        ]);

        $eventDataToInsert = [
            'name' => $_REQUEST['name'],
        ];

        if ($eventDate === $dateToUpdate) {
            unset($eventDataObject['time']);
        }
        
        if ($isDateValid) {
            $eventDataToInsert['time'] = $dateToUpdate->format('Y-m-d');
        }
            
        $whereCondition = [
            ['id', '=', $_REQUEST['event']],
        ];
        
        $status = $eventObject->updateEvent($eventDataToInsert, $whereCondition);
        unset($_REQUEST);
        
        $response = json_encode([
            'status' => true,
            'message' => "Event data is updated.",
        ]);
        
    }

    echo $response;
}