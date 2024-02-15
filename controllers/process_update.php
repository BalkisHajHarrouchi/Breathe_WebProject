<?php
// Include the database connection code

$host = "localhost"; // replace with your database host
$dbname = "projet"; // replace with your database name
$username = "root"; // replace with your database username
$password = ""; // replace with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the updated user data from the form
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);

    // Validate the input
    if (!$username || !$email || !$password || !$role) {
        die('Invalid input');
    }

    // Sanitize the input
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Update the user data in the database
    $sql = "UPDATE user SET email = :email, password = :password, role = :role WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'email' => $email,
        'password' => $password_hash,
        'role' => $role,
        'username' => $username
    ]);

    // Redirect the user to the user list page
    header('Location: ../../Backoffice/views/admin.php');
    exit();
} else {
    // If the form wasn't submitted, exit or display an error message
    die('Invalid request');
}
?>