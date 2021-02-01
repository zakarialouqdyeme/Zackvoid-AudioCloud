<?php
class track {

    public $idp;
    public $idt;
    public $title;

    public function __construct($idp,$idt,$title){
    $this->$idp = $idp;
    $this->$idt = $idt;
    $this->$title = $title;
    }
    
    

}