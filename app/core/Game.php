<?php

require_once ('World.php');
require_once ('Civilization.php');

require_once ('models/units/Settler.php');

require_once ('models/techs/Pottery.php');
require_once ('models/techs/AnimalHusbandry.php');
require_once ('models/techs/Mining.php');
require_once ('models/techs/Sailing.php');
require_once ('models/techs/Astrology.php');
require_once ('models/techs/Archery.php');
require_once ('models/techs/Irrigation.php');
require_once ('models/techs/Writing.php');

require_once ('models/buildings/Granary.php');

require_once ('Render.php');

class Game {

  public $turn;
  public $world ;
  public $civs =array();
  public $techList;
  public $culttree = array();
  public $render;
  public $id = null;

  public function __construct($x=10,$y=10){
    $this->turn = 0;
	  $this->render = new Render($this);
    $this->techList = array (
      "Pottery"         => new Pottery(),
      "AnimalHusbandry" => new AnimalHusbandry(),
      "Mining"          => new Mining(),
      "Sailing"         => new Sailing(),
      "Astrology"       => new Astrology(),
      "Archery"         => new Archery(),
      "Irrigation"      => new Irrigation(),
      "Writing"         => new Writing()
    );
    $this->unitList = array(
      "Settler"         => new Settler()
    );
    $this->buildingList = array(
      "Granary"         => new Granary()
    );
  }

  public function generateCivilization($number=2){
  	for ($i = 0 ; $i < $number ; $i++){
  		$this->civs[$i] = new Civilization($this);
  		$settler = new Settler();
      $settler->setCiv($this->civs[$i]);
  		$this->civs[$i]->addUnit($settler);
  		$this->world->addUnit($settler);
  	}
  }

  public function turn(){
  	//Natural Events
  	//Babarian moves
  	$this->turn++;
    foreach ($this->civs as $civ){
    		$civ->turn();
    	}
  }

  public function techAvailable($civ){
    // for each tech if the tech is
    // not unlocked
    // satisfying prerequisites
    // add it
    // return the array
    $reply = array();
    $unlocked = array_keys($civ->unlockedTechnologies);
    foreach ($this->techList as $techname => $techObj){
      if ( !in_array($techname,$unlocked) && $techObj->satisfy($unlocked)){
        $reply[$techname] = new $techname();
      }
    }
    return $reply;
  }

  public function JobAvailable($civ,$city){
    $reply = array();
    $unlocked = array_keys($civ->unlockedTechnologies);
    $built = array_keys($city->building);
    foreach($this->unitList as $unitname => $unitObj){
      if($unitObj->satisfy($unlocked)){
        $reply[$unitname] = new $unitname();
      }
    }
    foreach($this->buildingList as $buildingname => $buildingObj){
      if($buildingObj->satisfy($unlocked) && !in_array($buildingname,$built)){// TODO add condition for required infrastructures
        $reply[$buildingname] = new $buildingname();
      }
    }
    return $reply;
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

  public function save(){
    $pdo = Database::getInstance();
    if ($this->id == null){
      $reply = $pdo->query("INSERT INTO `game` (`id`, `turn`, x, y) VALUES (NULL, '".$this->turn."','".$this->world->x."','".$this->world->y."' );");
      $this->id = $pdo->lastInsertId();
    }else{
      $reply = $pdo->query("INSERT INTO `game` (`id`, `turn`, x, y) VALUES ('".$this->id."', '".$this->turn."','".$this->world->x."','".$this->world->y."' );");
    }
    $this->world->save($this->id,$this->turn);
    foreach ($this->civs as $key => $value) {
      $value->save($this->id,$this->turn);
    }
    //TODO same with techList : cultree
  }

  public function loadLastTurn($worldId){
    $pdo = Database::getInstance();
    $reply = $pdo->query("SELECT turn from `game` where id=".$worldId." ORDER by turn DESC limit 1;");
    $data = $reply->fetch();
    $turn = $data["turn"];
    $this->load($worldId,$turn);
  }

  public function load($worldId,$turn){
    $pdo = Database::getInstance();
    $this->id = $worldId;
    $this->turn = $turn;
    $reply = $pdo->query("SELECT x,y from `game` where id=".$worldId." ;");
    $data = $reply->fetch();
    $this->world = new World($data["x"],$data['y']);
    $this->world->load($worldId,$turn);
    $reply = $pdo->query("SELECT * from `civs` where game_id=".$worldId." ;");
    $data = $reply->fetchAll();
    $i = 0;
    foreach ($data as $key => $value) {
      $civ = new Civilization($this);
      $civ->id = $data[$key]["id"];
      $this->civs[$i] = $civ;
      $this->civs[$i]->load($this->id,$this->turn);
      $i++;
    }
  }

}
