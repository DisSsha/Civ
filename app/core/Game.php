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
	 $this->render = new Render($this);
  }
  
  public function generateCivilization($number=2){
  	for ($i = 0 ; $i < $number ; $i++){
  		$this->civs[$i] = new Civilization($this);
  		$settler = new Settler();
      $settler->setCiv($this->civs[$i]);
  		$this->civs[$i]->addUnit($settler);
  		$this->world->setUnit($settler);		
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

  public function newGame($x=10,$y=10){
  	$this->world = new World($x,$y);
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
        $reply = $pdo->query("INSERT INTO `game` (`id`, `turn`, x, y) VALUES (NULL, '".$this->turn."','".$this->world->x."','".$this->world->y."' );");
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

  public function load($pdo,$worldId,$turn){
    $this->id = $worldId;
    $this->turn = $turn;
    $reply = $pdo->query("SELECT x,y from `game` where id=".$worldId." ;");
    $data = $reply->fetch();

    $this->world = new World($data["x"],$data['y']);
    $this->world->load($pdo,$worldId,$turn);

    $reply = $pdo->query("SELECT * from `civs` where game_id=".$worldId." ;");
    $data = $reply->fetchAll();
    $i = 0;
    foreach ($data as $key => $value) {
      $civ = new Civilization($this);
      $civ->id = $data[$key]["id"];
      $this->civs[$i] = $civ;
      $this->civs[$i]->load($pdo,$this->id,$this->turn);
      $i++;
    }
  }

}
