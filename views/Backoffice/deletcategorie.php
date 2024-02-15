<?php

require_once '../../controllers/categorieC.php';

$produitc = new categorieC();
$produitc->deletecategorie($_GET["idCtegorie"]);

header('Location:http://localhost/Projet/views/Backoffice/Produits.php');
