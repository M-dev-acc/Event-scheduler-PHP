<?php
include '../vendor/autoload.php';
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
                <div id="addEventForm">
                    <fieldset>
                        <legend>Add Event</legend>
                        <input type="hidden" name="date" id="eventDateInput">
                        <input type="text" name="name" id="eventTextInput">
                        <input type="submit" value="Add Event">
                    </fieldset>
                </div>

                <div>
                    <ul id="eventsList">
                        <li id="eventItem">
                            <span>Event 1</span>
                            <button>Edit Btn</button>
                            <button>Edit Btn</button>
                        </li>
                        <li>
                            <span>Event 1</span>
                            <button>Edit Btn</button>
                            <button>Edit Btn</button>
                        </li>
                        <li>
                            <span>Event 1</span>
                            <button>Edit Btn</button>
                            <button>Edit Btn</button>
                        </li>
                    </ul>
                </div>
            </main>
            <footer class="modal__footer">
                <button formmethod="dialog" aria-label="Close">Close</button>
            </footer>
        </dialog>
        
    </template>
</head>
<body>
    <header>
        <nav>
            <h3>Calendar</h3>
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