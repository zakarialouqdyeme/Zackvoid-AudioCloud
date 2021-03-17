<?php
class playlist {

    public $idp;
    public $name;
    public $userId;
    public $tracks;

    public function __construct(array $data){
      $this->idp = $data["idp"];
      $this->name = $data["name"];
      $this->userId = $data["userId"];
      $this->tracks = array();
    }
    

}

?>