<?php

namespace app\models\techs;
use \app\models\Buildable;

#require_once ('models/Buildable.php');

abstract class Technology extends Buildable{

    public $cost;
    public $civ;
    public $endTurn;
    public $startTurn;
    public $prerequisites = array();
    public $name;
    public $img;

    public function __construct(){
  			$this->name = get_class($this);
        $this->img = strtolower(get_class($this)).'.png';
    }

    //public $eureka condition
}
