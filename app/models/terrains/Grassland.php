<?php

require_once ('Terrain.php');

class Grassland extends Terrain{
	public $name = "Grassland";
	public $featureAllowed = array(
							"Woods",
							"Hills",
							"Mountains",
							"Marsh");
	public $bonusAllowed = array(
							"Truc",
							"X",
							"Z");
	function __construct(){}

}