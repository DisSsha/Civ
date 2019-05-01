<?php 
require_once ('Technology.php');

Class Pottery extends Technology{
    public $name = "Pottery";
    public $cost = 25;
    public $prerequisites = array();
    public $civ;
    public $endTurn;
    public $startTurn;
    public $img = "pottery.png";

    public function __construct($civ,$startTurn){
        $this->civ = $civ;
        $this->startTurn = $startTurn;
    }
}