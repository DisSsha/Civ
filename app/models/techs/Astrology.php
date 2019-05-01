<?php 
require_once ('Technology.php');

Class Astrology extends Technology{
    public $name = "Astrology";
    public $cost = 50;
    public $prerequisites = array();
    public $civ;
    public $endTurn;
    public $startTurn;
    public $img = "Astrology.png";

    public function __construct($civ,$startTurn){
        $this->civ = $civ;
        $this->startTurn = $startTurn;
    }
}