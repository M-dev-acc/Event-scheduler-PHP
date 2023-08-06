<?php
require '../../vendor/autoload.php';

use Core\Event;

$obj = new Event();

if (isset($_GET)) {
    echo json_encode([
        'status' => true,
        'data' => json_decode($obj->getEvents($_REQUEST['date'])),
    ]);
}
?>