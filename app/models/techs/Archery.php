<?php 
require_once ('Technology.php');

Class Archery extends Technology{
    public $name = "Archery";
    public $cost = 50;
    public $prerequisites = array("AnimalHusbandry");
    public $civ;
    public $endTurn;
    public $startTurn;
    public $img = "Archery.png";

    public function __construct($civ,$startTurn){
        $this->civ = $civ;
        $this->startTurn = $startTurn;
    }
}