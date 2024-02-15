<?PHP
	class categorie
    {
       private $idCtegorie= null;
       private $description= null;
       private $nom_cles= null;
       private $marque= null;
       private $budget= null;
       
       function __construct($description=null,$nom_cles=null,$marque=null,$budget=null)
       {
        $this->idCtegorie==null;
        $this->description=$description;
        $this->nom_cles=$nom_cles;
        $this->marque=$marque;
        $this->budget=$budget;
       }

       function setdesc($description)
       {
         $this->description=$description;
       }
       function setid($idCtegorie)
       {
         $this->idCtegorie=$idCtegorie;
       }
       
       function setnom($nom_cles)
       {
         $this->nom_cles=$nom_cles;
       }
       function setmarq($marque)
       {
         $this->marque=$marque;
       }
       function setbudget($budget)
       {
         $this->budget=$budget;
       }
     
       function getdesc(){
         return $this->description;
       }
     
     
     function getid(){
         return $this->idCtegorie;
     }

     function getnom(){
        return $this->nom_cles;
    }

    function getmarq(){
        return $this->marque;
    }

    function getbudget(){
        return $this->budget;
    }


    }
?>