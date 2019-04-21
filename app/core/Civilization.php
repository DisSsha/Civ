<?php



class Civilization {
	
	private $leader;
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

	}


}
