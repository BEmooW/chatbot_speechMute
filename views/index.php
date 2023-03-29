<?php
require "../controllers/eventC.php";
require "../models/Event.php";
$eventC = new eventC();
$listEvents = $eventC->displayEvents();
$updateEvent = NULL;

if (isset($_GET["removeEvent"]) && !empty($_GET["removeEvent"])) {
    $eventC->deleteEvent($_GET["removeEvent"]);
    header('location: http://localhost/corrCRUD%20-%20Copie/views/');
}

if (isset($_POST) && !empty($_POST)) {
    if (isset($_GET["updateEvent"]) && !empty($_GET["updateEvent"])) {
        $event = new event($_POST["nom"], $_POST["type"], $_POST["lieu"], new \DateTime($_POST["dateEvent"]), $_POST["description"], $_POST["nbPlaces"]);
        $eventC->updateEvent($_GET["updateEvent"], $event);
    } else {
        $event = new event($_POST["nom"], $_POST["type"], $_POST["lieu"], new \DateTime($_POST["dateEvent"]), $_POST["description"], $_POST["nbPlaces"]);
        $eventC->addEvent($event);
    }
    header('location: http://localhost/corrCRUD%20-%20Copie/views/');
}

if (isset($_GET["updateEvent"]) && !empty($_GET["updateEvent"])) {
    $updateEvent = $eventC->getEventById($_GET["updateEvent"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../chatbot/style.css" />
    <style>
        .removeBtn {
            background-color: red;
            color: white;
        }

        .updateBtn {
            background-color: green;
            color: white;
        }
    </style>
</head>

<body>
    <h1 style="text-align:center">Atelier CRUD PHP</h1>
    <h1>Ajouter un Event</h1>
    <form method="POST" action="index.php<?= ($updateEvent !== NULL) ? "?updateEvent=" . $updateEvent["idEvent"] : ""; ?>">
        nom:<input type="text" value="<?= ($updateEvent !== NULL) ? $updateEvent["nom"] : ""; ?>" name="nom" placeholder="write the event name" id=""><br /><br />
        type:<input type="text" value="<?= ($updateEvent !== NULL) ? $updateEvent["type"] : ""; ?>" name="type" placeholder="write the event type" id=""><br /><br />
        lieu:<input type="text" value="<?= ($updateEvent !== NULL) ? $updateEvent["lieu"] : ""; ?>" name="lieu" placeholder="write the event location" id=""><br /><br />
        date de l'event:<input type="date" value="<?= ($updateEvent !== NULL) ? $updateEvent["dateEvent"] : ""; ?>" name="dateEvent" id=""><br /><br />
        description:<textarea name="description" placeholder="write the event description" id=""><?= ($updateEvent !== NULL) ? $updateEvent["description"] : ""; ?></textarea><br /><br />
        nombre de places:<input type="number" value="<?= ($updateEvent !== NULL) ? $updateEvent["nbPlaces"] : ""; ?>" name="nbPlaces" id=""><br /><br />
        <input type="submit" value="<?= ($updateEvent === NULL) ? 'Ajouter Event' : 'Update Event' ?>" />
    </form>
    <h1>Liste des Events</h1>
    <table border="1">
        <thead>
            <th>id Event</th>
            <th>nom</th>
            <th>type</th>
            <th>lieu</th>
            <th>date de l'event</th>
            <th>description</th>
            <th>nombre de places</th>
            <th>action</th>
            <th>image</th>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($listEvents); $i++) {
            ?>
                <tr>
                    <td><?= $listEvents[$i]["idEvent"]; ?></td>
                    <td><?= $listEvents[$i]["nom"]; ?></td>
                    <td><?= $listEvents[$i]["type"]; ?></td>
                    <td><?= $listEvents[$i]["lieu"]; ?></td>
                    <td><?= $listEvents[$i]["dateEvent"]; ?></td>
                    <td><?= $listEvents[$i]["description"]; ?></td>
                    <td><?= $listEvents[$i]["nbPlaces"]; ?></td>

                    <td>
                        <button class="removeBtn" onclick="removeEvent(<?= $listEvents[$i]['idEvent']; ?>)">Supprimer</button>
                        <button class="updateBtn" onclick="updateEvent(<?= $listEvents[$i]['idEvent']; ?>)">Update</button>
                    </td>
                    <td>
                        <div class="alb">
                            <img src="uploads/<?= $listEvents[$i]["image_url"]; ?>">
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="container collapse">
        <div class="chat-header">
            <div class="logo">
                <img src="../chatbot/images/chaticon.png" alt="icon">
            </div>
            <div class="title">ChatBot</div>
        </div>
        <div class="outer">
            <select></select>
            <button id="mute"><img src="../chatbot/images/mute-speaker.png" alt="icon"></button>
        </div>

        <div class="chat-body">
            <div class="loading hide">
                <div class="circle circle-1"></div>
                <div class="circle circle-2"></div>
                <div class="circle circle-3"></div>
            </div>
        </div>
        <div class="chat-input">
            <div class="input-sec">
                <input type="text" id="txtinput" placeholder="Type here" autofocus>
            </div>
            <div class="send">
                <img src="../chatbot/images/send-message.png" alt="send">
            </div>
        </div>
    </div>
    <button class="chatButton">
        <img src="../chatbot/images/chaticon.png" alt="icon" />
    </button>






    <script src="../chatbot/app.js"></script>
    <script>
        const removeEvent = (id) => {
            location.href = `http://localhost/corrCRUD%20-%20Copie/views/index.php?removeEvent=${id}`
        }
        const updateEvent = (id) => {
            location.href = `http://localhost/corrCRUD%20-%20Copie/views/index.php?updateEvent=${id}`
        }
    </script>
</body>

</html>