<?php
require_once "C:/xampp/htdocs/Projet/config2.php";

// require_once "../models/blog.php";
// $idSession=$_SESSION['user']['id'];
session_start();
class commentC
{
    public function addcmnt()
    {
        $id = $_POST["idBlogcmnt"];
        $content = $_POST["contenu"];

        try {
            $idSession = $_SESSION['user']['id'];
            $sql = "INSERT INTO commentaires (idBlog, contenu,idSession) VALUES (:idBlog, :contenu ,:idSession)";
            $db = config::getConnection();
            $query = $db->prepare($sql);

            $query->bindValue('idBlog', (int)$id);

            $query->bindValue('contenu', $content);
            $query->bindValue('idSession', $idSession);
            $query->execute();
            header("Location: http://localhost/projet/views/frontoffice/showcmnt.php?idBlog=" . $id);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function displaycmnts()
    {
        try {
            $sql = "SELECT * from commentaires";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function showcmnts($idBlog)
    {
        try {
            $sql = "SELECT * FROM commentaires WHERE idBlog = :idBlog ";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('idBlog', $idBlog);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    public function showbtns(int $idCommentaire)
    {
        try {
            $idSession = $_SESSION['user']['id'];
            echo $idSession;
            echo $idCommentaire;
            $sql = "SELECT * FROM commentaires WHERE idSession = :idSession  && idCommentaire = :idCommentaire";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('idSession', $idSession);
            $query->bindValue('idCommentaire', $idCommentaire);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($query->rowCount() >= 1) {
                return true;
            } else {
                return false;
            }

            // return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function deletecmnt($idCommentaire)
    {

        // $comment_id = $_POST['comment_id'];

        try {
            $sql = "DELETE FROM commentaires WHERE idCommentaire=:comment_id";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(':comment_id', $idCommentaire);
            $query->execute();
            header("Refresh:0");
            // header('Location: http://localhost/integ0/views/frontoffice/showcmnt.php?idBlog='.$idBlog);

        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function getcmntById($idCommentaire)
    {
        try {
            $sql = "SELECT * from commentaires where idCommentaire=?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idCommentaire);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function updatecmnt($idCommentaire, $comment)
    {
        try {
            $sql = "UPDATE commentaires SET idBlog = :idBlog,contenu = :contenu WHERE idCommentaire = :idCommentaire";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('idBlog', $comment->getidblogcmnt());
            $query->bindValue('contenu', $comment->getcontenucmnt());
            $query->bindValue(':idCommentaire', $idCommentaire);
            $query->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
