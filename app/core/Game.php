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
  
  public function generateCivilization($number=2){
  	for ($i = 0 ; $i < $number ; $i++){
  		$this->civs[$i] = new Civilization();
  		$settler = new Settler();
  		$this->civs[$i]->addUnit($settler);
  		$this->world->addUnit($settler);		
  	}
  }
  
  public function turn(){
  	//Natural Events
  	//Babarian moves
  	print $this->turn;
	$this->turn++;
  	foreach ($this->civs as $civ){
  		$civ->turn();
  	}
	print $this->render->render($this->world);
  }

  public function newGame(){
	$w = $this->world;
	$w->generateTerrain();
	$w->generateFeatures();
	$w->generateBonus();
	$this->generateCivilization();
	#generateBarabarian
  }

}
$game = new Game();
$game->newGame();
$game->turn();
