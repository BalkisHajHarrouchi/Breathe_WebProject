<?php
require_once "C:/xampp/htdocs/Projet/config2.php";
// require_once "../models/blog.php";
class blogC
{
    public function addblog($blog)
    {
        try {
            $sql = "INSERT INTO blogs (titre, source, contenu, categorie,image) VALUES (:titre, :source, :contenu, :categorie, :image)";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('titre', $blog->gettitreblog());
            $query->bindValue('source', $blog->getsourceblog());
            $query->bindValue('contenu', $blog->getcontenublog());
            $query->bindValue('categorie', $blog->getcategorieblog());
            $query->bindValue('image', $blog->getimageblog());
            $query->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function displayblog1($idBlog)
    {
        try {
            $sql = "SELECT * from blogs WHERE idBlog = :idBlog";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('idBlog', $idBlog);
            $query->execute();

            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function displayblogs()
    {
        try {
            $sql = "SELECT * from blogs";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function deleteblog(int $idBlog)
    {
        try {
            $sql = "DELETE from blogs where idBlog = ?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idBlog);
            $query->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function getblogById($idBlog)
    {
        try {
            $sql = "SELECT * from blogs where idBlog=?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idBlog);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function updateblog($idBlog, $blog)
    {
        try {
            $sql = "UPDATE blogs SET titre = :titre, source = :source,contenu = :contenu, categorie = :categorie, image = :image WHERE idBlog = :idBlog";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('titre', $blog->gettitreblog());
            $query->bindValue('source', $blog->getsourceblog());
            $query->bindValue('contenu', $blog->getcontenublog());
            $query->bindValue('categorie', $blog->getcategorieblog());
            $query->bindValue('image', $blog->getimageblog());
            $query->bindValue(':idBlog', $idBlog);
            $query->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function trisBlog($w)
    {
        if ($w == "") {
            $sql = "SELECT * from blogs";
        } else {
            $sql = "SELECT * FROM blogs ORDER BY $w";
        }
        $db = config::getConnection();

        $query = $db->prepare($sql);
        $query->execute();

        $type =  $query->fetchAll(PDO::FETCH_ASSOC);
        return $type;
    }
    function searchBlogs($input)
    {
        $sql = "SELECT * FROM blogs WHERE titre LIKE '%" . $input . "%' OR source LIKE '%" . $input . "%' OR contenu LIKE '%" . $input . "%' OR categorie LIKE '%" . $input . "%'";
        $db = config::getConnection();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $blog = $query->fetchAll();
            return $blog;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function ecologyBlogs()
    {
        try {
            $sql = "SELECT * FROM blogs WHERE categorie = 'ecology'";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function gardenBlogs()
    {
        try {
            $sql = "SELECT * FROM blogs WHERE categorie = 'garden'";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function plantsBlogs()
    {
        try {
            $sql = "SELECT * FROM blogs WHERE categorie = 'plants'";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
