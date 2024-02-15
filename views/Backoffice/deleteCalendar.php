<?php
require_once "../../controllers/eventC.php";
require_once "../../models/event.php";
require_once "C:/xampp/htdocs/Projet/config2.php";

if(isset($_POST['id'])){
    try {
        $idEvent = $_POST['id']; // retrieve the value of 'id'
        $sql = "DELETE FROM events WHERE idEvent = ?";
        $db = config::getConnection();
        $query = $db->prepare($sql);
        $query->bindParam(1, $idEvent);
        $query->execute();
        
    } catch (Exception $e) {
        die('Error: '.$e->getMessage());
    }
    
}
