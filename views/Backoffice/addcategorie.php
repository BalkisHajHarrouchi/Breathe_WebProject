<?php
require_once '../../controllers/categorieC.php';
$error = "";

// create client
$categ = null;

// create an instance of the controller
$categc = new categorieC();
if (
    isset($_POST["description"]) &&
    isset($_POST["nom_cles"]) &&
    isset($_POST["marque"]) &&
    isset($_POST["budget"])


) {
    if (
        isset($_POST["description"]) &&
        isset($_POST["nom_cles"]) &&
        isset($_POST["marque"]) &&
        isset($_POST["budget"])

    ) {
        $categorie = new categorie(

            $_POST["description"],
            $_POST["nom_cles"],
            $_POST["marque"],
            (int)$_POST["budget"]

        );
        echo get_class($categc);

        $categc->addcategorie($categorie);


        header('Location:Produits.php');
    } else
        $error = "Missing information";
}
