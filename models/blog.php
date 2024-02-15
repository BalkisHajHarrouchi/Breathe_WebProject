<?php
class blog{
    private int $idBlog ;
    private string $titre;
    private string $source;
    private string $contenu;
    private string $categorie;
    private $image;

    public function getidBlog (){
        return $this->idBlog;
    }
    public function gettitreblog (){
        return $this->titre;
    }
    public function getsourceblog (){
        return $this->source;
    }
    public function getcontenublog (){
        return $this->contenu;
    }
    public function getcategorieblog (){
        return $this->categorie;
    }
    public function getimageblog (){
        return $this->image;
    }
    
    public function __construct(string $titre='',string $source='',string $contenu='',string $categorie='',$image=''){
        $this->titre=$titre;
        $this->source=$source;
        $this->contenu=$contenu;
        $this->categorie=$categorie;
        $this->image=$image;
    }
}