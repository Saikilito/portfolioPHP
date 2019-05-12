<?php

namespace App\Models;


class BaseElement implements Printable{
    public $title;
    public $description;
    public $visible = true;
    public $months;

    public function __construct($title,$description){
        $this->title = $title;
        $this->description = $description;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title ;
    }

    public function getDurationAsString(){
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12 ;

        return "$years years $extraMonths months";
    }

    public function getDescription(){
        return $this->description;
    }
}

?>