<?php 
require_once ('Technology.php');

Class AnimalHusbandry extends Technology{
    public $name = "AnimalHusbandry";
    public $cost = 25;
    public $prerequisites = array();
    public $civ;
    public $endTurn;
    public $startTurn;
    public $img = "AnimalHusbandry.png";

    public function __construct($civ,$startTurn){
        $this->civ = $civ;
        $this->startTurn = $startTurn;
    }
}