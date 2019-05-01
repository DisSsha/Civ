<?php

abstract class Unit{

	public $x;
	public $y;
	public $civ;
	public $name;
	public $img;
	public $movement;
	public $health;

	public function setLocation($x,$y){
		$this->x = $x;
		$this->y = $y;
	}

	public function setCiv($civ){
		$this->civ = $civ;
	}

	public function save($pdo,$worldId,$turn){
		$pdo->query("INSERT INTO `units` (`id`, `game_id`,`civ_id`, `x`,`y`,`name`,`health`,`turn`) VALUES (NULL, '".$worldId."', '".$this->civ->id."','".$this->x."','".$this->y."','".$this->name."','".$this->health."','".$turn."');");
	}

	

}
