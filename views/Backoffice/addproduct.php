<?php
require_once '../../controllers/produitsC.php';
$error = "";

// create client
$produit = null;

// create an instance of the controller
$produitc = new produitsC();
if (
    isset($_POST["idCtegorie"]) &&
    isset($_POST["nomproduit"]) &&
    isset($_POST["typeprod"]) &&
    isset($_POST["prix"]) &&
    isset($_POST["stock"]) &&
    isset($_POST["codeBarre"]) &&
    isset($_POST["status"]) &&
    isset($_POST["image"])


) {
    if (

        isset($_POST["idCtegorie"]) &&
        isset($_POST["nomproduit"]) &&
        isset($_POST["typeprod"]) &&
        isset($_POST["prix"]) &&
        isset($_POST["stock"]) &&
        isset($_POST["codeBarre"]) &&
        isset($_POST["status"]) &&
        isset($_POST["image"])

    ) {
        $produit = new produit(

            $_POST["idCtegorie"],
            $_POST["nomproduit"],
            $_POST["typeprod"],
            $_POST["prix"],
            $_POST["stock"],
            (int)$_POST["codeBarre"],
            $_POST["status"],
            $_POST["image"]

        );
        echo get_class($produitc);

        $produitc->addproduct($produit);


        header('Location:../dashbord/produits.php');
    } else
        $error = "Missing information";
}
