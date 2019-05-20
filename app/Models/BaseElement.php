<?php

namespace App\Models;


class BaseElement implements Printable{
    public $title;
    public $description;
    public $months;
    public $filename;
    public $visible = true;

    public function __construct($title,$description){
        $this->title = $title;
        $this->description = $description;
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