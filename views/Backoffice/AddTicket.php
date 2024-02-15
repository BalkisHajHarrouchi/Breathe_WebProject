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

// display tickets



// ticket



$updateTicket = NULL;

if (isset($_POST["btncrudT"]) && !empty($_POST["btncrudT"])) {
    if (isset($_GET["updateTicket"]) && !empty($_GET["updateTicket"])) {
        $EventName = $eventC->getEventById($_GET["addTicket"])['nom'];
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
        $TicketC->updateTicket($ticket);
    } else {
        $EventName = $eventC->getEventById($_GET["addTicket"])['nom'];
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
    header('location:http://localhost/Projet/views/Backoffice/ListTicket.php');
}

if (isset($_GET["updateTicket"]) && !empty($_GET["updateTicket"])) {
    echo $_GET["updateTicket"];
    $updateTicket = $TicketC->getTicketById($_GET["updateTicket"]);
    var_dump($updateTicket);
}

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
            margin-left: 120px;
            max-width: 80px;
            max-height: 80px;
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



        .crudBox2 {
            margin-left: 300px;
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
                        <a href="Produits.php">
                            <span class="material-symbols-outlined">
                                shopping_cart_checkout
                            </span>
                            <h3>Produits</h3>
                        </a>
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
                        <a href="Evenement.php" class="active">
                            <span class="material-symbols-sharp">
                                event
                            </span>
                            <h3>Evenement</h3>
                            <span class="message-count">26</span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="Evenement.php" class="active">
                                    <span class="material-symbols-sharp">
                                        event
                                    </span>
                                    <h3>Evenement</h3>
                                    <span class="message-count">26</span>
                                </a>
                            </li>
                            <li>
                                <a href="Evenement.php" class="active">
                                    <span class="material-symbols-sharp">
                                        event
                                    </span>
                                    <h3>Evenement</h3>
                                    <span class="message-count">26</span>
                                </a>
                            </li>
                        </ul>

                    </li>
                    <li>
                        <a href="Blog.php">
                            <span class="material-symbols-sharp">
                                article
                            </span>
                            <h3>Blogs</h3>
                        </a>
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
            <!-- *************************Ticket ************************ -->

            </br>

            <br>
            <div class="crudBox2" id="newTickets">
                <h1><?= ($updateTicket === NULL) ? 'Ajouter Ticket' : 'Update Ticket' ?></h1></br>
                <div class="cudBox2">
                    <form method="POST" action="AddTicket.php<?= ($updateTicket !== NULL) ? "?updateTicket=" . $updateTicket["idTicket"] : ""; ?>">
                        <div class="form">
                            <input type="text" value="<?= ($updateTicket !== NULL) ? $updateTicket["idEvent"] : $_GET['addTicket']; ?>" name="idEvent" id="idEventInput" placeholder=" " autocomplete="off" class="form__input" oninput="checkIdEvent(this)"><br /><br />
                        </div>
                        <span id="idEvent"></span>
                        </br>
                        </br>
                        <div class="form">
                            <input type="date" value="<?= ($updateTicket !== NULL) ? $updateTicket["dateTicketExp"] : ""; ?>" name="dateTicketExp" id="" autocomplete="off" class="form__input"><br /><br />
                            <label for="dateTicketExp" class="form__label">Expiration date</label>
                        </div>
                        <span id="dateTicketExp"></span>
                        </br>
                        </br>

                        <div class="form">
                            <input type="text" value="<?= ($updateTicket !== NULL) ? $updateTicket["detailTicket"] : ""; ?>" name="detailTicket" placeholder=" " autocomplete="off" class="form__input" oninput="checkDetailTicket(this)"><br /><br />
                            <label for="idEvent" class="form__label">Ticket details</label>
                        </div>
                        <span id="detailTicket"></span>


                        <div class="ticketbuttons">
                            <input type="submit" class="submitBtnT" name="btncrudT" value="<?= ($updateTicket === NULL) ? 'Ajouter Ticket' : 'Update Ticket' ?>" />
                            </br>
                            </br>
                            <input type="reset" value="cancel" id="resetBtnT">
                        </div>
                    </form>

                </div>

            </div>
        </main>

    </div>

    <script src="../balkis/js/controle_saisie.js"></script>

    <script>
        // crud

        const createTicket = (id) => {
            location.href = `http://localhost/Projet/views/Backoffice/AddTicket.php?idEvent=${id}`
        }
        const removeTicket = (id) => {
            location.href = `http://localhost/Projet/views/Backoffice/ListTicket.php?removeTicket=${id}`
        }
        const updateTicket = (id) => {
            location.href = `http://localhost/Projet/views/Backoffice/AddTicket.php?updateTicket=${id}#newTickets`
        }
    </script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

</body>

</html>