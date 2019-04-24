<?php



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

	public function __construct(){

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
			$reply = $pdo->query("INSERT INTO `civ` (`id`, `turn`, x, y) VALUES (NULL, '".$this->turn."','".$this->world->x."','".$this->world->y."' );");
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


}
