<?php

namespace app\core;
use app\models\units\Settler;
use app\core\City;
use \app\utils\Database;
use \app\utils\Logger;

class Civilization {

	//purpose
	public $agenda;
	public $Civbonus;
	public $cities = array();
	public $units = array();
	public $gold = 0;
	public $faith = 0;
	public $tradeRoadLimit = 0;
	public $strategicRessources = array();
	public $unlockedTechnologies = array();
	public $ongoingTechnology = null;
	public $ongoingCultural = null;
	public $unlockedCultural = array();
	public $id;
	public $game;
  public $turnScience   = 0;
  public $turnCultural  = 0;
  public $turnGold      = 0;
	public $government;
	public $unlockedCards;
	public $unlockedGovernment;
	public $CivRelationShip;

	public function __construct($game){
		$this->game = $game;
	}

	public function addUnit($unit){
		$this->units[] = $unit;
		$unit->setCiv = $this;
	}

  public function pickTechnology(){
    $AvailableTechnology = $this->game->techAvailable($this);
		$this->ongoingTechnology = $this->choose($AvailableTechnology);
		Logger::CivEvent($this,"tech",$this->ongoingTechnology);
		$this->ongoingTechnology->startTurn = $this->game->turn;
  }
  // take a list of object and return only one
  public function choose($things){// TODO choose base on traits
    if(count($things) == 0){
      print "Error : can't choose($things) arg is empty !";
    }
    return reset($things);
  }

  public function techTurn(){
    if ($this->ongoingTechnology == null){  // First turn
      $this->pickTechnology();
    }
    $this->ongoingTechnology->cost -= ($this->turnScience);
		if ($this->ongoingTechnology->cost <= 0){ // Technology unlocked
			$this->ongoingTechnology->endTurn = $this->game->turn;
      $this->unlockedTechonologies[] = $ongoingTechnology;
      $this->pickTechnology();
    }
  }

  public function prepareTurn(){
    $this->turnScience = 0;
    foreach ($this->cities as $cityname => $city){
      $this->turnScience += $city->getScience();
      $this->gold += $city->getGold;
		}
		//add cost on units
  }

	public function pickJob($city){
		$AvailableJob = $this->game->JobAvailable($this,$city);
		$city->job = $this->choose($AvailableJob);
		$city->job->startTurn = $this->game->turn;
	}

  public function citiesTurn(){
    foreach ($this->cities as $name => $city){
			if($city->job == null){
				$city->pickJob();
			}
			$city->job->build($this->getProduction());
    }
  }

  public function unitsTurn(){
    foreach ($this->units as $name => $unit){
    //  $unit->turn($this->choose($unit->getActionsAvailable()),);
    }
  }

	public function turn(){
    $this->prepareTurn();
    $this->techTurn();
    //$this->cult();
    //$this->gov();
    $this->citiesTurn();
    $this->unitsTurn();
	}

	public function save($worldId,$turn){
		$pdo = Database::getInstance();
		if ($this->id == null){
			$reply = $pdo->query("INSERT INTO `civs` (`id`, `game_id`) VALUES (NULL, '".$worldId."' );");
        	$this->id = $pdo->lastInsertId();
		}
		foreach ($this->units as $key => $value) {
			$this->units[$key]->save($worldId,$turn);
		}
		foreach ($this->cities as $key => $value){
			$this->cities[$key]->save($worldId,$turn);
		}
		//save Civ state (gold, tech,etc)

	}

	public function load($worldId,$turn){
		$pdo = Database::getInstance();
		$reply = $pdo->query("SELECT * from `units` where civ_id=".$this->id." AND game_id=".$worldId.";");
		$data = $reply->fetchAll();
		foreach ($data as $key => $value) {
			$classUnit = '\app\models\units\\'.$value["name"];
			$unit = new $classUnit;
			$unit->x = $value['x'];
			$unit->y = $value['y'];
			$this->addUnit($unit);
			$this->game->world->addUnit($unit,$unit->x,$unit->y);
		}
	}


}
