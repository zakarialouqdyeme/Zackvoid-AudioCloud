<?php
class tracks
{

    public $idt;
    public $title;

    public function __construct($idt, $title)
    {
        $this->idt = $idt;
        $this->title = $title;
    }
}

class apiTrack extends tracks
{

   
    public $description;
    public $url;
    public $image;

    public function __construct($idt, $title, $image, $description, $url)
    {
        parent::__construct($idt, $title);
        $this->image = $image;
        $this->description = $description;
        $this->url = $url;
    }
}
