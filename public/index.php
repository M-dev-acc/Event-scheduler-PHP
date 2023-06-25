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
    <template id="eventFunctionalityWindow">
        <dialog class="">
            <header>
                <h3>Insert date here</h3>
            </header>
            <main>
                <div>
                    <fieldset>
                        <legend>Add Event</legend>
                        <input type="hidden" name="date" id="eventDateInput">
                        <input type="text" name="name" id="eventTextInput">
                        <input type="submit" value="Add Event">
                    </fieldset>
                </div>

                <div>
                    <ul>
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
                        <li>
                            <span>Event 1</span>
                            <button>Edit Btn</button>
                            <button>Edit Btn</button>
                        </li>
                    </ul>
                </div>
            </main>
            <footer></footer>
        </dialog>  
    </template>
</head>
<body>
    <header>
        <nav>
            <h3>Calendar</h3>
        </nav>
    </header>
    
<<<<<<< HEAD
    <main class="container">
        <!-- Calendar start here -->
        <?= $calendar; ?>
        <!-- Calendar end here -->
=======
    <main>
        <section>
            <header>
                
                <fielset>
                    <legend>Create an event</legend>
                    <form action="">
                        <input type="text" name="event" id="">
                        <input type="date" name="scheduled_at" id="">
                        <input type="submit" value="Create an event">
                    </form>
                </fielset>
            </header>

            <?= $calendar; ?>

            

            
        </section>
>>>>>>> 1f56c35c9e5452b30f1b90b015328061971111a0
    </main>

    <footer>

    </footer>

    <script src="./js/index.js"></script>
</body>
</html>