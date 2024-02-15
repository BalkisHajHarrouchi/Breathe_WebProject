<?php
include '../../config.php';
require "../../controllers/userCrud.php";
require "../../models/userC.php";

if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
    // User exists and has an 'admin' role
    // Allow access to the restricted area
} else {
    // User does not exist or does not have an 'admin' role
    header('HTTP/1.0 403 Forbidden');
    echo 'Access denied.';
    exit();
}

// Handle form submission for blocking/unblocking user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];

    // Check if user is currently blocked or unblocked
    $stmt = $conn->prepare('SELECT blocked FROM user WHERE firstname = :firstname');
    $stmt->bindParam(':firstname', $firstname);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['blocked'] == 0) {
        // Block the user
        $stmt = $conn->prepare('UPDATE user SET blocked = 1 WHERE firstname = :firstname');
        $stmt->bindParam(':firstname', $firstname);
        $stmt->execute();
    } else {
        // Unblock the user
        $stmt = $conn->prepare('UPDATE user SET blocked = 0 WHERE firstname = :firstname');
        $stmt->bindParam(':firstname', $firstname);
        $stmt->execute();
    }

    // Redirect back to the admin page
    header('Location: admin.php');
    exit();
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+icons+sharp">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="style.css">

</head>
<style>
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
                        <a href="Admin.php" class="active">
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
            <div class="right">
                <div class="top">
                    <button id="menu-btn">
                        <span class="material-symbols-sharp">

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
                            <p> <?php echo $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname']; ?></p>
                            <small class="text-muted">Admin</small>
                        </div>
                        < </div>
                    </div>
                    <main>
                        <h1>Admin</h1>
                        <div class="date">
                            <input type="date">
                        </div>
                        <div class="insights">
                            <div class="sales">
                                <span class="material-symbols-sharp">

                                </span>
                                <div class="middle">
                                    <div class="left">
                                        <br>
                                        <h3>Number of admins</h3>
                                        <?php
                                        $stmt = $conn->prepare('SELECT COUNT(*) FROM user');
                                        $stmt->execute();
                                        $num_admins = $stmt->fetchColumn();

                                        // Prepare the query to count the number of admins
                                        $stmt = $conn->prepare('SELECT COUNT(*) FROM user WHERE role = "admin"');
                                        $stmt->execute();
                                        $num_admins = $stmt->fetchColumn();

                                        // Output the results
                                        echo "Total admins: " . $num_admins . "<br>";
                                        ?>
                                    </div>
                                </div>

                            </div>
                            <!----- end of sales -->
                            <div class="expenses">
                                <span class="material-symbols-sharp">

                                </span>
                                <div class="middle">
                                    <div class="left">
                                        <br>
                                        <h3>Number of accounts</h3>

                                        <?php
                                        $stmt = $conn->prepare('SELECT COUNT(*) FROM user');
                                        $stmt->execute();
                                        $num_total = $stmt->fetchColumn();

                                        // Prepare the query to count the number of users
                                        $stmt = $conn->prepare('SELECT COUNT(*) FROM user');
                                        $stmt->execute();
                                        $num_total = $stmt->fetchColumn();

                                        // Output the results
                                        echo "Total : " . $num_total . "<br>";
                                        ?>
                                        <br>
                                    </div>
                                </div>

                            </div>
                            <!----- end of expenses -->
                            <div class="income">
                                <span class="material-symbols-sharp">

                                </span>
                                <div class="middle">
                                    <div class="left">
                                        <br>
                                        <h3>Number of users</h3>
                                        <?php
                                        $stmt = $conn->prepare('SELECT COUNT(*) FROM user');
                                        $stmt->execute();
                                        $num_users = $stmt->fetchColumn();

                                        // Prepare the query to count the number of users
                                        $stmt = $conn->prepare('SELECT COUNT(*) FROM user WHERE role = "user"');
                                        $stmt->execute();
                                        $num_users = $stmt->fetchColumn();

                                        // Output the results
                                        echo "Total users: " . $num_users . "<br>";
                                        ?>
                                        <br>
                                    </div>
                                </div>

                            </div>
                            <!----- end of income -->

                        </div>
                        <!----- end of insights -->
                        <div class="recent-orders">
                            <h2>Recent Signups</h2>
                            <?php
                            // Set the number of results to show per page
                            $resultsPerPage = 1;

                            // Count the total number of rows in the table
                            $stmt = $conn->query('SELECT COUNT(*) as total FROM user');
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $totalResults = $row['total'];

                            // Determine the total number of pages
                            $totalPages = ceil($totalResults / $resultsPerPage);

                            // Get the current page number
                            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                            // Calculate the offset
                            $offset = ($currentPage - 1) * $resultsPerPage;

                            // Query the database for the current page of results
                            $stmt = $conn->prepare('SELECT firstname, lastname, dob, email, role, blocked FROM user LIMIT :offset, :resultsPerPage');
                            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                            $stmt->bindValue(':resultsPerPage', $resultsPerPage, PDO::PARAM_INT);
                            $stmt->execute();

                            // Output the table
                            echo '<table>';
                            echo '<thead><tr><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Email</th><th>Role</th><th></th></tr></thead>';
                            echo '<tbody>';
                            $rowNum = ($currentPage - 1) * $resultsPerPage + 1; // Calculate the row number for the first row on the current page

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['firstname']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['lastname']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['dob']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                                echo '<td class="' . ($row['role'] == 'Admin' ? 'warning' : '') . '">' . htmlspecialchars($row['role']) . '</td>';

                                if ($row['blocked'] == 0) {
                                    // Block/Unblock button
                                    echo '<td><form action="admin.php" method="post"><input type="hidden" name="firstname" value="' . $row['firstname'] . '"><button type="submit">Block</button></form></td>';
                                } else if ($row['blocked'] == 1) {
                                    echo '<td><form action="admin.php" method="post"><input type="hidden" name="firstname" value="' . $row['firstname'] . '"><button type="submit">Unblock</button></form></td>';
                                }

                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';


                            // Generate pagination links
                            echo '<div class="pagination" >';
                            echo '<div class="pagination-links" style="display: flex; justify-content: center; align-items: center;">';

                            for ($page = 1; $page <= $totalPages; $page++) {
                                echo '<a ';
                                if ($currentPage == $page) {
                                    echo 'class="active" ';
                                }
                                echo 'href="admin.php?page=' . $page . '">' . $page . '</a>';
                            }
                            echo '</div>';
                            echo '</div>';

                            ?>
                            <style>
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
                            </style>




                        </div>




                    </main>


        </main>

        <script src="./index.js"></script>
</body>

</html>