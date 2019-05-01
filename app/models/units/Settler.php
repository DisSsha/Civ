<?php 

require_once('Unit.php');
require_once('../actions/Move.php');


class Settler extends Unit {

	public $img = "settler.png";
	public $movement = 2;
	public $name = "Settler";
	public $health = 100;
	public $cost = 80;

	public function __construct(){
		$this->actions = new Move();
	}
	
}