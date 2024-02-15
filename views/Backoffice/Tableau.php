<?php
// EVENTS
//bar chart
include '../../config.php';
require_once "../../controllers/eventC.php";
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


// BLOGS
//pie chart
$db = config::getConnection();
$qb1z = $db->query("SELECT * FROM blogs WHERE categorie = 'ecology'");
$qb1z->execute();
$cb1z = count($qb1z->fetchAll());
$qb2z = $db->query("SELECT * FROM blogs WHERE categorie = 'garden'");
$qb2z->execute();
$cb2z = count($qb2z->fetchAll());
$qb3z = $db->query("SELECT * FROM blogs WHERE categorie = 'plants'");
$qb3z->execute();
$cb3z = count($qb3z->fetchAll());

//RECYCLING
$q1a = $db->query("SELECT * FROM categrecyclages WHERE 4>=nbr_demande");
$q1a->execute();
$c1a = count($q1a->fetchAll());

$q2a = $db->query("SELECT * FROM categrecyclages WHERE nbr_demande between 5 and 7");
$q2a->execute();
$c2a = count($q2a->fetchAll());

$q3a = $db->query("SELECT * FROM categrecyclages WHERE nbr_demande between 8 and 10");
$q3a->execute();
$c3a = count($q3a->fetchAll());


$q4a = $db->query("SELECT * FROM categrecyclages WHERE nbr_demande between 11 and 15");
$q4a->execute();
$c4a = count($q4a->fetchAll());

$q5a = $db->query("SELECT * FROM categrecyclages WHERE nbr_demande>15");
$q5a->execute();
$c5a = count($q5a->fetchAll());
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../balkis/css/chart.css">
</head>

<style>
    .box1 {
        margin-right: 100px;
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
                        <a href="Tableau.php" class="active">
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
            <h1>Tableau de bord</h1>
            <div class="date">
                <input type="date">
            </div>

            <div class="recent-orders">
                <h2>
                    Stat Events</h2>
                <!-- ==============ALL STAT=============== -->
                <!-- *********************EVENTS ************************************-->
                <div class="graphBox">
                    <div class="box1">
                        <canvas id="pieChart"></canvas>
                    </div>
                    <div class="box">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
                <br>
            </div>
            <!-- *********************BLOGS ************************************-->
            <div class="recent-orders">
                <h2>Blogs and Recycling stats</h2>


                <div class="graphBox">
                    <div class="box1">
                        <canvas id="pieChartz"></canvas>
                    </div>
                    <!-- *********************RECYCLING ************************************-->
                    <div class="box1">
                        <canvas id="barCharta"></canvas>
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
                        <p>Bonjour, <b>admin</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="../assets/img/profile-1.jpg">
                    </div>
                </div>
            </div>
            <!---END OF TOP-->
            <div class="recent-updates">
                <h2>notification</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../assets/img/profile-2.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../assets/img/profile-3.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../assets/img/profile-4.jpg" alt="">
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
                <h2>Total Users</h2>
                <div class="item online">
                    <div class="icon">
                        <span class="material-symbols-sharp">

                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Number of Accounts</h3>
                            <small class="text-muted"><?php
                                                        $stmt = $conn->prepare('SELECT COUNT(*) FROM user');
                                                        $stmt->execute();
                                                        $num_total = $stmt->fetchColumn();

                                                        // Prepare the query to count the number of users
                                                        $stmt = $conn->prepare('SELECT COUNT(*) FROM user');
                                                        $stmt->execute();
                                                        $num_total = $stmt->fetchColumn();

                                                        // Output the results
                                                        echo "Total : " . $num_total . "<br>";
                                                        ?></small>
                        </div>

                    </div>
                </div>
                <div class="item offline">
                    <div class="icon">
                        <span class="material-symbols-sharp">

                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Number of Users</h3>
                            <small class="text-muted"><?php
                                                        $stmt = $conn->prepare('SELECT COUNT(*) FROM user');
                                                        $stmt->execute();
                                                        $num_users = $stmt->fetchColumn();

                                                        // Prepare the query to count the number of users
                                                        $stmt = $conn->prepare('SELECT COUNT(*) FROM user WHERE role = "user"');
                                                        $stmt->execute();
                                                        $num_users = $stmt->fetchColumn();

                                                        // Output the results
                                                        echo "Total users: " . $num_users . "<br>";
                                                        ?></small>
                        </div>

                    </div>
                </div>
                <div class="item customers">
                    <div class="icon">
                        <span class="material-symbols-sharp">

                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Number of admins</h3>
                            <small class="text-muted"><?php
                                                        $stmt = $conn->prepare('SELECT COUNT(*) FROM user');
                                                        $stmt->execute();
                                                        $num_admins = $stmt->fetchColumn();

                                                        // Prepare the query to count the number of admins
                                                        $stmt = $conn->prepare('SELECT COUNT(*) FROM user WHERE role = "admin"');
                                                        $stmt->execute();
                                                        $num_admins = $stmt->fetchColumn();

                                                        // Output the results
                                                        echo "Total admins: " . $num_admins . "<br>";
                                                        ?></small>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <script src="../assets/js/index.js"></script>
    <!-- **********balkis************ -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script>
        /* bar chart*/
        var c1 = "<?php echo $c1; ?>";
        var c2 = "<?php echo $c2; ?>";
        var c3 = "<?php echo $c3; ?>";
        var c4 = "<?php echo $c4; ?>";
        var c5 = "<?php echo $c5; ?>";

        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Exclusive', 'Small Group', 'Moderate Size ', 'Large Group', 'Open to All'],
                datasets: [{
                    label: 'Available Places',
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
        var cb1 = "<?php echo $cb1; ?>";
        var cb2 = "<?php echo $cb2; ?>";
        var cb3 = "<?php echo $cb3; ?>";

        /* pie chart*/
        var cty = document.getElementById('pieChart').getContext('2d');
        var myChart = new Chart(cty, {
            type: 'polarArea',
            data: {
                labels: ['Agriculture', 'Donation', 'Educative'],
                datasets: [{
                    label: '# of Votes',
                    data: [cb1, cb2, cb3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script>
        /* ************************zeineb *********************/
        var cb1z = "<?php echo $cb1z; ?>";
        var cb2z = "<?php echo $cb2z; ?>";
        var cb3z = "<?php echo $cb3z; ?>";
        var ctyz = document.getElementById('pieChartz').getContext('2d');
        var myChartz = new Chart(ctyz, {
            //bar
            //polarArea
            type: 'doughnut',
            data: {
                labels: ['ecology', 'garden', 'plants'],
                datasets: [{
                    label: 'specialite',
                    data: [cb1z, cb2z, cb3z],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
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
    <!-- ********aboubaker***** -->
    <script>
        /* bar chart*/
        var c1a = "<?php echo $c1a; ?>";
        var c2a = "<?php echo $c2a; ?>";
        var c3a = "<?php echo $c3a; ?>";
        var c4a = "<?php echo $c4a; ?>";
        var c5a = "<?php echo $c5a; ?>";

        var ctxa = document.getElementById('barCharta').getContext('2d');
        var myCharta = new Chart(ctxa, {
            type: 'bar',
            data: {
                labels: ['4>=', 'between 5 and 7', 'between 8 and 10', ' between 11 and 15', '>15'],
                datasets: [{
                    label: 'Nombre de demande',
                    data: [c1a, c2a, c3a, c4a, c5a],
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

</body>

</html>