<?php 
require_once ('Technology.php');

Class Writing extends Technology{
    public $name = "Writing";
    public $cost = 50;
    public $prerequisites = array("Pottery");
    public $civ;
    public $endTurn;
    public $startTurn;
    public $img = "Writing.png";

    public function __construct($civ,$startTurn){
        $this->civ = $civ;
        $this->startTurn = $startTurn;
    }
}