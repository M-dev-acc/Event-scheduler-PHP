<?php
include_once('../core/Event.php'); 

if (isset($_POST)) {
    if (!empty($_REQUEST['name']) && !empty($_REQUEST['date'])) {
        $event = new Core\Event();
        $status = $event->createEvent($_REQUEST);
        unset($_REQUEST);
        echo "Data is stored!";
    }    
}