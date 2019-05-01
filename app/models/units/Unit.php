<?php

require ('../Buildable.php');

abstract class Unit extends Buildable{

	public $x;
	public $y;
	public $civ;
	public $name;
	public $img;
	public $movement;
	public $health;
	public $actions= array();
	public $startTurn;
	public $endTurn;

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

	public function getActionsAvailable(){
		$reply = array();
		foreach ($this->actions as $name => $act){
			if ($act->possible){
				$reply[$name] = $act;
			}
		}
		return $reply;
	}
}
