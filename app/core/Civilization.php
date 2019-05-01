<?php

require_once ('models/units/Settler.php');


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

	/** Name
		inherit bonus (2)
		Military cards
		Economic cards
		Diplomatic cards
		Wild cards
	*/
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
  }
  
  // take a list of object and return only one
  public function choose($things){// TODO choose base on traits
    if(size($things) == 0){
      print "Error : can't choose($things) arg is empty !";
    }
    return $things[0]; 
  }

  public function tech(){
    if ($ongoingTechnology == null){  // First turn
      $this->pickTechnology();
    }
    $this->ongoingTechnology->search($this->turnScience)
    if ($this->ongoingTechnology->cost <= 0){ // Technology unlocked
      $this->unlockedTechonologies[] = $ongoingTechnology;
      $this->pickTechnology();
    }
  }

  public function prepareTurn(){
    $this->turnScience = 0;
    foreach ($this->cities as $cityname => $city){
      $this->turnScience += $city->science;
      $this->gold += $city->gold;
    }
  }

  public function cities(){
    foreach ($this->cities as $name => $city){
      $city->turn();
    }
  }

  public function units(){
    foreach ($this->units as $name => $unit){
      $unit->turn();
    }
  }

		/**
			> Global to local
			Tech
			Cultural
			Government
			Cities turns
				Building to make
			Units turns
		*/
	public function turn(){
    $this->prepareTurn();
    $this->tech();
    //$this->cult();
    //$this->gov();
    $this->cities();
    $this->units();
	}

	public function save($pdo,$worldId,$turn){
		if ($this->id == null){
			$reply = $pdo->query("INSERT INTO `civs` (`id`, `game_id`) VALUES (NULL, '".$worldId."' );");
        	$this->id = $pdo->lastInsertId();
		}
		foreach ($this->units as $key => $value) {
			$this->units[$key]->save($pdo,$worldId,$turn);
		}
		foreach ($this->cities as $key => $value){
			$this->cities[$key]->save($pdo,$worldId,$turn);
		}
		//save Civ state (gold etc)

	}

	public function load($pdo,$worldId,$turn){
		$reply = $pdo->query("SELECT * from `units` where civ_id=".$this->id." AND game_id=".$worldId.";");
		$data = $reply->fetchAll();
		foreach ($data as $key => $value) {
			$unit = new $value["name"];
			$unit->x = $value['x'];
			$unit->y = $value['y'];
			$this->addUnit($unit);
			$this->game->world->addUnit($unit,$unit->x,$unit->y);
		}
	}


}
