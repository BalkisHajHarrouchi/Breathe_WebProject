<?php
class recy{
    private int $id_recy ;
    private int $idCateg_re  ;
    private string $type;
    private float $quantite;
    private \DateTime $date_recy;
    private string $email;

    public function getid_recy(){
        return $this->id_recy;
    }
    public function getidCateg_re(){
        return $this->idCateg_re;
    }
    public function gettype(){
        return $this->type;
    }
    public function getquantite (){
        return $this->quantite;
    }
    public function getdate_recy (){
        return $this->date_recy;
    }
    public function getemail (){
        return $this->email;
    }

    public function __construct(int $idCateg_re=0,string $type='',float $quantite=0,string $email='',\DateTime $date_recy=new DateTime("now")){
        $this->idCateg_re=$idCateg_re;
        $this->type=$type;
        $this->quantite=$quantite;
        $this->email=$email;
        $this->date_recy=$date_recy;
    }
}
?>