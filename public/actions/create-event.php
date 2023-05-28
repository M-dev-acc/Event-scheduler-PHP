<?php
include_once('../core/Event.php'); 

if (isset($_POST)) {
    if (!empty($_REQUEST['event']) && !empty($_REQUEST['scheduled_at'])) {
        $event = new Core\Event();
        $status = $event->createEvent($_REQUEST);
        unset($_REQUEST);
        echo "Data is stored!";
    }    
}