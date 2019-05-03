<?php
require_once ('models/Buildable.php');

abstract class Technology extends Buildable{

    public $name = array_pop(explode('\\', __CLASS__));
    public $cost;
    public $civ;
    public $endTurn;
    public $startTurn;
    public $img = "$name.png";
    public $prerequisites = array();
    //public $eureka condition
}
