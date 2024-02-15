<?php
require "../../controllers/recyC.php";
require "../../models/recy.php";
require "../../controllers/categRC.php";
require "../../models/categR.php";
$recyC = new recyC();
$listEvents = $recyC->displayEventsB();
$updateEvent = NULL;



if (isset($_GET["removeEvent"]) && !empty($_GET["removeEvent"])) {
    $recyC->deleteEventB($_GET["removeEvent"]);
    header('location:http://localhost/Projet/views/Backoffice/recyclage.php');
}

if (isset($_POST["btncrud"]) && !empty($_POST["btncrud"])) {
    if (isset($_GET["updateEvent"]) && !empty($_GET["updateEvent"])) {
        $recy = new recy($_POST["idCateg_re"], $_POST["type"], $_POST["quantite"], $_POST["email"], new \DateTime($_POST["date_recy"]));
        $recyC->updateEventB($_GET["updateEvent"], $recy);
    } else {
        $recy = new recy($_POST["idCateg_re"], $_POST["type"], $_POST["quantite"], $_POST["email"], new \DateTime($_POST["date_recy"]));
        $recyC->addEventB($recy);
    }
    header('location: http://localhost/Projet/views/Backoffice/recyclage.php');
}

if (isset($_GET["updateEvent"]) && !empty($_GET["updateEvent"])) {
    $updateEvent = $recyC->getEventByIdB($_GET["updateEvent"]);
}



$categRC = new categRC();
$listcategRs = $categRC->displaycategRs();
$updatecategR = NULL;

if (isset($_GET["removecategR"]) && !empty($_GET["removecategR"])) {
    $categRC->deletecategR($_GET["removecategR"]);
    header('location:http://localhost/Projet/views/Backoffice/recyclage.php');
}

if (isset($_POST["btncrud1"]) && !empty($_POST["btncrud1"])) {
    if (isset($_GET["updatecategR"]) && !empty($_GET["updatecategR"])) {
        $categR = new categR($_POST["nomCateg"], $_POST["description"], $_POST["nbr_demande"], $_POST["image"]);
        $categRC->updatecategR($_GET["updatecategR"], $categR);
    } else {
        $categR = new categR($_POST["nomCateg"], $_POST["description"], $_POST["nbr_demande"], $_POST["image"]);
        $categRC->addcategR($categR);
    }
    header('location: http://localhost/Projet/views/Backoffice/recyclage.php');
}

if (isset($_GET["updatecategR"]) && !empty($_GET["updatecategR"])) {
    $updatecategR = $categRC->getcategRById($_GET["updatecategR"]);
}

//bar chart

$db = config::getConnection();

$q1 = $db->query("SELECT * FROM categrecyclages WHERE 4>=nbr_demande");
$q1->execute();
$c1 = count($q1->fetchAll());

$q2 = $db->query("SELECT * FROM categrecyclages WHERE nbr_demande between 5 and 7");
$q2->execute();
$c2 = count($q2->fetchAll());

$q3 = $db->query("SELECT * FROM categrecyclages WHERE nbr_demande between 8 and 10");
$q3->execute();
$c3 = count($q3->fetchAll());


$q4 = $db->query("SELECT * FROM categrecyclages WHERE nbr_demande between 11 and 15");
$q4->execute();
$c4 = count($q4->fetchAll());

$q5 = $db->query("SELECT * FROM categrecyclages WHERE nbr_demande>15");
$q5->execute();
$c5 = count($q5->fetchAll());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Try</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+icons+sharp">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.js"></script>
    <!-- <link rel="stylesheet" href="crud.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+icons+sharp">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<style>
    input {
        background-color: #e9e9e9;
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
            <div class="insights">
                <div class="sales">
                    <span class="material-symbols-sharp">
                        ADD
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h1>
                                <?= ($updateEvent === NULL) ? 'Update demande recyclage' : 'Update demande recyclage' ?>
                            </h1></br>
                            <div class="cudBox">
                                <form method="POST" action="recyclage.php<?= ($updateEvent !== NULL) ? "?updateEvent=" . $updateEvent["id_recy"] : ""; ?>" onsubmit="return validate(this)">
                                    <div class="form">

                                        <label for="idCateg_re" class="form__label">idCateg_re</label>
                                        <input type="text" value="<?= ($updateEvent !== NULL) ? $updateEvent["idCateg_re"] : ""; ?>" name="idCateg_re" placeholder=" " autocomplete="off" class="form__input"><br /><br />

                                        <span id="idCateg_re"></span>
                                        </br>
                                        </br>
                                        <label for="email" class="form__label">email</label>
                                        <input type="text" value="<?= ($updateEvent !== NULL) ? $updateEvent["email"] : ""; ?>" name="email" placeholder=" " autocomplete="off" class="form__input" oninput="checkEmail(this)"><br /><br />
                                    </div>
                                    <span id="email"></span>
                                    </br>
                                    </br>
                                    <select name="type" id="selectType" class="selectType">
                                        <option value="">-- Sélectionnez le type --</option>
                                        <option value="Fer" <?php if (($updateEvent !== NULL) && ($updateEvent["type"] === "Fer"))
                                                                echo "selected"; ?>>Fer</option>
                                        <option value="Acier" <?php if (($updateEvent !== NULL) && ($updateEvent["type"] === "Acier"))
                                                                    echo "selected"; ?>>Acier</option>
                                        <option value="Plastique" <?php if (($updateEvent !== NULL) && ($updateEvent["type"] === "Plastique"))
                                                                        echo "selected"; ?>>Plastique</option>
                                        <option value="Pile" <?php if (($updateEvent !== NULL) && ($updateEvent["type"] === "Pile"))
                                                                    echo "selected"; ?>>Pile</option>
                                        <option value="Cigarette" <?php if (($updateEvent !== NULL) && ($updateEvent["type"] === "Cigarette"))
                                                                        echo "selected"; ?>>Cigarette</option>
                                        <option value="Verre" <?php if (($updateEvent !== NULL) && ($updateEvent["type"] === "Verre"))
                                                                    echo "selected"; ?>>Verre</option>
                                    </select>
                                    <span id="type"></span>
                                    </br>
                                    </br>
                                    </br>
                                    <div class="form">
                                        <label for="date_recy" class="form__label">date_recy</label>
                                        <input type="datetime-local" name="date_recy" value="<?= ($updateEvent !== NULL) ? date('Y-m-d\TH:i:s', strtotime($updateEvent["date_recy"])) : ''; ?>" id="date_recy" class="form__input" autocomplete="off">
                                    </div>
                                    <!-- <span id="date_recy"></span> -->
                                    </br>
                                    </br>

                                    <div class="form">
                                        <label for="quantite" class="form__label">quantite</label>
                                        <input type="number" value="<?= ($updateEvent !== NULL) ? $updateEvent["quantite"] : ""; ?>" name="quantite" id="" placeholder=" " autocomplete="off" class="form__input" oninput="checkQuantite(this)"><br /><br />
                                    </div>
                                    <span id="quantite"></span>
                                    </br>
                                    </br>
                                    <input type="submit" class="submitBtn" name="btncrud" value="<?= ($updateEvent === NULL) ? 'Update demande recyclage' : 'Update demande recyclage' ?>" />
                                    </br>
                                    </br>
                                    <input type="reset" value="cancel" id="resetBtn">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!----- end of sales -->
                <div class="sales">
                    <span class="material-symbols-sharp">
                        ADD
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h1>
                                <?= ($updatecategR === NULL) ? 'Ajoute categorie' : 'Update categorie' ?>
                            </h1></br>
                            <div class="cudBox">
                                <form method="POST" action="recyclage.php<?= ($updatecategR !== NULL) ? "?updatecategR=" . $updatecategR["idCateg_re"] : ""; ?>" onsubmit="return validate1(this)">
                                    <div class="form">
                                        <label for="nomCateg" class="form__label">nomCateg</label>
                                        <input type="text" value="<?= ($updatecategR !== NULL) ? $updatecategR["nomCateg"] : ""; ?>" name="nomCateg" placeholder=" " autocomplete="off" class="form__input"><br /><br />
                                    </div>
                                    <span id="nomCateg"></span>

                                    </br>
                                    </br>

                                    <label for="description" class="form__label">description</label>
                                    <input type="text" value="<?= ($updatecategR !== NULL) ? $updatecategR["description"] : ""; ?>" name="description" placeholder=" " autocomplete="off" class="form__input"><br /><br />
                            </div>
                            <span id="description"></span>

                            </br>
                            </br>

                            <div class="form">
                                <label for="image" class="form__label">image</label>
                                <input type="file" id="image" name="image" value="<?= ($updatecategR !== NULL) ? $updatecategR["image"] : ""; ?>" />
                            </div>
                            <!-- <span id="date_recy"></span> -->

                            </br>
                            </br>

                            <div class="form">
                                <label for="nbr_demande" class="form__label">nbr_demande</label>
                                <input type="number" value="<?= ($updatecategR !== NULL) ? $updatecategR["nbr_demande"] : ""; ?>" name="nbr_demande" id="" placeholder=" " autocomplete="off" class="form__input" oninput="checknbr_demande(this)"> <br /><br />
                            </div>
                            <span id="nbr_demande"></span>

                            </br>
                            </br>

                            <input type="submit" class="submitBtn" name="btncrud1" value="<?= ($updatecategR === NULL) ? 'Ajouter categorie' : 'Update categorie' ?>" />

                            </br>
                            </br>

                            <input type="reset" value="cancel" id="resetBtn">
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            </br>
            </br>
            <input type="hidden" id="c1" value="<? htmlspecialchars_decode($rows) ?>">
            <!--Add charts -->
            <div class="graphBox">
                <div class="box">
                    <canvas id="barCharta"></canvas>
                </div>
            </div>

            </br>
            </br>

            <h2>Send mail</h2>


            <form class="" action="sendR.php" method="post">
                email <input type="email" name="email" value=""> </br>
                <button type="submit" name="accepter">accepter</button></br>
                <button type="submit" name="refuser">refuser</button></br>
            </form>


            </br>
            </br>


            <button id="download-button" onclick="convertToPDF()" class="btn btn-info">Download as PDF</button>

            </br>
            </br>


            <div class="crudBox">

                </br>
                <div class="rbox">

                    <h1>Liste des demandes recyclage</h1>

                    <div class="outer-wrapper" id="aboubaker1">
                        <div class="table-wrapper">
                            <table border="1" id="aboubaker">
                                <thead>

                                    <th col-index=1> id_recy </br>
                                        <select class="table-filter" onchange="filter_rows()">
                                            <option value="all"></option>
                                        </select>
                                    </th>

                                    <th col-index=2> idCateg_re </br>
                                        <select class="table-filter" onchange="filter_rows()">
                                            <option value="all"></option>
                                        </select>
                                    </th>

                                    <th col-index=3> type </br>
                                        <select class="table-filter" onchange="filter_rows()">
                                            <option value="all"></option>
                                        </select>
                                    </th>

                                    <th col-index=4> quantite </br>
                                        <select class="table-filter" onchange="filter_rows()">
                                            <option value="all"></option>
                                    </th>

                                    <th col-index=5> email </br>
                                        <select class="table-filter" onchange="filter_rows()">
                                            <option value="all"></option>
                                        </select>
                                    </th>

                                    <th col-index=6> nomCateg </br>
                                        <select class="table-filter" onchange="filter_rows()">
                                            <option value="all"></option>
                                        </select>

                                    <th col-index=7> date_recy </br>
                                        <select class="table-filter" onchange="filter_rows()">
                                            <option value="all"></option>
                                        </select>

                                    </th>
                                    <th col-index=8> description</br>
                                        <select class="table-filter" onchange="filter_rows()">
                                            <option value="all"></option>
                                        </select>
                                    </th>

                                    <th col-index=9> nbr_demande</br>
                                        <select class="table-filter" onchange="filter_rows()">
                                            <option value="all"></option>
                                        </select>
                                    </th>

                                    <th col-index=10> action </br>
                                        <select class="table-filter" onchange="filter_rows()">
                                            <option value="all"></option>
                                        </select>
                                    </th>



                                </thead>

                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($listEvents); $i++) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?= $listEvents[$i]["id_recy"]; ?>
                                            </td>
                                            <td>
                                                <?= $listEvents[$i]["idCateg_re"]; ?>
                                            </td>
                                            <td>
                                                <?= $listEvents[$i]["type"]; ?>
                                            </td>
                                            <td>
                                                <?= $listEvents[$i]["quantite"]; ?>
                                            </td>
                                            <td>
                                                <?= $listEvents[$i]["email"]; ?>
                                            </td>
                                            <td>
                                                <?= $recyC->getCategNameFromDRB($listEvents[$i]["id_recy"]); ?>
                                            </td>
                                            <td>
                                                <?= $listEvents[$i]["date_recy"]; ?>
                                            </td>
                                            <td>
                                                <?= $recyC->getCategDescriptionFromDRB($listEvents[$i]["id_recy"]); ?>
                                            </td>
                                            <td>
                                                <?= $recyC->getCategNBRDFromDRB($listEvents[$i]["id_recy"]); ?>
                                            </td>


                                            <td>

                                                <button class="danger" onclick="removeEvent(<?= $listEvents[$i]['id_recy']; ?>)">Supprimer</button></br>
                                                <button class="primary" onclick="updateEvent(<?= $listEvents[$i]['id_recy']; ?>)">Update</button></br>

                                                <!-- <button type="submit" name="accepter">accepter</button></br>

                                                <button type="submit" name="refuser">refuser</button></br> -->

                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function convertToPDF() {
                    var doc = new jsPDF();
                    doc.setFontSize(14);
                    var currentDate = new Date();
                    var formattedDate = currentDate.getDate() + "/" + (currentDate.getMonth() + 1) + "/" + currentDate.getFullYear();
                    doc.text("Liste des demande :                                                                " + formattedDate, 20, 20);

                    doc.autoTable({
                        html: '#aboubaker',
                        startY: 40,
                        styles: {
                            cellPadding: 1,
                            fontSize: 10,
                        }
                    });
                    doc.save("Liste des demande.pdf");
                }
            </script>
            <!-- <script>
                const button = document.getElementById('download-button');

                function generatePDF() {
                    // Choose the element that your content will be rendered to.
                    const element = document.getElementById('aboubaker1');/// invoice id de tableau
                    // Choose the element and save the PDF for your user.
                    html2pdf().from(element).save();
                }

                button.addEventListener('click', generatePDF);
            </script> -->

            <div class="crudBox">

                </br>
                <div class="rbox">

                    <h1>Liste des categorie</h1>

                    <div class="outer-wrapper">
                        <div class="table-wrapper">
                            <table border="1" id="myTable">
                                <thead>
                                    <th col-index=1>idCateg_re</th>

                                    <th col-index=2>nomCateg
                                    </th>

                                    <th col-index=3>description
                                    </th>

                                    <th col-index=4>nbr_demande
                                    </th>

                                    <th col-index=5>image
                                    </th>

                                    <th col-index=6>Action
                                    </th>
                                </thead>

                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($listcategRs); $i++) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?= $listcategRs[$i]["idCateg_re"]; ?>
                                            </td>
                                            <td>
                                                <?= $listcategRs[$i]["nomCateg"]; ?>
                                            </td>
                                            <td>
                                                <?= $listcategRs[$i]["description"]; ?>
                                            </td>
                                            <td>
                                                <?= $listcategRs[$i]["nbr_demande"]; ?>
                                            </td>
                                            <td>
                                                <img src="../assets/img/<?= $listcategRs[$i]["image"]; ?>">
                                            </td>
                                            <td>
                                                <button class="danger" onclick="removecategR(<?= $listcategRs[$i]['idCateg_re']; ?>)">Supprimer</button></br>
                                                <button class="primary" onclick="updatecategR(<?= $listcategRs[$i]['idCateg_re']; ?>)">Update</button>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </main>
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-symbols-sharp">
                        menu
                    </span>
                </button>
                <div class="theme-toggler">
                    <span class="material-symbols-sharp active">
                        light_mode
                    </span>
                    <span class="material-symbols-sharp">
                        dark_mode
                    </span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Bonjour, <b>Ahmed</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="./images/profile-1.jpg">
                    </div>
                </div>
            </div>
            <!---END OF TOP-->
            <div class="recent-updates">
                <h2>notification</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./images/profile-2.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./images/profile-3.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./images/profile-4.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                </div>
            </div>
            <!----END OF RECENT UPDATES-->
            <div class="sales-analytics">
                <h2>Sales Analytics</h2>
                <div class="item online">
                    <div class="icon">
                        <span class="material-symbols-sharp">
                            shopping_cart
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Commandes en ligne</h3>
                            <small class="text-muted">Dernières 24 heures</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item offline">
                    <div class="icon">
                        <span class="material-symbols-sharp">
                            local_mall
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Commandes hors ligne</h3>
                            <small class="text-muted">Dernières 24 heures</small>
                        </div>
                        <h5 class="danger">-17%</h5>
                        <h3>1100</h3>
                    </div>
                </div>
                <div class="item customers">
                    <div class="icon">
                        <span class="material-symbols-sharp">
                            person
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>nouveaux clients</h3>
                            <small class="text-muted">Dernières 24 heures</small>
                        </div>
                        <h5 class="success">+25%</h5>
                        <h3>849</h3>
                    </div>
                </div>
                <div class="item add-product">
                    <div>
                        <span class="material-symbols-sharp">
                            add
                        </span>
                        <h3>Ajouter un produit</h3>

                    </div>
                </div>
            </div>
        </div>
    </div>






    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <script src="../assets/js/CS.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script>
        /* bar chart*/
        var c1 = "<?php echo $c1; ?>";
        var c2 = "<?php echo $c2; ?>";
        var c3 = "<?php echo $c3; ?>";
        var c4 = "<?php echo $c4; ?>";
        var c5 = "<?php echo $c5; ?>";

        var ctx = document.getElementById('barCharta').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['4>=', 'between 5 and 7', 'between 8 and 10', ' between 11 and 15', '>15'],
                datasets: [{
                    label: 'Nombre de demande',
                    data: [c1, c2, c3, c4, c5],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.4)',
                        'rgba(54, 162, 235, 0.4)',
                        'rgba(255, 206, 86, 0.4)',
                        'rgba(75, 192, 192, 0.4)',
                        'rgba(153, 102, 255, 0.4)',
                        'rgba(255, 159, 64,0.4)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235,0.5)',
                        'rgba(255, 206, 86,0.5)',
                        'rgba(75, 192, 192,0.5)',
                        'rgba(153, 102, 255,0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        const removeEvent = (id) => {
            location.href = `http://localhost/Projet/views/Backoffice/recyclage.php?removeEvent=${id}`
        }
        const updateEvent = (id) => {
            location.href = `http://localhost/Projet/views/Backoffice/recyclage.php?updateEvent=${id}`
        }
        window.onload = () => {
            console.log(document.querySelector("#myTable > tbody > tr:nth-child(1) > td:nth-child(2) ")
                .innerHTML);
        };
    </script>

    <script src="../views/CS1.js"></script>
    <script>
        const removecategR = (id) => {
            location.href = `http://localhost/Projet/views/Backoffice/recyclage.php?removecategR=${id}`
        }
        const updatecategR = (id) => {
            location.href = `http://localhost/Projet/views/Backoffice/recyclage.php?updatecategR=${id}`
        }
        window.onload = () => {
            console.log(document.querySelector("#myTable > tbody > tr:nth-child(1) > td:nth-child(2) ")
                .innerHTML);
        };
    </script>
</body>

</html>