<?php

namespace app\models\features;

abstract class Feature {

	public $name;
	public $movement;
	// Cultural,Science,Gold,Faith,Production,Food
	public $baseYield;
	public $img;

	public function __construct(){
			$this->name = (new \ReflectionClass($this))->getShortName();
			$this->img = strtolower($this->name)).'.png';
			$this->init();
	}

	public function init();
}
