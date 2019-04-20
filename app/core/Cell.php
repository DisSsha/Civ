<?php 

class Cell {
	private $x;
	private $y;
	private $terrain;
	private $feature;
	private $units = array();
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

	public function toString(){
		return "[".$this->terrain->name[0].$this->feature[0].$this->bonus[0].sizeof($this->units)."]";
	}

	public function setFeature(){
		if (rand(0,100) > 75){
			$featureAllowed = $this->terrain->featureAllowed;
			$randomFeat = rand(0,sizeof($featureAllowed)-1);
			$this->feature = $featureAllowed[$randomFeat];
		}
	}
	
	public function getFeature(){
		return $this->feature;
	}

	public function setBonus(){
		if (rand(0,100) > 75){
			$bonusAllowed = $this->terrain->bonusAllowed;
			$randomFeat = rand(0,sizeof($bonusAllowed)-1);
			$this->bonus = $bonusAllowed[$randomFeat];
		}
	}

	public function addUnit($unit){
		$this->units[] = $unit;
		$unit->setLocation($this->x,$this->y);
	}
}
