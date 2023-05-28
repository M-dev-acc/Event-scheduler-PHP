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
</head>
<body>
    <header>
        <nav>
            <h3>Calendar</h3>
        </nav>
    </header>
    
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
    </main>

    <footer>

    </footer>
</body>
</html>