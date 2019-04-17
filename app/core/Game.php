<?php 

require_once ('World.php');
require_once ('Civilization.php');
require_once ('../models/units/Settler.php');

$turn = 0;
$world = new World(10,10);
$civs =array();

function generateCivilization($number=1){
	global $world,$civs;
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
