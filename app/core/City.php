<?php

namespace app\core;

class City {

    public $building = array();
    public $loyalty = 100;
    public $pop = 1;
    public $radius = 1;
    public $x;
    public $y;
    public $job = null;
    public $cell;

    public function __construct($cell,$civ){
        $this->x = $cell->x;
        $this->y = $cell->y;
        $this->cell = $cell;
    }

    public function getFood(){
        return 2;
    }

    public function getScience(){
        return $this->pop;
    }

    public function getProduction(){
        return 1;
    }

    public function getGold(){
        //take gold from surrinding cells in radius
        //take gold from buildings income
        //substract gold from building maintenance
        return 0;
    }
}
