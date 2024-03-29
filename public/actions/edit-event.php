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

    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
    <header class="navbar">
        <nav class="navbar__container">
            <h2 class="navbar__contianer--logo">Event information</h2>

            <ul class="navbar__menu">
                <li class="navbar__menu--item">
                    <a href="./public/index.php" class="link">Home</a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="container">
        <?php
            $eventObject = new Event();
            $eventDataObject = null;

            if (isset($_GET)) :
                
                $eventJsonData = $eventObject->getEvent($_REQUEST['event']);
                $eventDataObject = json_decode($eventJsonData)[0];

                $dateObject = new Core\DateTimeHelper();
                $eventDate = $dateObject->initialze($eventDataObject->time)->format('Y-m-d');

        ?>

        <form action="./update-event.php" method="post" id="deleteEventForm">
            <input type="hidden" name="event" value="<?= $eventDataObject->id; ?>">
            <input type="submit" value="Delete event">
        </form>

        <fieldset>
            <legend>
                <strong>Edit Event</strong>
            </legend>
            
            <form action="./update-event.php" method="post" id="updateEventForm">
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
    
    <script type="module">
        import Http from "../js/components/Ajax.js";

        const baseURL = window.location.origin;
        const ajaxHelper = new Http();

        const updateEventForm = document.querySelector('form#updateEventForm');
        
        updateEventForm.addEventListener('submit', event => {
            event.preventDefault();
            
            let formData = new FormData(updateEventForm);
            const addEventPromise = ajaxHelper.post(`${baseURL}/Calendar/actions/update-event.php`, formData);
            addEventPromise.then(response => {
                updateEventForm.reset();
                alert(response.message);
                document.location.reload(true);
            });
        });

        const deleteEventForm = document.querySelector('form#deleteEventForm');
        
        deleteEventForm.addEventListener('submit', event => {
            event.preventDefault();
            let formData = new FormData(updateEventForm);
            
            const addEventPromise = ajaxHelper.post(`${baseURL}/Calendar/actions/delete-event.php`, formData);
            addEventPromise.then(response => {
                updateEventForm.reset();
                alert(response.message);
                document.location = `${baseURL}/Calendar/index.php`;
            });
        });
    </script>
</body>
</html>