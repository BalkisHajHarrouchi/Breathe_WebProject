<?php
require_once "../../controllers/eventC.php";
require_once "../../models/event.php";
require_once "../../config.php";


if(isset($_POST['title'])){
    $sql = "INSERT INTO events (nom,dateEventStart,dateEventEnd)
    VALUES(:nom,:dateEventStart,:dateEventEnd)";
    $db = config::getConnection();
    $query = $db->prepare($sql);
    $query->bindValue('nom', $_POST['title']);
    $query->bindValue('dateEventStart', $_POST['start']);
    $query->bindValue('dateEventEnd', $_POST['end']);
    $query->execute();
    
    
}
?>