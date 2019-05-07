<?php

namespace app\models\terrains;
use \app\models\terrains\Terrain;

require_once ('Terrain.php');

class Grassland extends Terrain{
		public $featureAllowed = array(
																"Woods",
																//"Hills",
																//"Mountains",
																//"Marsh",
															);
	public $bonusAllowed = 	array(
														"Truc",
														"X",
														"Z"
													);
	public $baseYield = array(
												'food' => 2
											);
}
