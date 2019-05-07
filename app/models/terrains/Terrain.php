<?php

namespace app\models\terrains;


abstract class Terrain {
	public $name;
	public $featureAllowed;
	public $bonusAllowed;
	public $movement;
	// Cultural,Science,Gold,Faith,Production,Food
	public $baseYield;
	public $img;

	public function __construct(){
			$this->name = (new \ReflectionClass($this))->getShortName();
			$this->img = strtolower($this->name).'.png';
	}
}
