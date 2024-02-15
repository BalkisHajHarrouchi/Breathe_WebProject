<?php
require_once "../../controllers/eventC.php";
require_once "../../models/event.php";
require_once "C:/xampp/htdocs/Projet/config2.php";


if(isset($_POST['title'])){

  $sql ="
  UPDATE events SET nom=:nom,dateEventStart=:dateEventStart,dateEventEnd=:dateEventEnd WHERE idEvent=:idEvent
  ";
  $db = config::getConnection();
  $query = $db->prepare($sql);
  $query->bindValue('nom', $_POST['title']);
  $query->bindValue('dateEventStart', $_POST['start']);
  $query->bindValue('dateEventEnd', $_POST['end']);
  $query->bindValue(':idEvent', $_POST['id']);
  $query->execute();  
}
