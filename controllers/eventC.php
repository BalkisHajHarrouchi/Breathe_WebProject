<?php
require_once "C:/xampp/htdocs/Projet/config2.php";
// require_once "../models/Event.php";
class EventC{
    public function addEvent($event){
        try {
            $sql = "INSERT INTO events (nom, type, lieu, dateEventStart,dateEventEnd, description, nbPlaces, image, prixEvent) VALUES (:nom, :type, :lieu, :dateEventStart, :dateEventEnd, :description, :nbPlaces, :image, :prixEvent)";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('nom', $event->getnomEvent());
            $query->bindValue('type', $event->gettypeEvent());
            $query->bindValue('lieu', $event->getlieuEvent());
            $query->bindValue('dateEventStart', $event->getdateEventStart()->format('Y-m-d H:i:s'));
            $query->bindValue('dateEventEnd', $event->getdateEventEnd()->format('Y-m-d H:i:s'));
            $query->bindValue('description', $event->getdescriptionEvent());
            $query->bindValue('nbPlaces', $event->getnbPlacesEvent());
            $query->bindValue('image', $event->getimage());
            $query->bindValue('prixEvent', $event->getprixEvent());
            // $query->bindValue('nbDispo', $event->getnbPlacesEvent());
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function displayEvents(){
        try {
            $sql = "SELECT * from events order by dateEventStart desc";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function cleaningEvents(){
        try {
            $sql = "SELECT * FROM events WHERE type = 'Cleaning' order by dateEventStart desc";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function agricultureEvents(){
        try {
            $sql = "SELECT * FROM events WHERE type = 'Agriculture' order by dateEventStart desc";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function donationEvents(){
        try {
            $sql = "SELECT * FROM events WHERE type = 'Donation' order by dateEventStart desc";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function entertainmentEvents(){
        try {
            $sql = "SELECT * FROM events WHERE type = 'Entertainment' order by dateEventStart desc";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function educativeEvents(){
        try {
            $sql = "SELECT * FROM events WHERE type = 'Educative' order by dateEventStart desc";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function sportsEvents(){
        try {
            $sql = "SELECT * FROM events WHERE type = 'Sports' order by dateEventStart desc";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function animalsEvents(){
        try {
            $sql = "SELECT * FROM events WHERE type = 'Animals' order by dateEventStart desc";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function deleteEvent(int $idEvent){
        try {
            $sql = "DELETE from events where idEvent = ?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idEvent);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function getEventById($idEvent){
        try {
            $sql = "SELECT * from events where idEvent=?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idEvent);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function updateEvent($idEvent, $event){
        try {
            $sql = "UPDATE events SET nom = :nom, type = :type, lieu = :lieu, dateEventStart = :dateEventStart, dateEventEnd = :dateEventEnd, description = :description, nbPlaces = :nbPlaces, image = :image, prixEvent = :prixEvent WHERE idEvent = :idEvent";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('nom', $event->getnomEvent());
            $query->bindValue('type', $event->gettypeEvent());
            $query->bindValue('lieu', $event->getlieuEvent());
            $query->bindValue('dateEventStart', $event->getdateEventStart()->format('Y-m-d H:i:s'));
            $query->bindValue('dateEventEnd', $event->getdateEventEnd()->format('Y-m-d H:i:s'));
            $query->bindValue('description', $event->getdescriptionEvent());
            $query->bindValue('nbPlaces', $event->getnbPlacesEvent());
            $query->bindValue('image', $event->getimage());
            $query->bindValue('prixEvent', $event->getprixEvent());
            // $query->bindValue('nbDispo', $event->getnbPlacesEvent());
            $query->bindValue(':idEvent', $idEvent);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }

    function searchEvents($input)
    {
        $sql = "SELECT * FROM events WHERE nom LIKE '%" . $input . "%' OR lieu LIKE '%" . $input . "%' OR type LIKE '%" . $input . "%' OR nbPlaces LIKE '%" . $input . "%'";
        $db = config::getConnection();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $event = $query->fetchAll();
            return $event;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function trisEvent($w){
        if($w==""){
            $sql = "SELECT * from events";
        }else{
            $sql = "SELECT * FROM events ORDER BY $w"; 
        }
        $db = config::getConnection();
        
            $query=$db->prepare($sql);
            $query->execute();

            $type=  $query->fetchAll(PDO::FETCH_ASSOC);
            return $type;
    
    }
}
