<?php

require_once "C:/xampp/htdocs/Projet/config2.php";
require_once 'C:/xampp/htdocs/Projet/models/produit.php';


class produitsC
{

	public function afficherproduit($idCtegorie = null)
	{
		$db = config::getConnection();
		$sql = "SELECT * FROM produits";

		if ($idCtegorie !== null) {
			$sql .= " WHERE idCtegorie = $idCtegorie";
		}

		$stmt = $db->prepare($sql);
		$stmt->execute();
		return $stmt;
	}






	function addproduct($produits)
	{

		$sql = "INSERT INTO produits ( idCtegorie, nomproduit , typeprod, prix, stock,codeBarre,status,image)
       values( :idCtegorie, :nomproduit, :typeprod,  :prix, :stock , :codeBarre , :status , :image)";
		$db = config::getConnection();
		try {
			$query = $db->prepare($sql);
			$query->execute([
				'idCtegorie' => $produits->getidc(),
				'nomproduit' => $produits->getnom(),
				'typeprod' => $produits->gettype(),
				'prix' => $produits->getprix(),
				'stock' => $produits->getstock(),
				'codeBarre' => $produits->getcode(),
				'status' => $produits->getstatus(),
				'image' => $produits->getimage(),
			]);
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
	}

	function deleteproduit($idProduit)
	{
		$sql = "DELETE FROM produits WHERE idProduit= :idProduit";
		$db = config::getconnection();
		$req = $db->prepare($sql);
		$req->bindValue(':idProduit', $idProduit);
		try {
			$req->execute();
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
	}

	function updateproduct($produits)
	{
		try {
			$db = config::getconnection();
			$query = $db->prepare(
				'UPDATE produits SET 
					 
					prix = :prix
					
				WHERE idProduit= :idProduit'
			);
			$query->execute([
				'idProduit' => $produits->getid(),
				'prix' => $produits->getprix()

			]);
			echo $query->rowCount() . " records UPDATED successfully <br>";
		} catch (PDOException $e) {
			var_dump($e->getMessage());
		}
	}

	function showproduct($idProduit)
	{
		$sql = "SELECT * from produits where idProduit = $idProduit";
		$db = config::getconnection();
		try {
			$query = $db->prepare($sql);
			$query->execute();

			$produit = $query->fetch();
			return $produit;
		} catch (Exception $e) {
			die('Error: ' . $e->getMessage());
		}
	}
}
