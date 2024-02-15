<?php
require_once '../../controllers/categorieC.php';
$error = "";

// create client
$categ = null;

// create an instance of the controller
$categc = new categorieC();
if (
  isset($_POST["idCtegorie"]) &&
  isset($_POST["olddescription"]) &&
  isset($_POST["newdescription"])


) {
  if (
    isset($_POST["idCtegorie"]) &&
    isset($_POST["olddescription"]) &&
    isset($_POST["newdescription"])


  ) {
    $categorie = new categorie();
    $categorie->setid($_POST["idCtegorie"]);
    $categorie->setdesc($_POST["newdescription"]);

    $categc->updatecategorie($categorie);


    header('Location:Produits.php');
  } else
    $error = "Missing information";
}


?>

<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Breath</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">

</head>
<div class="container">
  <aside>
    <div class="top">
      <div class="logo">
        <img src="../assets/img/breathelogo.png" />
      </div>
      <div class="close" id="close-btn">
        <span class="material-icons-sharp">close</span>
      </div>
    </div>
    <div class="sidebar">
      <a href="events.php">
        <span class="material-icons-sharp">event</span>
        <h3>Événements</h3>
      </a>
      <a href="recyclage.php">
        <span class="material-symbols-sharp">
          cycle
        </span>
        <h3>Recyclage</h3>
      </a>
      <a href="produits.php" class="active">
        <span class="material-icons-sharp">local_offer</span>
        <h3>Produits</h3>
      </a>
      <a href="articles.php">
        <span class="material-icons-sharp">article</span>
        <h3>Articles</h3>
      </a>
      <a href="admin.php">
        <span class="material-icons-sharp">account_circle</span>
        <h3>Admin</h3>
      </a>
      <a href="Reclamation.php">
        <span class="material-icons-sharp">report_problem</span>
        <h3>Réclamation</h3>
      </a>
      <a href="Parametre.php">
        <span class="material-icons-sharp">settings</span>
        <h3>Paramètres</h3>
      </a>
      <a href="#">
        <span class="material-icons-sharp">logout</span>
        <h3>Déconnecter</h3>
      </a>
    </div>
  </aside>
  <!----- end of aside -->
  <main>

    <body>
      <!----- end of expenses -->
      <div class="date">
        <input type="date">
      </div>
      <div class="insights">
        <div class="sales">
          <div class="income">
            <span class="material-symbols-sharp">
              stacked_line_chart
            </span>
            <div class="middle">
              <div class="left">
                <h3>update</h3>
                <div class="input-box">
                  <table>
                    <?php
                    $pr = $categc->showcategorie($_GET['idCtegorie']);
                    ?>
                    <form id="update_categorie" action="" method="POST">
                      <div class="input-box">
                        <tr>
                          <td><input id='idc' type="text" name='idCtegorie' hidden value="<?= $_GET['idCtegorie'] ?>"></td>

                        </tr>
                        <tr>
                          <td><input id='descrp' type="text" name='olddescription' value="<?= $pr['description'] ?>"></td>
                          <td><label>description</label></td>
                        </tr>
                        <tr>
                          <td><input type="text" name='newdescription'></td>
                          <td><label>description</label></td>
                        </tr>
                      </div>
                      <button class="btn" type='submit'>Modify</button>
                    </form>
                  </table>
                </div>

              </div>
              <div class="progress">

              </div>
            </div>

          </div>
          <!----- end of income -->
    </body>

</html>