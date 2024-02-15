<?php
class ticket{
    private int $idTicket ;
    private int $idEvent ;
    private \DateTime $dateTicketExp;   
    private bool $vendu;
    private  $codeTicket;
    private string $detailTicket;
    
   

    public function getidTicket(){
        return $this->idTicket;
    }
    public function getidEvent(){
        return $this->idEvent;
    }
    public function getdateTicketExp (){
        return $this->dateTicketExp;
    }
    
    public function getvendu (){
        return $this->vendu;
    }
    public function getcodeTicket (){
        return $this->codeTicket;
    }
    public function getdetailTicket (){
        return $this->detailTicket;
    }
   
    public function __construct(int $idEvent=0,\DateTime $dateTicketExp=new DateTime("now"),bool $vendu=false,$codeTicket,$detailTicket=''){
        $this->idEvent=$idEvent;
        $this->dateTicketExp=$dateTicketExp;    
        $this->vendu=$vendu;
        $this->codeTicket=$codeTicket;
        $this->detailTicket=$detailTicket;
    }
}
?>