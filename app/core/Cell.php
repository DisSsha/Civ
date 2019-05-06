<?php

class Cell {
	private $x;
	private $y;
	private $terrain;
	private $feature;
	private $units=null;
	private $id = "NULL";
	// Strategic, Bonus or Luxury
	private $bonus;

	function __construct($x,$y){
		$this->x = $x;
		$this->y = $y;
	}

	public function setTerrain($terrain){
		$this->terrain = $terrain;
	}

	public function getTerrain(){
		return $this->terrain;
	}

	public function addFeature(){
		if (rand(0,100) > 75){
			$featureAllowed = $this->terrain->featureAllowed;
			$randomFeat = rand(0,sizeof($featureAllowed)-1);
			$this->feature = new $featureAllowed[$randomFeat]();
		}
	}

	public function getFeature(){
		return $this->feature;
	}

	public function getUnit(){
		return $this->units;
	}

	public function setBonus(){
		if (rand(0,100) > 75){
			$bonusAllowed = $this->terrain->bonusAllowed;
			$randomFeat = rand(0,sizeof($bonusAllowed)-1);
			$this->bonus = $bonusAllowed[$randomFeat];
		}
	}

	// TODO handle unit per tile
	public function addUnit($unit){
		$this->units = $unit;
		$unit->setLocation($this->x,$this->y);
	}

	public function save($worldId,$turn){
		$pdo = Database::getInstance();
		$feature = null;
		if ($this->feature != null){
			$feature = $this->feature->name;
		}
		print "INSERT INTO `cells` (`id`, `game_id`,`turn`, `x`, `y`, `terrain`, `feature`, `bonus`) VALUES ('".$this->id."', '".$worldId."','".$turn."', '".$this->x."', '".$this->y."', '".$this->terrain->name."', '".$feature."', 'BONUSTODO') ON DUPLICATE KEY UPDATE;";
		$pdo->query("INSERT INTO `cells` (`id`, `game_id`,`turn`, `x`, `y`, `terrain`, `feature`, `bonus`) VALUES ('".$this->id."', '".$worldId."','".$turn."', '".$this->x."', '".$this->y."', '".$this->terrain->name."', '".$feature."', 'BONUSTODO') ON DUPLICATE KEY UPDATE;");
	}

	public function load($worldId,$turn){
		$pdo = Database::getInstance();
		$reply = $pdo->query("SELECT * from `cells` where x=".$this->x." AND y=".$this->y." AND game_id=".$worldId." AND turn=".$turn.";");
		$data = $reply->fetch();
		$this->id = $data['id'];
		$this->terrain = new $data['terrain'];
		if ($data['feature'] != null)
			$this->feature = new $data['feature'];

	}
}
