<?php
class playlist {

    public $idp;
    public $name;
    public $userId;
    public $tracks;

    public function __construct($idp,$name,$userId,array $tracks){
    $this->$idp = $idp;
    $this->$name = $name;
    $this->$userId = $userId;
    $this->$tracks = $tracks;
    }
    
    public function addTracks($elem){
      $tracks[]=$elem;
    }
    

}
?>