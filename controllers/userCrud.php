<?php
require_once "C:/xampp/htdocs/Projet/config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once('PHPMailer.php');
require_once('SMTP.php');
require_once('Exception.php');
require "C:/xampp/htdocs/Projet/vendor/autoload.php";
//require "../../vendor/autoload.php";
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["signup"])) {
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $dob = $_POST["dob"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        // Check if the email already exists
        $stmt = $conn->prepare("SELECT * FROM user WHERE  email=:email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        //save the user data
        
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            echo "Email already exists";
        } else {
            // Generate a unique verification token
            $verification_token = bin2hex(random_bytes(32));
            // Insert the new user into the database with the verification token
            $stmt = $conn->prepare("INSERT INTO user (firstname, lastname, dob, email, password, verification_token) VALUES (:firstname, :lastname, :dob, :email, :password, :verification_token)");
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":dob", $dob);
            $stmt->bindParam(":email", $email);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(":password", $hashed_password);
            $stmt->bindParam(":verification_token", $verification_token);
            $stmt->execute();
            $_SESSION["user"] = array(
                "id" => $conn->lastInsertId(),
                "firstname" => $firstname,
                "lastname" => $lastname,
                "dob" => $dob,
                "email" => $email,
                "password" => $hashed_password,
                
            );
            
            $_SESSION["signedup"] = true;
            
            // Send a verification email to the user's email address
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'nour.boujenoui@esprit.tn'; // Your Gmail address
                $mail->Password = '211JMT6901'; // Your Gmail password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom('nour.boujenoui@esprit.tn');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Verify your account';
                $mail->Body = 'Please click on the following link to verify your account: <a href="' . 'http://localhost/projet/views/Frontoffice/login.php?token=' . $verification_token . '">Verify</a>';
                $mail->send();
                $verif = "An email has been sent to your email to verify your account";
                echo '<script>document.querySelector("#email + .error-message").innerHTML = "' . $verif . '";</script>';
                $_SESSION["error"] = $verif;

                header("Location: ../views/Frontoffice/login.php");
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
    

}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["token"])) {
    // Check the verification token and mark the user's account as verified
    $verification_token = $_GET["token"];
    $stmt = $conn->prepare("SELECT * FROM user WHERE verification_token=:verification_token");
    $stmt->bindParam(":verification_token", $verification_token);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo "Invalid verification token";
    } else {
        $stmt = $conn->prepare("UPDATE user SET verified=1, verification_token='' WHERE email=:email");
        $stmt->bindParam(":email", $result['email']);
        $stmt->execute();
        header("refresh:5;url= overview.php");
       
         // redirect to home page after 5 seconds
         
    }
}

$error = "";
if (isset($_POST["login"])) {
    // Verify the captcha
    if (isset($_POST["g-recaptcha-response"])) {
        $response = $_POST["g-recaptcha-response"];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6Le3Q6clAAAAAMS7eBSL8HTKCCpQgJWiU-cdsOmj',
            'response' => $response
        );
        $options = array(
            'http' => array (
                'header' => "Content-type: application/x-www-form-urlencoded\r
",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success = json_decode($verify);
        if (!$captcha_success->success) {
            $error = "Confirm that you are human";
            echo '<script>document.querySelector("#email + .error-message").innerHTML = "' . $error . '";</script>';
            $_SESSION["error"] = $error;
            header("Location: ../views/Frontoffice/login.php");
            exit;
        } 
        
        else {
            // Verify the email and password
            $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindParam(":email", $_POST["email"]);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($_POST["password"], $user["password"])) {
                // Check if user is blocked
                if ($user["blocked"] == 1) {
                    $error = "Your account has been blocked. Please contact the administrator for more information.";
                    echo '<script>document.querySelector("#email + .error-message").innerHTML = "' . $error . '";</script>';
                    $_SESSION["error"] = $error;
                    header("Location: ../views/Frontoffice/login.php");
                    exit;
                }
                else if ($user["verified"] == 0) {
                    $error = "Your email is not verified. Please check your email and follow the instructions to verify your account.";
                    echo '<script>document.querySelector("#email + .error-message").innerHTML = "' . $error . '";</script>';
                    $_SESSION["error"] = $error;
                    header("Location: ../views/Frontoffice/login.php");
                    exit;
                }
                else {
                    // Check the user's role and redirect accordingly
                    if ($user["role"] == "admin") {
                        header("Location: ../views/Backoffice/admin.php");
                    } else {
                        header("Location: ../views/Frontoffice/overview.php");
                    }
                    // Save the user data
                    $_SESSION["user"] = $user;
                    $_SESSION["loggedin"] = true;
                }
            } else {
                $error = "Incorrect email or password";
                echo '<script>document.querySelector("#email + .error-message").innerHTML = "' . $error . '";</script>';
                $_SESSION["error"] = $error;
                header("Location: ../views/Frontoffice/login.php");
                exit;
            }
        }
    }}        
?>