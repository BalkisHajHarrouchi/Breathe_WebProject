<?php

require_once "C:/xampp/htdocs/Projet/config2.php";
require_once 'C:\xampp\htdocs\Projet\models\categorie.php';

class categorieC
{

	function affichercategorie($search = null)
	{
		$sql = "SELECT * FROM categshops";

		if ($search) {
			$sql .= " WHERE nomProduit LIKE '%$search%'";
			$sql .= " WHERE prix LIKE '%$search%'";
		}
		$sql .= " ORDER BY idCtegorie DESC";

		$db = config::getConnection();
		try {
			$liste = $db->query($sql);
			return $liste;
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
	}


	function addcategorie($categorie)
	{

		$sql = "INSERT INTO categshops ( description , nom_cles , marque , budget)
       values( :description,  :nom_cles, :marque , :budget)";
		$db = config::getConnection();
		try {
			$query = $db->prepare($sql);
			$query->execute([

				'description' => $categorie->getdesc(),
				'nom_cles' => $categorie->getnom(),
				'marque' => $categorie->getmarq(),
				'budget' => $categorie->getbudget()
			]);
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
	}

	function deletecategorie($idCtegorie)
	{
		$sql = "DELETE FROM categshops WHERE idCtegorie= :idCtegorie";
		$db = config::getConnection();
		$req = $db->prepare($sql);
		$req->bindValue(':idCtegorie', $idCtegorie);
		try {
			$req->execute();
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
	}

	function updatecategorie($categorie)
	{
		try {
			$db = config::getConnection();
			$query = $db->prepare(
				'UPDATE categshops SET 
					
					description = :description
					
				WHERE idCtegorie = :idCtegorie'
			);
			$query->execute([

				'idCtegorie' => $categorie->getid(),
				'description' => $categorie->getdesc()
			]);
			echo $query->rowCount() . " records UPDATED successfully <br>";
		} catch (PDOException $e) {
			var_dump($e->getMessage());
		}
	}





	public function afficherCategories()
	{
		// Database connection
		$db = config::getConnection();

		// SQL query to get all categories
		$query = "SELECT * FROM categshops";
		$result = $db->query($query);

		// Store the categories in an array
		$categories = array();
		while ($row = $result->fetch()) {
			$categories[] = array(
				'idCtegorie' => $row['idCtegorie'],
				'description' => $row['description'],
			);
		}

		return $categories;
	}

	// Other methods of the class...
	function showcategorie($idCtegorie)
	{
		$sql = "SELECT * from categshops where idCtegorie = $idCtegorie";
		$db = config::getConnection();
		try {
			$query = $db->prepare($sql);
			$query->execute();

			$categorie = $query->fetch();
			return $categorie;
		} catch (Exception $e) {
			die('Error: ' . $e->getMessage());
		}
	}


	function getProduitsByCategorie($idCtegorie)
	{
		$sql = "SELECT * FROM produits WHERE idCtegorie = :idCtegorie";
		$db = config::getConnection();
		try {
			$query = $db->prepare($sql);
			$query->execute(['idCtegorie' => $idCtegorie]);
			$resultats = $query->fetchAll(PDO::FETCH_ASSOC);
			return $resultats;
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
	}
}
