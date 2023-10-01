<?php
require '../vendor/autoload.php';
?>
<?php
$currentYear = date('Y');
$calendar = new Core\Calendar($currentYear);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>

    <link rel="stylesheet" href="./public/css/style.css">

    <template id="htmlTemplates">
        <dialog id="eventsModal" class="modal">
            <header class="modal__header">
                <h3 class="modal__header--heading" id="modalHeading">Insert date here</h3>
            </header>
            <main class="modal__body" id="modalContent">
                <form id="addEventForm" action="./actions/create-event.php" method="post">
                    <fieldset>
                        <legend>
                            <strong>Add Event</strong>
                        </legend>
                        <input type="hidden" name="date" id="eventDateInput">
                        <input type="text" name="name" id="eventTextInput">
                        <input type="submit" value="Add Event" class="form__btn">
                    </fieldset>
                </form>

                <ul id="eventsList">
                </ul>
            </main>
            <footer class="modal__footer">
                <button aria-label="Close">Cancel</button>
            </footer>
        </dialog>
        
        <li id="eventItem">
            <span data-child-role="event-text">Event 1</span>
            
            <button data-child-role="mark-btn">Mark as done</button>
        </li>

        <li id="emptyEventItem">
            <span data-child-role="message"></span>
        </li>
    </template>
</head>
<body>
    <header class="navbar">
        <nav class="navbar__container">
            <h2 class="navbar__contianer--logo">Calendar</h2>
        </nav>
    </header>
    
    <main class="container">
        
        <!-- Calendar start here -->
        <?= $calendar; ?>
        <!-- Calendar end here -->

    </main>

    <footer>

    </footer>

    <script type="module" src="./js/index.js"></script>
    
</body>
</html>