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


    //public $eureka condition
}
