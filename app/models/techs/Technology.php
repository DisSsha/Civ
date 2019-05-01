<?php
require_once ('models/Buildable.php');

abstract class Technology extends Buildable{

    public $name;
    public $cost;
    public $civ;
    public $endTurn;
    public $startTurn;
    public $img;
    //public $eureka condition
}
