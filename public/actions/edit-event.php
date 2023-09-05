<?php
require_once(str_replace("\public", "", dirname(__DIR__)) . '\vendor\autoload.php');
use Core\Event;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
</head>
<body>

    <main>
        <?php
            $eventObject = new Event();
            $eventDataObject = null;

            if (isset($_GET)) :
                
                $eventJsonData = $eventObject->getEvent($_REQUEST['event']);
                $eventDataObject = json_decode($eventJsonData)[0];

                $dateObject = new Core\DateTimeHelper();
                $eventDate = $dateObject->initialze($eventDataObject->time)->format('Y-m-d');

        ?>

        <fieldset>
            <legend>Edit Event</legend>
            
            <form action="./update-event.php" method="post">
                <input type="hidden" name="event" value="<?= $eventDataObject->id; ?>">
                <label for="eventNameInput">Event text</label>
                <input type="text" name="name" id="eventNameInput" value="<?= $eventDataObject->name; ?>"> <br />
                <label for="eventDateInput">Date</label>
                <input type="date" name="date" id="eventDateInput" value="<?= $eventDate; ?>"><br />

                <input type="submit" value="Update event">
            </form>

        </fieldset>

        <?php
            endif;
        ?>
    </main>
    
</body>
</html>