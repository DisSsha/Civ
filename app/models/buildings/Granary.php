<?php 

require_once('Building.php');

class Granary extends Building {

	public $name = "Granary";
    public $health = 100;
    public $cost = 65;
    public $img = "granary.png";
    public $bonus = array("Food"=> 1,"Housing"=> 2);
    public $prerequisites = array("Pottery");
	
}