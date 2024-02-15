<?php

require_once '../../controllers/produitsC.php';

$produitc = new produitsC();
$produitc->deleteproduit($_GET["idProduit"]);

header('Location:produits.php');
