<?php
class event{
    private int $idEvent ;
    private string $nom;
    private string $type;
    private string $lieu;
    private \DateTime $dateEventStart;
    private \DateTime $dateEventEnd;
    private string $decription;
    private int $nbPlaces;
    private float $prixEvent;
    private $image;


    public function getidEvent(){
        return $this->idEvent;
    }
    public function getnomEvent (){
        return $this->nom;
    }
    public function gettypeEvent (){
        return $this->type;
    }
    public function getlieuEvent (){
        return $this->lieu;
    }
    public function getdateEventStart (){
        return $this->dateEventStart;
    }
    public function getdateEventEnd (){
        return $this->dateEventEnd;
    }
    public function getdescriptionEvent (){
        return $this->decription;
    }
    public function getnbPlacesEvent (){
        return $this->nbPlaces;
    }
    // public function getinteret (){
    //     return $this->interet;
    // }
    public function getimage (){
        return $this->image;
    }
    public function getprixEvent (){
        return $this->prixEvent;
    }
    // public function getnbDispo (){
    //     return $this->nbDispo;
    // }
    public function __construct(string $nom='',string $type='',string $lieu='',\DateTime $dateEventStart=new DateTime("now"),$dateEventEnd=new DateTime("now"),string $decription='',int $nbPlaces=0, $image, $prixEvent=0){
        $this->nom=$nom;
        $this->type=$type;
        $this->lieu=$lieu;
        $this->dateEventStart=$dateEventStart;
        $this->dateEventEnd=$dateEventEnd;
        $this->decription=$decription;
        $this->nbPlaces=$nbPlaces;
        $this->image=$image;
        $this->prixEvent=$prixEvent;
        // $this->nbDispo=$nbPlaces;

    }
}
?>