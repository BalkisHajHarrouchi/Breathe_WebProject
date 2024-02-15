<?php
require_once "C:/xampp/htdocs/Projet/config2.php";
// require_once "../models/Event.php";

class categRC{
    public function addcategR($categR){
        try {
            $sql = "INSERT INTO categrecyclages (nomCateg, description, nbr_demande, image) VALUES (:nomCateg, :description, :nbr_demande, :image)";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('nomCateg', $categR->getnomCateg());
            $query->bindValue('description', $categR->getdescription());
            $query->bindValue('nbr_demande', $categR->getnbr_demande());
            $query->bindValue('image', $categR->getimage());
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function displaycategRs(){
        try {
            $sql = "SELECT * from categrecyclages";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function deletecategR(int $idCateg_re){
        try {
            $sql = "DELETE from categrecyclages where idCateg_re = ?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idCateg_re);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function getcategRById($idCateg_re){
        try {
            $sql = "SELECT * from categrecyclages where idCateg_re=?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idCateg_re);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function updatecategR($idCateg_re, $categR){
        try {
            $sql = "UPDATE categrecyclages SET nomCateg = :nomCateg, description = :description, nbr_demande = :nbr_demande, image = :image WHERE idCateg_re = :idCateg_re";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('nomCateg', $categR->getnomCateg());
            $query->bindValue('description', $categR->getdescription());
            $query->bindValue('nbr_demande', $categR->getnbr_demande());
            $query->bindValue('image', $categR->getimage());
            $query->bindValue(':idCateg_re', $idCateg_re);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
        
    }
}
