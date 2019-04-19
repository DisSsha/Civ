<?php 

require_once ('World.php');
require_once ('Civilization.php');
require_once ('../models/units/Settler.php');
require_once ('Render.php');

class Game {
  
  public $turn = 0;
  public $world ;
  public $civs =array();
  public $techtree = array();
  public $culttree = array();
  public $render;

  public function __construct($x=10,$y=10){
	$this->world = new World($x,$y);
	$this->render = new Render();
  }
  
  function generateCivilization($number=2){
  	for ($i = 0 ; $i < $number ; $i++){
  		$this->civs[$i] = new Civilization();
  		$settler = new Settler();
  		$this->civs[$i]->addUnit($settler);
  		$this->world->addUnit($settler);		
  	}
  }
  
  function render(){
  	print $this->turn;
  	$this->world->printWorld();
  }
  
  function turn(){
  	//Natural Events
  	//Babarian moves
  	foreach ($this->civs as $civ){
  		$civ->turn();
  	}
  }

}
$game = new Game();
$game->world->generateTerrain();
$game->world->generateFeatures();
$game->world->generateBonus();
$game->generateCivilization();
#generateBarabarian
$game->world->printWorld();
$game->turn();
$game->render();
