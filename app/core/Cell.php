<?php 

class Cell {
	private $x;
	private $y;
	private $terrain;
	private $feature;
	// Strategic, Bonus or Luxury
	private $bonus;

	function __construct($x,$y){
		$this->x = $x;
		$this->y = $y;
	}

	public function setTerrain($terrain){
		$this->terrain = $terrain;
	}

	public function toString(){
		return "[".$this->terrain->name[0].$this->feature[0]."]";
	}

	public function addFeature(){
		if (rand(0,100) > 75){
			$featureAllowed = $this->terrain->featureAllowed;
			$randomFeat = rand(0,sizeof($featureAllowed)-1);
			$this->feature = $featureAllowed[$randomFeat];
		}
	}

	public function addBonus(){
		if (rand(0,100) > 75){
			$bonusAllowed = $this->terrain->bonusAllowed;
			$randomFeat = rand(0,sizeof($bonusAllowed)-1);
			$this->feature = $bonusAllowed[$randomFeat];
		}
	}
}