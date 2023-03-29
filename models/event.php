<?php
class event{
    private int $idEvent ;
    private string $nom;
    private string $type;
    private string $lieu;
    private \DateTime $dateEvent;
    private string $decription;
    private int $nbPlaces;

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
    public function getdateEvent (){
        return $this->dateEvent;
    }
    public function getdescriptionEvent (){
        return $this->decription;
    }
    public function getnbPlacesEvent (){
        return $this->nbPlaces;
    }
    public function __construct(string $nom='',string $type='',string $lieu='',\DateTime $dateEvent=new DateTime("now"),string $decription='',int $nbPlaces=0){
        $this->nom=$nom;
        $this->type=$type;
        $this->lieu=$lieu;
        $this->dateEvent=$dateEvent;
        $this->decription=$decription;
        $this->nbPlaces=$nbPlaces;
    }
}
