<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Breath</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .dropdown:hover .dropdown-content {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
            transition: all 0.3s ease;
        }


        .dropdown-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .dropdown:hover .dropdown-content {
            max-height: 300px;
            /* Or any height that fits your content */
            transition: max-height 0.3s ease-in;
        }


        .show {
            display: block;
        }


        .dropdown:hover .nav__link {
            background-color: #f1f1f1;
        }

        .nav__item:not(:last-child) {
            margin-right: 10px;
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
                        <a href="#" class="active">
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





            <!----- end of expenses -->
            <div class="income">
                <!-- <span class="material-symbols-sharp">
                                stacked_line_chart
                                </span> -->
                <div class="middle">
                    <div class="left">

                        <!----- end of insights -->
                        <div class="recent-orders">
                            <div class="search">
                                <input id="search" type="text" placeholder="Rechercher...">
                                <button><i class="fa fa-search"></i></button>
                            </div>
                            <div id="result_search">
                                <table>
                                    <thead>
                                        <tr>

                                            <th>Nom de produit</th>
                                            <th>Type de produit</th>
                                            <th>Prix</th>
                                            <th>Stock</th>
                                            <th>Code_Barre</th>
                                            <th>Status de produit</th>
                                            <th>Delete</th>
                                            <th>update</th>



                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        include('../../controllers/produitsC.php');
                                        $produitC = new produitsC();
                                        $list = $produitC->afficherproduit();
                                        foreach ($list as $pr) {
                                        ?>

                                            <tr>

                                                <td>
                                                    <?= $pr['nomproduit'] ?>
                                                </td>
                                                <td>
                                                    <?= $pr['typeprod'] ?>
                                                </td>
                                                <td id='prix<?= $pr['idProduit'] ?>'><?= $pr['prix'] ?></td>
                                                <td>
                                                    <?= $pr['stock'] ?>
                                                </td>
                                                <td>
                                                    <?= $pr['codeBarre'] ?>
                                                </td>
                                                <td>
                                                    <?= $pr['status'] ?>
                                                </td>
                                                <td><a href="deleteproduct.php?idProduit=<?= $pr['idProduit'] ?>"><i class="fas fa-trash"></i></a></td>
                                                <td><a href="updateproduct.php?idProduit=<?= $pr['idProduit'] ?>"><i class="fas fa-sync-alt"></i></a></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <a href="#">Show All</a>


                            <div id="result_search">
                                <table>
                                    <thead>
                                        <tr>

                                            <th>description</th>
                                            <th>nom_cles</th>
                                            <th>marque</th>
                                            <th>budget</th>
                                            <th>Delete</th>
                                            <th>update</th>



                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        include('../../controllers/categorieC.php');
                                        $categorieC = new categorieC();
                                        $list = $categorieC->afficherCategorie();
                                        foreach ($list as $pr) {
                                        ?>

                                            <tr>

                                                <td>
                                                    <?= $pr['description'] ?>
                                                </td>
                                                <td>
                                                    <?= $pr['nom_cles'] ?>
                                                </td>
                                                <td>
                                                    <?= $pr['marque'] ?>
                                                </td>
                                                <td>
                                                    <?= $pr['budget'] ?>
                                                </td>
                                                <td><a href="deletcategorie.php?idCtegorie=<?= $pr['idCtegorie'] ?>"><i class="fas fa-trash"></i></a></td>
                                                <td><a href="updatecategorie.php?idCtegorie=<?= $pr['idCtegorie'] ?>"><i class="fas fa-sync-alt"></i></a></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
                        <p>Bonjour, <b>Maram</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="../assets/img/profile-1.jpg" alt="">
                    </div>
                </div>
            </div>
            <!---END OF TOP-->
            <div class=" recent-updates">
                <h2>notification</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../assets/img/profile-2.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>zouzou</b> received his order of Organic and eco-friendly cleaning products </p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../assets/img/profile-3.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>bouba</b> received his order of Reusable water bottles and straws.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../assets/img/profile-4.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>sou</b> received his order of Biodegradable bags</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                </div>
            </div>
            <!----END OF RECENT UPDATES-->




        </div>
    </div>
    </div>



    <!-- <script src="./index.js"></script> -->
    <script src="../assets/js/cntrlssr.js"></script>
    <script src="../assets/js/contolessr.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/show.js"></script>
    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("productsDropdown");
            dropdown.classList.toggle("show");
        }
    </script>

</body>

</html>