<?php

namespace app\models\features;

abstract class Feature {

	public $name;
	public $movement;
	public $baseYield;
	public $img;

	public function __construct(){
			$this->name = (new \ReflectionClass($this))->getShortName();
			$this->img = strtolower($this->name).'.png';
	}

}
