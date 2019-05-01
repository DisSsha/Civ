<?php 
require_once ('Technology.php');

Class Mining extends Technology{
    public $name = "Mining";
    public $cost = 25;
    public $prerequisites = array();
    public $civ;
    public $endTurn;
    public $startTurn;
    public $img = "Mining.png";

    public function __construct($civ,$startTurn){
        $this->civ = $civ;
        $this->startTurn = $startTurn;
    }
}