<?php
class categR{
    private int $idCateg_re  ;
    private string $nomCateg;
    private string $description;
    private int $nbr_demande;
    private $image;

    public function getidCateg_re (){
        return $this->idCateg_re ;
    }
    public function getnomCateg(){
        return $this->nomCateg;
    }
    public function getdescription (){
        return $this->description;
    }
    public function getnbr_demande (){
        return $this->nbr_demande;
    }
    public function getimage (){
        return $this->image;
    }
    public function __construct(string $nomCateg='',string $description='',int $nbr_demande=0, $image){
        $this->nomCateg=$nomCateg;
        $this->description=$description;
        $this->nbr_demande=$nbr_demande;
        $this->image=$image;
    }
}
?>