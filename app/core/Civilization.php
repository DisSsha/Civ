<?php

require_once ('models/units/Settler.php');


class Civilization {
	
	//purpose
	private $agenda;
	private $Civbonus;
	private $cities = array();
	private $units = array();
	private $gold = 0;
	private $faith = 0;
	private $tradeRoadLimit = 0;
	private $strategicRessources ;
	private $unlockedTechnologies;
	private $ongoingTechnology;
	private $ongoingCultural;
	private $unlockedCultural;
	private $id;
	public $game;

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

	public function turn(){
		/**
			> Global to local
			Tech
			Cultural
			Government
			Cities turns
				Building to make
			Units turns
		*/
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
		$reply = $pdo->query("SELECT * from `units` where civ_id=".$this->civ->id." AND game_id=".$worldId.";");
		$data = $reply->fetch();
		foreach ($data as $key => $value) {
			$unit = new $data["name"];
			$unit->x = $data['x'];
			$unit->y = $data['y'];
			$this->addUnit($unit);
			$this->game->world->addUnit($unit);
		}
	}


}
