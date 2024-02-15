<?php
require_once "../../controllers/eventC.php";
require_once "../../models/event.php";
require_once "../../controllers/ticketC.php";
require_once "../../models/ticket.php";
include "phpqrcode/qrlib.php";
include 'vendor/autoload.php';

use Twilio\Rest\Client;

$eventC = new eventC();
$TicketC = new ticketC();

$listTickets = $TicketC->displayTickets();
// $ticketEvent = $TicketC->getEventNameFromTicket($idTicket);
if (isset($_POST["btntri"]) && !empty($_POST["btntri"])) {
    $listEvents = $eventC->trisEvent($_POST["tri"]);
} else {
    if (isset($_GET['searchname']) && !empty($_GET['searchname'])) {
        $listEvents = $eventC->searchEvents($_GET["searchname"]);
    } else {
        $listEvents = $eventC->displayEvents();
    }
}
// display tickets


if (isset($_POST["btntriT"]) && !empty($_POST["btntriT"])) {
    $listTickets = $TicketC->trisTicket($_POST["triT"]);
} else {
    if (isset($_GET['searchticket']) && !empty($_GET['searchticket'])) {
        $listTickets = $TicketC->searchTickets($_GET["searchticket"]);
    } else {
        $listTickets = $TicketC->displayTickets();
    }
}



$updateEvent = NULL;
$updateTicket = NULL;

if (isset($_GET["removeEvent"]) && !empty($_GET["removeEvent"])) {
    $eventC->deleteEvent($_GET["removeEvent"]);
    header('location:http://localhost/Projet/views/Backoffice/ListEvent.php');
}

if (isset($_POST["btncrud"]) && !empty($_POST["btncrud"])) {
    if (isset($_GET["updateEvent"]) && !empty($_GET["updateEvent"])) {
        $event = new event(
            $_POST["nom"],
            $_POST["type"],
            $_POST["lieu"],
            new \DateTime($_POST["dateEventStart"]),
            new \DateTime($_POST["dateEventEnd"]),
            $_POST["description"],
            $_POST["nbPlaces"],
            $_POST["image"],
            $_POST["prixEvent"]
        );

        $eventC->updateEvent($_GET["updateEvent"], $event);
    } else {
        $event = new event(
            $_POST["nom"],
            $_POST["type"],
            $_POST["lieu"],
            new \DateTime($_POST["dateEventStart"]),
            new \DateTime($_POST["dateEventEnd"]),
            $_POST["description"],
            $_POST["nbPlaces"],
            $_POST["image"],
            $_POST["prixEvent"]
        );
        $eventC->addEvent($event);
        $nom = $_POST["nom"];
        $date_deb = $_POST["dateEventStart"];
        $lieu = $_POST["lieu"];
        // ===========SMS===========
        $sid = "ACfa6210b6fe340934459453f28efadd93";
        $token = "66c7c403e1e0d22c5a59bbf61b24edc4";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                "+21652210804", // to
                [
                    "body" => "A new event is now available! : Name : $nom | Start date : $date_deb | Location : $lieu , BREATHE",
                    "from" => "+13203027894"
                ]
            );

        print($message->sid);
    }
    header('location:http://localhost/Projet/views/Backoffice/ListEvent.php');
}

if (isset($_GET["updateEvent"]) && !empty($_GET["updateEvent"])) {
    $updateEvent = $eventC->getEventById($_GET["updateEvent"]);
}
// ticket

$updateTicket = NULL;

if (isset($_GET["removeTicket"]) && !empty($_GET["removeTicket"])) {
    $TicketC->deleteTicket($_GET["removeTicket"]);
    header('location:http://localhost/Projet/views/Backoffice/Evenement.php');
}

if (isset($_POST["btncrudT"]) && !empty($_POST["btncrudT"])) {
    if (isset($_GET["updateTicket"]) && !empty($_GET["updateTicket"])) {
        $ticket = new ticket(
            $_POST["idEvent"],
            new \DateTime($_POST["dateTicketExp"]),
            false,
            $_POST["codeTicket"],
            $_POST["detailTicket"]
        );
        $TicketC->updateTicket($ticket);
    } else {
        $EventName = $eventC->getEventById($_POST["idEvent"])['nom'];
        $qrCodeText = $_POST["idEvent"] . "-" . $EventName . "-" . $_POST["dateTicketExp"] . "BREATHE";
        $location = "../balkis/qrcode/" . $qrCodeText . ".png";
        QRcode::png($qrCodeText, $location);
        $ticket = new ticket(
            $_POST["idEvent"],
            new \DateTime($_POST["dateTicketExp"]),
            false,
            $qrCodeText,
            $_POST["detailTicket"]
        );
        $eventT = $eventC->getEventById($_POST["idEvent"]);
        $nbTicket = $eventT["nbPlaces"];
        $TicketC->addTicket($ticket, $nbTicket);
    }
    header('location:http://localhost/Projet/views/Backoffice/Evenement.php#newTickets');
}

if (isset($_GET["updateTicket"]) && !empty($_GET["updateTicket"])) {

    $updateTicket = $TicketC->getTicketById($_GET["updateTicket"]);
    // echo $updateTicket->getidTicket();
}



//bar chart

$db = config::getConnection();

$q1 = $db->query("SELECT * FROM events WHERE 4>=nbPlaces");
$q1->execute();
$c1 = count($q1->fetchAll());

$q2 = $db->query("SELECT * FROM events WHERE nbPlaces between 5 and 7");
$q2->execute();
$c2 = count($q2->fetchAll());

$q3 = $db->query("SELECT * FROM events WHERE nbPlaces between 8 and 10");
$q3->execute();
$c3 = count($q3->fetchAll());


$q4 = $db->query("SELECT * FROM events WHERE nbPlaces between 11 and 15");
$q4->execute();
$c4 = count($q4->fetchAll());

$q5 = $db->query("SELECT * FROM events WHERE nbPlaces>15");
$q5->execute();
$c5 = count($q5->fetchAll());

//pie chart

$qb1 = $db->query("SELECT * FROM events WHERE type = 'Agriculture'");
$qb1->execute();
$cb1 = count($qb1->fetchAll());
$qb2 = $db->query("SELECT * FROM events WHERE type = 'Donation'");
$qb2->execute();
$cb2 = count($qb2->fetchAll());
$qb3 = $db->query("SELECT * FROM events WHERE type = 'Educative'");
$qb3->execute();
$cb3 = count($qb3->fetchAll());






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Try</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+icons+sharp">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../balkis/css/style.css">
    <link rel="stylesheet" href="../balkis/css/balkis.css">
    <link rel="stylesheet" href="../balkis/css/recherche.css">
    <link rel="stylesheet" href="../balkis/css/chart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/CSS/bootsrap.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .sort-form {
            max-width: 150px;
        }

        .sort-form select {
            padding: 3px;
            border: none;
            background-color: #f8f8f8;
            color: #333;
            font-weight: bold;
            border-radius: 3px;

        }

        .sort-form input {
            max-width: 150px;
        }

        .qrscanner {
            margin-right: -200px;
            margin-left: 200px;
            margin-top: 50px;
            max-width: 100px;
            max-height: 100px;
        }

        .sidebarEv li {
            margin-top: 40px;
            /* display: inline-block; */
            vertical-align: top;
            position: relative;
            margin-right: 110px;
        }

        .sidebarEv li a {
            display: block;
        }

        .sidebarEv li a:hover {
            color: #82E0AA;
        }

        .sidebarEv li:hover .sub-menu {
            display: block;
            left: 100%;
            top: 0;
        }

        .sub-menu {
            z-index: 1;
            display: none;
            position: absolute;
            top: 0;
            left: 100%;
            margin-left: -80px;
            /* Updated */
            width: 200px;
            padding: 0;
            margin: 0;
            margin-top: -5px;
            border-radius: 10px;
            background-color: #82E0AA;
            /* softer green color */
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
            opacity: .9;
        }


        .sub-menu li {
            list-style: none;
            margin: 0;
            padding: 10px 20px;

        }

        .sub-menu li a {
            display: block;
            color: #f8f8f8;
            text-decoration: none;
            font-size: 16px;
        }

        .sub-menu li a:hover {
            color: #333333;
        }

        .cudBox {
            position: relative;
            /*couleur du groupe box*/
            padding: 20px;
            width: 100%;
            /* group box largeur // */
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            max-width: 480px;
            min-height: 200px;
            background: #fff;
            align-items: center;
            margin-right: -60px;
            margin-left: 200px;
        }

        h1 {
            margin-left: 200px;
        }

        .cudBox input,
        textarea {
            min-width: 420px;
        }

        .cudBox select {
            max-width: 420px;
        }
    </style>


</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="../balkis/img/breathelogo.png">
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">
                        close
                    </span>

                </div>
            </div>
            <div class="sidebarEv">
                <ul>
                    <li>
                        <a href="Tableau.php">
                            <span class="material-symbols-sharp">
                                grid_view
                            </span>
                            <h3>Tableau de bord</h3>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="material-symbols-outlined">
                                shopping_cart_checkout
                            </span>
                            <h3>Shop</h3>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="ajouterCategorie.php">
                                    <span class="material-symbols-outlined">
                                        shopping_cart_checkout
                                    </span>
                                    <h3>Add Category</h3>

                                </a>
                            </li>
                            <li>
                                <a href="ajouterProduit.php">
                                    <span class="material-symbols-outlined">
                                        shopping_cart_checkout
                                    </span>
                                    <h3>Add Product</h3>

                                </a>
                            </li>
                            <li>
                                <a href="Produits.php">
                                    <span class="material-symbols-outlined">
                                        shopping_cart_checkout
                                    </span>
                                    <h3>Products</h3>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="Recyclage.php">
                            <span class="material-symbols-outlined">
                                compost
                            </span>
                            <h3>Recyclage</h3>
                        </a>

                    </li>
                    <li>
                        <a href="#" class="active">
                            <span class="material-symbols-sharp">
                                event
                            </span>
                            <h3>Events</h3>

                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="ListEvent.php">
                                    <span class="material-symbols-sharp">
                                        event
                                    </span>
                                    <h3>Events list</h3>

                                </a>
                            </li>
                            <li>
                                <a href="AddEvent.php">
                                    <span class="material-symbols-sharp">
                                        event
                                    </span>
                                    <h3>Add Event</h3>
                                </a>
                            </li>
                        </ul>

                    </li>
                    <li>
                        <a href="ListTicket.php">
                            <span class="material-symbols-outlined">
                                confirmation_number
                            </span>
                            <h3>Tickets List</h3>
                        </a>


                    </li>
                    <li>
                        <a href="#">
                            <span class="material-symbols-sharp">
                                article
                            </span>
                            <h3>Blogs</h3>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="addBlog.php">
                                    <span class="material-symbols-outlined">
                                        article
                                    </span>
                                    <h3>Add Blog</h3>

                                </a>
                            </li>
                            <li>
                                <a href="ListBlogs.php">
                                    <span class="material-symbols-outlined">
                                        article
                                    </span>
                                    <h3>Blogs List</h3>
                                </a>
                            </li>
                            <li>
                                <a href="ListCmnt.php">
                                    <span class="material-symbols-outlined">
                                        article
                                    </span>
                                    <h3>Comments List</h3>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="Admin.php">
                            <span class="material-symbols-sharp">
                                account_circle
                            </span>
                            <h3>Admin</h3>
                        </a>
                    </li>
                    <li>
                        <a href="../../controllers/logout.php">
                            <span class="material-symbols-sharp">
                                logout
                            </span>
                            <h3>Disconnecter</h3>
                        </a>
                    </li>
                </ul>

            </div>
        </aside>
        <!----- end of aside -->
        <main>
            <br>

            <h1><?= ($updateEvent === NULL) ? 'Add Event' : 'Update Event' ?></h1></br>
            <div class="cudBox">
                <form method="POST" action="AddEvent.php<?= ($updateEvent !== NULL) ? "?updateEvent=" . $updateEvent["idEvent"] : ""; ?>">
                    <div class="form">
                        <input type="text" value="<?= ($updateEvent !== NULL) ? $updateEvent["nom"] : ""; ?>" name="nom" placeholder=" " autocomplete="off" class="form__input" oninput="checkNom(this)"><br /><br />
                        <label for="nom" class="form__label">Nom</label>
                    </div>
                    <span id="nom"></span>
                    </br>
                    </br>
                    <select name="type" id="selectType" onclick="checkType(this)" class="selectType">
                        <option value="">-- Sélectionnez le type --</option>
                        <option value="Agriculture" <?php if (($updateEvent !== NULL) && ($updateEvent["type"] === "Agriculture")) echo "selected"; ?>>Agriculture</option>
                        <option value="Donation" <?php if (($updateEvent !== NULL) && ($updateEvent["type"] === "Donation")) echo "selected"; ?>>Donation</option>
                        <option value="Entertainment" <?php if (($updateEvent !== NULL) && ($updateEvent["type"] === "Entertainment")) echo "selected"; ?>>Entertainment</option>
                        <option value="Educative" <?php if (($updateEvent !== NULL) && ($updateEvent["type"] === "Educative")) echo "selected"; ?>>Educative</option>
                        <option value="Cleaning" <?php if (($updateEvent !== NULL) && ($updateEvent["type"] === "Cleaning")) echo "selected"; ?>>Cleaning</option>
                        <option value="Sports" <?php if (($updateEvent !== NULL) && ($updateEvent["type"] === "Sports")) echo "selected"; ?>>Sports</option>
                        <option value="Animals" <?php if (($updateEvent !== NULL) && ($updateEvent["type"] === "Animals")) echo "selected"; ?>>Animals</option>

                    </select>
                    <span id="type"></span>
                    </br>
                    </br>
                    </br>
                    <div class="form">
                        <input type="text" value="<?= ($updateEvent !== NULL) ? $updateEvent["lieu"] : ""; ?>" name="lieu" placeholder=" " id="" autocomplete="off" class="form__input" oninput="checkLieu(this)"><br /><br />
                        <label for="lieu" class="form__label">Lieu</label>
                    </div>
                    <span id="lieu"></span>
                    </br>
                    </br>
                    <div class="form">
                        <input type="datetime-local" name="dateEventStart" value="<?= ($updateEvent !== NULL) ? date('Y-m-d\TH:i:s', strtotime($updateEvent["dateEventStart"])) : ''; ?>" id="dateEventStart" class="form__input" autocomplete="off">

                        <label for="dateEventStart" class="form__label">Date start</label>
                    </div>
                    <span id="dateStart"></span>
                    </br>
                    </br>
                    <div class="form">
                        <input type="datetime-local" name="dateEventEnd" value="<?= ($updateEvent !== NULL) ? date('Y-m-d\TH:i:s', strtotime($updateEvent["dateEventEnd"])) : ''; ?>" id="dateEventStart" class="form__input" autocomplete="off">

                        <label for="dateEventEnd" class="form__label">Date End</label>
                    </div>
                    <span id="dateEnd"></span>
                    </br>
                    </br>

                    <div class="form">
                        <textarea name="description" placeholder=" " id="" cols="35" rows="10" autocomplete="off" class="form__input" oninput="checkDesc(this)"><?= ($updateEvent !== NULL) ? $updateEvent["description"] : ""; ?></textarea><br /><br />
                        <label for="description" class="form__label">Description</label>
                    </div>
                    </br>
                    </br>
                    <span id="desc"></span>
                    </br>

                    </br>
                    <div class="form">
                        <input type="number" value="<?= ($updateEvent !== NULL) ? $updateEvent["nbPlaces"] : ""; ?>" name="nbPlaces" id="" placeholder=" " autocomplete="off" class="form__input" oninput="checkNbPlaces(this)"><br /><br />
                        <label for="nbPlaces" class="form__label">Nb Places</label>
                    </div>
                    <span id="nbPlaces"></span>
                    </br>
                    </br>
                    <!-- <div class="intrested">
                <input type="checkbox" id="interet"name="interet" value="intrested" checked>
                <label for="interet" values >intrested</label>
                </div>
                </br> -->
                    <input type="file" id="image" name="image" value="<?= ($updateEvent !== NULL) ? $updateEvent["image"] : ""; ?>" />
                    </br>
                    </br>
                    <div class="form">
                        <input type="text" id="prixEvent" name="prixEvent" class="form__input" value="<?= ($updateEvent !== NULL) ? $updateEvent["prixEvent"] : ""; ?>" />
                        <label for="prixEvent" class="form__label">Price</label>
                    </div>
                    <!-- <span id="price"></span> -->
                    </br>
                    <input type="submit" class="submitBtn" name="btncrud" value="<?= ($updateEvent === NULL) ? 'Ajouter Event' : 'Update Event' ?>" />
                    </br>
                    </br>
                    <input type="reset" value="cancel" id="resetBtn">
                </form>
            </div>


            <input type="hidden" id="c1" value="<? htmlspecialchars_decode($rows) ?>">





            <br>
        </main>
        <div class="right">

            <div class="qrscanner"><a href="zoom.php"><img src="../balkis/img/zoom.png"></a></div>
        </div>

    </div>

    <script src="../balkis/js/controle_saisie.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

    <script src="../balkis/js/filter.js"></script>
    <script>
        // crud
        const removeEvent = (id) => {
            location.href = `http://localhost/Projet/views/Backoffice/ListEvent.php?removeEvent=${id}`
        }
        const updateEvent = (id) => {
            location.href = `http://localhost/Projet/views/Backoffice/ListEvent.php?updateEvent=${id}`
        }
        const createTicket = (id) => {
            document.getElementById('idEventInput').value = id
        }
        const removeTicket = (id) => {
            location.href = `http://localhost/Projet/views/Backoffice/Evenement.php?removeTicket=${id}`
        }
        const updateTicket = (id) => {
            location.href = `http://localhost/Projet/views/Backoffice/Evenement.php?updateTicket=${id}#newTickets`
        }
    </script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

</body>

</html>