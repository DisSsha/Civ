<?php 

require_once ('Cell.php');
require_once ('../models/terrains/Grassland.php');
require_once ('../models/terrains/Terrain.php');

class World {

	private $grid = array();
	private $x;
	private $y;
	//private $terrainsList = array ( "Grassland");
	private $terrainsList ;
						/**new Plains(),
						new Desert(),
						new Tundra()),
						new Snow(),
						new Coast(),
						new Lake(),
						new Ocean()
					);*/

	private $featuresList = array (
							"Woods",
							"Rainforest",
							"Marsh",
							"Floodplains",
							"Oasis",
							"Mountains",
							"Cliffs",
							"Reef",
							"Ice",
							"Cataract",
							"Volcano",
							"Volcanic Soil",
							"Geothermal Fissure");

	function __construct($x,$y){
		$this->y = $y;
		$this->x = $x;
		$this->terrainsList = array ( new Grassland());

		for ( $i = 0 ; $i < $x ; $i++){
			for ( $j = 0; $j < $y ; $j++){
				$this->grid[$i][$j] = new Cell($i,$j);
			}
		}
	}

	public function generateTerrain($type="random"){		
		if ($type == "random"){
			$maxRand = sizeof($this->terrainsList)-1;
			for ( $i = 0 ; $i < $this->x ; $i++){
				for ( $j = 0; $j < $this->y ; $j++){
					$this->grid[$i][$j]->setTerrain($this->terrainsList[rand(0,$maxRand)]);
				}
			}		
		}	
	}

	public function generateFeatures(){
		for ( $i = 0 ; $i < $this->x ; $i++){
			for ( $j = 0; $j < $this->y ; $j++){
				$this->grid[$i][$j]->addFeature();
			}
		}			
	}

	public function generateBonus(){
		for ( $i = 0 ; $i < $this->x ; $i++){
			for ( $j = 0; $j < $this->y ; $j++){
				$this->grid[$i][$j]->addBonus();
			}
		}
	}
	public function addUnit($unit,$x=-1,$y=-1){
		if ($x == -1 && $y == -1){
			$x = rand(0,$this->x-1);
			$y = rand(0,$this->y-1);
		}
		$this->grid[$x][$y]->addUnit($unit);		
		
	}
	public function printWorld(){
		for ( $i = 0 ; $i < $this->x ; $i++){
			for ( $j = 0; $j < $this->y ; $j++){
				print ($this->grid[$i][$j]->toString());
			}
			print ("\n");
		}
	}

}
