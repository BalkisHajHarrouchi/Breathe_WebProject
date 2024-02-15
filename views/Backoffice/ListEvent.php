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
    header('location:http://localhost/Projet/views/Backoffice/ListEvent.php');
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
    header('location:http://localhost/Projet/views/Backoffice/ListEvent.php#newTickets');
}

if (isset($_GET["updateTicket"]) && !empty($_GET["updateTicket"])) {

    $updateTicket = $TicketC->getTicketById($_GET["updateTicket"]);
    // echo $updateTicket->getidTicket();
}



// Set the number of results to show per page
$resultsPerPage = 5;

// Count the total number of rows in the table
$sql = "SELECT COUNT(*) as total FROM events";
$db = config::getConnection();
$stmt = $db->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$totalResults = $row['total'];

// Determine the total number of pages
$totalPages = ceil($totalResults / $resultsPerPage);

// Get the current page number
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset
$offset = ($currentPage - 1) * $resultsPerPage;

// Query the database for the current page of results
$stmt = $db->prepare('SELECT * FROM events LIMIT :offset, :resultsPerPage');
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':resultsPerPage', $resultsPerPage, PDO::PARAM_INT);
$stmt->execute();






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

        #myTable {
            margin-left: 350px;
            max-width: 1200px;
        }

        .qrscanner {
            margin-right: -200px;
            margin-left: 180px;
            max-width: 100px;
            max-height: 100px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            margin-bottom: 20px;
            margin-left: 100px;
        }

        .pagination-links {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .pagination a {
            display: inline-block;
            margin: 0 5px;
            padding: 8px 16px;
            border: 1px solid #ddd;
            background-color: #f1f1f1;
            color: #666;
            text-decoration: none;
            border-radius: 10px;
        }

        .pagination a.active {
            background-color: #626440;
            color: white;
            border: 1px solid #626440;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
            color: #444;
            border: 1px solid #ddd;
        }

        .cudBox2 {
            position: relative;
            /*couleur du groupe box*/
            padding: 20px;
            /* width: 120%; */
            /* group box largeur // */
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            max-width: 600px;
            min-height: 400px;
            background: #fff;
            align-items: center;
            margin-right: -60px;
            margin-left: 100px;
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

        .sidebarEv .active {
            color: #82E0AA;
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

            <h1>Liste des Events</h1>
            <br>
            <div class="">
                <div class="cudBox2">
                    <div class="containerCalendar">
                        <div id="calendar">
                        </div>
                    </div>
                </div>

                <div class="tableEvent">
                    <div class="affiche">
                        <form method="post" action="" class="sort-form">
                            <select name="tri" id="tri">
                                <option value="">Defaut</option>
                                <option value="nom">Event name</option>
                                <option value="lieu" <?php $tri_choi = "lieu"; ?>>Location</option>
                                <option value="type" <?php $tri_choi = "type"; ?>>type</option>
                                <option value="dateEventStart" <?php $tri_choi = "dateEventStart"; ?>>Start date</option>
                                <option value="dateEventEnd" <?php $tri_choi = "dateEventEnd"; ?>>End date</option>
                            </select>
                            <input type="submit" name="btntri" value="Trier" class="sortbtn">
                        </form>
                    </div>

                    </br>
                    <form action="" method="GET">
                        <input type="text" name="searchname" id="searchname" placeholder="Enter Event name">
                        <input type="submit" value="search">
                    </form>
                    </br>

                    <div class="recent-orders">
                        <div class="afficheTab">
                            <table border="1" id="myTable">

                                <thead>
                                    <th col-index=1>id Event</th>
                                    <th col-index=2>Name </th>
                                    <th col-index=3>Type</th>
                                    <th col-index=4>Location</th>
                                    <th col-index=5>Start Date</th>
                                    <th col-index=6>End Date</th>
                                    <th col-index=7>Description</th>
                                    <th col-index=8>Places</th>
                                    <th col-index=9>Event price</th>
                                    <th col-index=10>Action</th>
                                    <th col-index=11>Add Tickets</th>
                                </thead>

                                <tbody>
                                    <?php
                                    $rowNum = ($currentPage - 1) * $resultsPerPage + 1;
                                    echo ("<br>");

                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['idEvent']); ?></td>
                                            <td><?= htmlspecialchars($row['nom']); ?></td>
                                            <td><?= htmlspecialchars($row['type']); ?></td>
                                            <td><?= htmlspecialchars($row["lieu"]); ?></td>
                                            <td><?= htmlspecialchars($row["dateEventStart"]); ?></td>
                                            <td><?= htmlspecialchars($row["dateEventEnd"]); ?></td>
                                            <td><?= htmlspecialchars($row["description"]); ?></td>
                                            <td><?= htmlspecialchars($row["nbPlaces"]); ?></td>
                                            <td><?= htmlspecialchars($row["prixEvent"]); ?></td>
                                            <td>
                                                <button class="danger" onclick="removeEvent(<?= htmlspecialchars($row['idEvent']); ?>)">Supprimer</button></br>
                                                <button class="success" onclick="updateEvent(<?= htmlspecialchars($row['idEvent']); ?>)">Update</button>
                                            </td>
                                            <td>
                                                <a href="AddTicket.php?addTicket=<?= htmlspecialchars($row['idEvent']); ?>"><button class="primary">Add</button></a>
                                            </td>

                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <?php
            // Generate pagination links
            echo '<div class="pagination" >';
            echo '<div class="pagination-links" style="display: flex; justify-content: center; align-items: center;">';

            for ($page = 1; $page <= $totalPages; $page++) {
                echo '<a ';
                if ($currentPage == $page) {
                    echo 'class="active" ';
                }
                echo 'href="ListEvent.php?page=' . $page . '">' . $page . '</a>';
            }
            echo '</div>';
            echo '</div>';
            ?>
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
            location.href = `http://localhost/Projet/views/Backoffice/AddEvent.php?updateEvent=${id}`
        }
        // const createTicket = (id) => {
        //     location.href = `http://localhost/Projet/views/Backoffice/AddTicket.php?addTicket=${id}`
        // }
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
    <script>
        $(document).ready(function() {
            var calendar = $("#calendar").fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: 'loadCalendar.php',
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt("enter event title");
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: 'insertCalendar.php',
                            type: 'POST',
                            data: {
                                title: title,
                                start: start,
                                end: end
                            },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert("added successfully");
                            }
                        })

                    }
                },
                eventClick: function(event) {
                    if (confirm("Are you sure you want to remove it?")) {
                        var id = event.id;
                        $.ajax({
                            url: 'deleteCalendar.php',
                            method: 'POST',
                            data: {
                                id: id
                            },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert("deleted successfully");
                            }
                        })
                    }
                },
                eventResize: function(event) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: 'updateCalendar.php',
                        method: 'POST',
                        data: {
                            start: start,
                            end: end,
                            id: id
                        },
                        success: function(data) {
                            calendar.fullCalendar('refetchEvents');
                            alert("updated successfully");

                        }

                    })
                },
                eventColor: '#6B8E23',
                eventDrop: function(event, start, end) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: 'updateCalendar.php',
                        method: 'POST',
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            id: id
                        },
                        success: function(data) {
                            calendar.fullCalendar('refetchEvents');
                            alert("updated successfully");
                        }
                    })
                }



            })
        })
    </script>
</body>

</html>