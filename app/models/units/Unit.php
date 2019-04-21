<?php

abstract class Unit{

	private $x;
	private $y;
	private $civ;

	public function setLocation($x,$y){
		$this->x = $x;
		$this->y = $y;
	}

	public function setCiv($civ){
		$this->civ = $civ;
	}

}