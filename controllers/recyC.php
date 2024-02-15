<?php
require_once "C:/xampp/htdocs/Projet/config2.php";


class recyC{
    public function addEventB($recy){
        try {
            $sql = "INSERT INTO demande_recyclage (idCateg_re,type, quantite, email, date_recy) VALUES (:idCateg_re, :type, :quantite, :email, :date_recy)";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('idCateg_re', $recy->getidCateg_re());
            $query->bindValue('type', $recy->gettype());
            $query->bindValue('quantite', $recy->getquantite());
            $query->bindValue('email', $recy->getemail());
            $query->bindValue('date_recy', $recy->getdate_recy()->format('Y-m-d'));
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function displayEventsB(){
        try {
            $sql = "SELECT * from demande_recyclage";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function deleteEventB(int $id_recy){
        try {
            $sql = "DELETE from demande_recyclage where id_recy = ?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $id_recy);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function getEventByIdB($id_recy){
        try {
            $sql = "SELECT * from demande_recyclage where id_recy=?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $id_recy);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function updateEventB($id_recy, $recy){
        try {
            $sql = "UPDATE demande_recyclage SET idCateg_re = :idCateg_re ,type = :type, quantite = :quantite, email = :email, date_recy = :date_recy WHERE id_recy = :id_recy";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('idCateg_re', $recy->getidCateg_re());
            $query->bindValue('type', $recy->gettype());
            $query->bindValue('quantite', $recy->getquantite());
            $query->bindValue('email', $recy->getemail());
            $query->bindValue('date_recy', $recy->getdate_recy()->format('Y-m-d'));
            $query->bindValue(':id_recy', $id_recy);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
        
    }

    public function getCategNameFromDRB($id_recy) {
        try {
            $db = config::getConnection();
            $sql = "SELECT categrecyclages.nomCateg
                    FROM demande_recyclage
                    INNER JOIN categrecyclages ON demande_recyclage.idCateg_re = categrecyclages.idCateg_re
                    WHERE demande_recyclage.id_recy = :id_recy";
            $query = $db->prepare($sql);
            $query->bindValue('id_recy', $id_recy);
            $query->execute();
    

            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row ? $row['nomCateg'] : null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getCategImageFromDRB($id_recy) {
        try {
            $db = config::getConnection();
            $sql = "SELECT categrecyclages.image
            FROM demande_recyclage
            INNER JOIN categrecyclages ON demande_recyclage.idCateg_re = categrecyclages.idCateg_re
            WHERE demande_recyclage.id_recy = :id_recy";
            $query = $db->prepare($sql);
            $query->bindValue('id_recy', $id_recy);
            $query->execute();
    
            // return the event name associated with the ticket
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row ? $row['image'] : null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getCategNBRDFromDRB($id_recy) {
        try {
            $db = config::getConnection();
            $sql = "SELECT categrecyclages.nbr_demande
            FROM demande_recyclage
            INNER JOIN categrecyclages ON demande_recyclage.idCateg_re = categrecyclages.idCateg_re
            WHERE demande_recyclage.id_recy = :id_recy";
            $query = $db->prepare($sql);
            $query->bindValue('id_recy', $id_recy);
            $query->execute();
    
            // return the event name associated with the ticket
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row ? $row['nbr_demande'] : null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getCategDescriptionFromDRB($id_recy) {
        try {
            $db = config::getConnection();
            $sql = "SELECT categrecyclages.description
            FROM demande_recyclage
            INNER JOIN categrecyclages ON demande_recyclage.idCateg_re = categrecyclages.idCateg_re
            WHERE demande_recyclage.id_recy = :id_recy";
            $query = $db->prepare($sql);
            $query->bindValue('id_recy', $id_recy);
            $query->execute();
    
            // return the event name associated with the ticket
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row ? $row['description'] : null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

}
