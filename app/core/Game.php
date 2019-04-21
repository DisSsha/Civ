<?php 

require_once ('World.php');
require_once ('Civilization.php');
require_once ('models/units/Settler.php');
require_once ('Render.php');

class Game {
  
  public $turn = 0;
  public $world ;
  public $civs =array();
  public $techtree = array();
  public $culttree = array();
  public $render;
  public $id = null;

  public function __construct($x=10,$y=10){
	$this->world = new World($x,$y);
	$this->render = new Render($this);
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
  }

  public function render(){
    return $this->render->render($this->world);
  }

  public function newGame(){
  	$w = $this->world;
  	$w->generateTerrain();
  	$w->generateFeatures();
  	$w->generateBonus();
  	$this->generateCivilization();
  	#generateBarabarian
  }

  public function save($pdo){
    if ($this->id == null){
      try{
        $reply = $pdo->query("INSERT INTO `game` (`id`, `turn`) VALUES (NULL, '".$this->turn."');");
        $this->id = $pdo->lastInsertId();
        $this->world->save($pdo,$this->id,$this->turn);
        foreach ($this->civs as $key => $value) {
          $value->save($pdo,$this->id,$this->turn);
        }
        //TODO same with techtree : cultree
      }catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
      }      
    }
  }

}
