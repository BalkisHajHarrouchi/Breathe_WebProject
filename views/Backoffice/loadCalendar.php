<?php
require_once "../../controllers/eventC.php";
require_once "../../models/event.php";
require_once "C:/xampp/htdocs/Projet/config2.php";


$data = array();
$query = "SELECT * from events";
$sql = "SELECT * from events";
$db = config::getConnection();
$query = $db->prepare($sql);
$query->execute();

$result = $query->fetchAll();
foreach($result as $row) {
    $data[] = array(
        "id" => $row["idEvent"],
        "title" => $row["nom"],
        "start" => $row["dateEventStart"],
        "end" => $row["dateEventEnd"]
    );
}
//json format
echo json_encode($data);
