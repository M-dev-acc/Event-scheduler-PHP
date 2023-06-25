<?php
include_once('../core/Event.php'); 

if (isset($_POST)) {
<<<<<<< HEAD
    if (!empty($_REQUEST['name']) && !empty($_REQUEST['date'])) {
=======
    if (!empty($_REQUEST['event']) && !empty($_REQUEST['scheduled_at'])) {
>>>>>>> 1f56c35c9e5452b30f1b90b015328061971111a0
        $event = new Core\Event();
        $status = $event->createEvent($_REQUEST);
        unset($_REQUEST);
        echo "Data is stored!";
    }    
}