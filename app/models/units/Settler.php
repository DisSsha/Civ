<?php


namespace app\models\units;
use \app\models\units\Unit;
use \app\models\actions\Move;
#require_once('models/actions/Move.php');
#require_once('Unit.php');

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
