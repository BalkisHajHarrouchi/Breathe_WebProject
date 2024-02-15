<?php
require "../../config.php";
require "../../controllers/blogC.php";
require "../../models/blog.php";
require "../../controllers/commentC.php";
require "../../models/comment.php";
$blogC = new blogC();
$commentC = new commentC();
$listcmnts = $commentC->displaycmnts();
// $listblogs = $blogC->displayblogs();
if (isset($_POST["btntri"]) && !empty($_POST["btntri"])) {
    $listBlogs = $blogC->trisBlog($_POST["tri"]);
} else {
    if (isset($_GET['searchtitle']) && !empty($_GET['searchtitle'])) {
        $listBlogs = $blogC->searchBlogs($_GET["searchtitle"]);
    } else {
        $listBlogs = $blogC->displayBlogs();
    }
}


$updateblog = NULL;

if (isset($_GET["removeblog"]) && !empty($_GET["removeblog"])) {
    $blogC->deleteblog($_GET["removeblog"]);
    header('location: http://localhost/projet/views/Backoffice/ListBlog.php');
}

if (isset($_POST["btnajout"]) && !empty($_POST["btnajout"])) {
    if (isset($_GET["updateblog"]) && !empty($_GET["updateblog"])) {
        $blog = new blog($_POST["titre"], $_POST["source"], $_POST["contenu"], $_POST["categorie"], $_POST["image"]);
        $blogC->updateblog($_GET["updateblog"], $blog);
    } else {
        $blog = new blog($_POST["titre"], $_POST["source"], $_POST["contenu"], $_POST["categorie"], $_POST["image"]);
        $blogC->addblog($blog);
    }
    header('location: http://localhost/projet/views/Backoffice/addBlog.php');
}




if (isset($_GET["updateblog"]) && !empty($_GET["updateblog"])) {
    $updateblog = $blogC->getblogById($_GET["updateblog"]);
}



//pie chart
$db = config::getConnection();
$qb1 = $db->query("SELECT * FROM blogs WHERE categorie = 'ecology'");
$qb1->execute();
$cb1 = count($qb1->fetchAll());
$qb2 = $db->query("SELECT * FROM blogs WHERE categorie = 'garden'");
$qb2->execute();
$cb2 = count($qb2->fetchAll());
$qb3 = $db->query("SELECT * FROM blogs WHERE categorie = 'plants'");
$qb3->execute();
$cb3 = count($qb3->fetchAll());




$updatecmnt = NULL;

if (isset($_GET["removecmnt"]) && !empty($_GET["removecmnt"])) {
    $commentC->deletecmnt($_GET["removecmnt"]);
    header('location: http://localhost/projet/views/Backoffice/ListBlog.php');
}

if (isset($_POST["btnajoutcmnt"]) && !empty($_POST["btnajoutcmnt"])) {
    if (isset($_GET["updatecmnt"]) && !empty($_GET["updatecmnt"])) {
        $comment = new comment($_POST["idBlogcmnt"], $_POST["contenu"]);
        $commentC->updatecmnt($_GET["updatecmnt"], $comment);
    } else {
        $comment = new comment($_POST["idBlogcmnt"], $_POST["contenu"]);
        $commentC->addcmnt($comment);
    }
    header('location: http://localhost/projet/views/Backoffice/addBlog.php');
}

if (isset($_GET["updatecmnt"]) && !empty($_GET["updatecmnt"])) {
    $updatecmnt = $commentC->getcmntById($_GET["updatecmnt"]);
}



?>
<!-- ================pagination================ -->

<?php
// Set the number of results to show per page
$resultsPerPage = 2;

// Count the total number of rows in the table
$stmt = $conn->query('SELECT COUNT(*) as total FROM blogs');
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$totalResults = $row['total'];

// Determine the total number of pages
$totalPages = ceil($totalResults / $resultsPerPage);

// Get the current page number
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset
$offset = ($currentPage - 1) * $resultsPerPage;

// Query the database for the current page of results
$stmt = $conn->prepare('SELECT * FROM blogs LIMIT :offset, :resultsPerPage');
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+icons+sharp">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- *******************new***************** -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/zeineb.css" />
    <link rel="stylesheet" href="../assets/css/styleblog.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
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
            margin-left: 90px;
        }

        .cudBox {
            min-width: 650px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
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
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
            color: #444;
            border: 1px solid #ddd;
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

        .logo {
            margin-left: -160px;
        }

        ul {
            margin-left: -140px;
        }

        #myTable {
            margin-left: 50px;
            min-width: 900px;
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
                        <a href="#" class="active">
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


            <h1><?= ($updateblog === NULL) ? 'Add Blog' : 'Update Blog' ?></h1></br>
            <div class="cudBox">

                <br>
                <br>

                <form method="POST" action="addBlog.php<?= ($updateblog !== NULL) ? "?updateblog=" . $updateblog["idBlog"] : ""; ?>">



                    <div class="form">
                        <input type="text" value="<?= ($updateblog !== NULL) ? $updateblog["titre"] : ""; ?>" name="titre" placeholder=" " autocomplete="off" class="form__input" onkeydown="checkTitre(this)"><br /><br />
                        <label for="titre" class="form__label">titre</label>

                    </div>
                    <span id="titre"></span>
                    <br>
                    <br>

                    <div class="form">
                        <input type="text" value="<?= ($updateblog !== NULL) ? $updateblog["source"] : ""; ?>" name="source" placeholder=" " autocomplete="off" class="form__input" onkeydown="checkSource(this)"><br /><br />
                        <label for="source" class="form__label">source</label>

                    </div>
                    <span id="source"></span>
                    <br>
                    <br>

                    <div class="form">
                        <textarea name="contenu" placeholder=" " id="" cols="35" rows="10" autocomplete="off" class="form__input" onkeydown="checkContenu(this)">
                <?= ($updateblog !== NULL) ? $updateblog["contenu"] : ""; ?></textarea><br /><br />
                        <label for="contenu" class="form__label">contenu</label>
                    </div>
                    <br>
                    <br>
                    <span id="contenu"></span>
                    <br>
                    <br>
                    <br>
                    <br>

                    <select name="categorie" id="Categorie" onclick="checkCategorie(this)" class="selectCategorie">
                        <option value="">-- Sélectionnez le type --</option>
                        <option value="plants" <?php if (($updateblog !== NULL) && ($updateblog["categorie"] === "plants")) echo "selected"; ?>>
                            plants</option>
                        <option value="garden" <?php if (($updateblog !== NULL) && ($updateblog["categorie"] === "garden")) echo "selected"; ?>>
                            garden</option>
                        <option value="ecology" <?php if (($updateblog !== NULL) && ($updateblog["categorie"] === "ecology")) echo "selected"; ?>>
                            ecology</option>

                    </select>
                    <span id="categ"></span>
                    <br>
                    <br>

                    <div class="form">
                        <input type="file" id="image" name="image" value="<?= ($updateEvent !== NULL) ? $updateEvent["image"] : ""; ?>" />
                    </div>

                    <br>
                    <br>
                    <input type="submit" name="btnajout" class="submitBtn" value="<?= ($updateblog === NULL) ? 'Ajouter blog' : 'Update blog' ?>" />
                    <br>
                    <br>
                    <input type="reset" class="resBtn" id="resetBtn" value="cancel" />
                </form>
            </div>

            <br>
            <br>
            <br>


        </main>


    </div>

    <script src="../assets/js/controle_saisie.js"></script>
    <script src="../assets/js/index.js"></script>


    <script>
        // crud
        const removeblog = (id) => {
            location.href =
                `http://localhost/projet/views/backoffice/ListBlog.php?removeblog=${id}`
        }
        const updateblog = (id) => {
            location.href =
                `http://localhost/projet/views/backoffice/ListBlog.php?updateblog=${id}`
        }
        const removecmnt = (id) => {
            location.href =
                `http://localhost/projet/views/backoffice/ListCmnt.php?removecmnt=${id}`
        }
        const updatecmnt = (id) => {
            location.href =
                `http://localhost/projet/views/backoffice/ListCmnt.php?updatecmnt=${id}`
        }

        // ************filter***********

        window.onload = () => {
            console.log(document.querySelector("#myTable > tbody > tr:nth-child(1) > td:nth-child(2) ")
                .innerHTML);
        };

        getUniqueValuesFromColumn()
    </script>

</body>

</html>