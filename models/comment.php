<?php
class comment{
    private int $idCommentaire ;
    private int $idBlog ;
    private string $contenu;
   

    public function getidcmnt (){
        return $this->idCommentaire;
    }
    public function getidblogcmnt (){
        return $this->idBlog;
    }
    public function getcontenucmnt (){
        return $this->contenu;
    }
   
    
    public function __construct(int $idBlog,string $contenu){
        $this->idBlog=$idBlog;
        $this->contenu=$contenu;
       
    }
}