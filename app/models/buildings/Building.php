<?php

require ('../Buildable.php');

abstract class Building extends Buildable{

	public $name;
	public $city;
	public $startTurn;
	public $endTurn;

	public function setCity($city){
		$this->city = $city;
	}

	public function save($pdo,$worldId,$turn){
		//$pdo->query("INSERT INTO `buildings` (`id`, `game_id`,`civ_id`, `x`,`y`,`name`,`health`,`turn`) VALUES (NULL, '".$worldId."', '".$this->civ->id."','".$this->x."','".$this->y."','".$this->name."','".$this->health."','".$turn."');");
	}

}
