
<?php
require_once "usercrud.php";

session_unset();
session_destroy();
setcookie("PHPSESSID", "", time() - 3600, "/");
header('Location: ../views/Frontoffice/login.php');
exit;
?>