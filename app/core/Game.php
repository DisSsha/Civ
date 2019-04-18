<?php 

require_once ('World.php');
require_once ('Civilization.php');
require_once ('../models/units/Settler.php');

$turn = 0;
$world = new World(10,10);
$civs =array();
$techtree = array();
$culttree = array();

function generateCivilization($number=2){
	global $world,$civs;
	for ($i = 0 ; $i < $number ; $i++){
		$civs[$i] = new Civilization();
		$settler = new Settler();
		$civs[$i]->addUnit($settler);
		$world->addUnit($settler);		
	}
}

function render(){
	global $turn;
	print $turn;
	$world->printWorld();
}

function turn(){
	//Natural Events
	//Babarian moves
	foreach ($civs as $civ){
		$civ->turn();
	}
}

$world->generateTerrain();
$world->generateFeatures();
$world->generateBonus();
generateCivilization();
#generateBarabarian
$world->printWorld();
while (true){
	turn();
	$turn++;
	render();
	sleep (15);
}
