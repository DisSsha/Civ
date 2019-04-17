<?php 

require_once ('World.php');
require_once ('Civilization.php');
require_once ('units/Settler.php');

public turn = 0;
public $world = new World(10,10);
public $civs = new array();

public function generateCivilization($number=1){
	for ($i = 0 ; $i < $number ; $i++){
		$civs[$i] = new Civilization();
		$settler = new Settler();
		$civs[$i]->addUnit($settler);
		$world->addUnit($settler);		
	}
}


$world->generateTerrain();
$world->generateFeatures();
$world->generateBonus();
generateCivilization();
$world->printWorld();