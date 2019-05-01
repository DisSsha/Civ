<?php 
require_once ('Technology.php');

Class Irrigation extends Technology{
    public $name = "Irrigation";
    public $cost = 50;
    public $prerequisites = array("Pottery");
    public $civ;
    public $endTurn;
    public $startTurn;
    public $img = "Irrigation.png";

    public function __construct($civ,$startTurn){
        $this->civ = $civ;
        $this->startTurn = $startTurn;
    }
}