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


// if (isset($_POST["btntriT"]) && !empty($_POST["btntriT"])) {
//     $listTickets = $TicketC->trisTicket($_POST["triT"]);
// } else {
//     if (isset($_GET['searchticket']) && !empty($_GET['searchticket'])) {
//         $listTickets = $TicketC->searchTickets($_GET["searchticket"]);
//     } else {
//         $listTickets = $TicketC->displayTickets();
//     }
// }





// ticket

$updateTicket = NULL;

if (isset($_GET["removeTicket"]) && !empty($_GET["removeTicket"])) {
    $TicketC->deleteTicket($_GET["removeTicket"]);

    header('location:http://localhost/Projet/views/Backoffice/ListTicket.php');
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
    header('location:http://localhost/Projet/views/Backoffice/ListTicket.php');
}

if (isset($_GET["updateTicket"]) && !empty($_GET["updateTicket"])) {

    $updateTicket = $TicketC->getTicketById($_GET["updateTicket"]);
    // echo $updateTicket->getidTicket();
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
            display: flex;

            max-width: 100px;
            max-height: 100px;

        }

        .right {
            margin-left: 1350px;
            margin: 0;
            padding: 0;
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
            opacity: .85;
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
                        <a href="Recyclage.php" class="active">
                            <span class="material-symbols-outlined">
                                compost
                            </span>
                            <h3>Recyclage</h3>
                        </a>

                    </li>
                    <li>
                        <a href="#" class="">
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
                        <a href="ListTicket.php" class="active">
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
            <h1>Tickets list</h1>
            <br>
            <!-- *************************Ticket ************************ -->


            <form action="" method="GET">
                <input type="text" name="searchticket" id="searchticket" placeholder="Enter Ticket id">
                <input type="submit" value="search" name="btnsearchT">
            </form>

            </br>

            <br>


            <div class="recent-orders">
                <div class="afficheTab2">
                    <table border="1" id="">
                        <thead>
                            <th col-index=1>id Ticket</th>

                            <th col-index=2>id Event </br>
                                <select class="table-filter" onchange="filter_rows()">
                                    <option value="all"></option>
                                </select>
                            </th>
                            <th col-index=2>Event name</br>
                                <select class="table-filter" onchange="filter_rows()">
                                    <option value="all"></option>
                                </select>
                            </th>

                            <th col-index=3>Date </br>
                                <select class="table-filter" onchange="filter_rows()">
                                    <option value="all"></option>
                            </th>

                            <th col-index=4>Price</br>
                                <select class="table-filter" onchange="filter_rows()">
                                    <option value="all"></option>
                                </select>
                            </th>
                            <th col-index=4>sold</br>
                                <select class="table-filter" onchange="filter_rows()">
                                    <option value="all"></option>
                                </select>
                            </th>
                            <th col-index=4>code</br>
                                <select class="table-filter" onchange="filter_rows()">
                                    <option value="all"></option>
                                </select>
                            </th>
                            <th col-index=4>detail</br>
                                <select class="table-filter" onchange="filter_rows()">
                                    <option value="all"></option>
                                </select>
                            </th>
                            <th col-index=4>action</br>
                                <select class="table-filter" onchange="filter_rows()">
                                    <option value="all"></option>
                                </select>
                            </th>



                        </thead>

                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($listTickets); $i++) {
                            ?>
                                <tr>
                                    <td><?= $listTickets[$i]["idTicket"]; ?></td>
                                    <td><?= $listTickets[$i]["idEvent"]; ?></td>
                                    <td><?= $TicketC->getEventNameFromTicket($listTickets[$i]["idTicket"]); ?></td>
                                    <td><?= $listTickets[$i]["dateTicketExp"]; ?></td>
                                    <td><?= $TicketC->getEventPriceFromTicket($listTickets[$i]["idTicket"]) ? $TicketC->getEventPriceFromTicket($listTickets[$i]["idTicket"]) . "DT" : "free"; ?></td>
                                    <td><?= $listTickets[$i]["vendu"] ? "Yes" : "No"; ?></td>
                                    <td><img src="../balkis/qrcode/<?= $listTickets[$i]["codeTicket"] ?>.png"></td>
                                    <td><?= $listTickets[$i]["detailTicket"]; ?></td>
                                    <td>

                                        <button class="danger" onclick="removeTicket(<?= $listTickets[$i]['idTicket']; ?>)">Supprimer</button></br>
                                        <button class="primary" onclick="updateTicket(<?= $listTickets[$i]['idTicket']; ?>)">Update</button>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

    </main>


    </div>

    <script src="../balkis/js/controle_saisie.js"></script>

    <script src="../balkis/js/filter.js"></script>
    <script>
        // crud

        const removeTicket = (id) => {
            location.href = `http://localhost/Projet/views/Backoffice/ListTicket.php?removeTicket=${id}`
        }
        const updateTicket = (id) => {
            location.href = `http://localhost/Projet/views/Backoffice/AddTicket.php?updateTicket=${id}`
        }
    </script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

</body>

</html>