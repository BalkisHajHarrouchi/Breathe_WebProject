<?php
$host = "localhost"; // replace with your database host
$dbname = "projet"; // replace with your database name
$username = "root"; // replace with your database username
$password = ""; // replace with your database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>



