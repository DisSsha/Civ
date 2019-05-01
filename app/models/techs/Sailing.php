<?php 
require_once ('Technology.php');

Class Sailing extends Technology{
    public $name = "Sailing";
    public $cost = 50;
    public $prerequisites = array();
    public $civ;
    public $endTurn;
    public $startTurn;
    public $img = "Sailing.png";

    public function __construct($civ,$startTurn){
        $this->civ = $civ;
        $this->startTurn = $startTurn;
    }
}