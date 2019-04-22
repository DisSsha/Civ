<?php

abstract class Unit{

	public $x;
	public $y;
	public $civ;
	public $name;
	public $img;
	public $movement;

	public function setLocation($x,$y){
		$this->x = $x;
		$this->y = $y;
	}

	public function setCiv($civ){
		$this->civ = $civ;
	}

}