<?php 

require_once ('Cell.php');

require_once ('models/terrains/Grassland.php');

require_once ('models/features/Woods.php');

require_once ('models/units/Settler.php');

class World {

	public $grid = array();
	public $x;
	public $y;
	public $terrainsList ;

	public $featuresList ;

	function __construct($x,$y){
		$this->y = $y;
		$this->x = $x;
		$this->unitList = array (
									"Settler" => new Settler()
							);
		$this->terrainsList = array ( 
										"Grassland" => new Grassland(), 
									//	"Plains" 	=> new Plains(), 
									//	"Desert" 	=> new Desert(), 
									//	"Snow" 		=> new Snow(),
									//	"Coast" 	=> new Coast(), 
									//	"Lake" 		=> new Lake(), 
									//	"Ocean" 	=> new Ocean() 
									);

		$this->featuresList = array ( 
										"Woods" 		=> new Woods(),
									//	"Plains"		=> new Rainforest(),
									//	"Marsh"			=> new Marsh(),
									//	"Floodplains" 	=> new Floodplains(),
									//	"Oasis" 		=> new Oasis(),
									//	"Mountains"		=> new Mountains(),
									//	"Cliffs"		=> new Cliffs(),
									//	"Reef" 			=> new Reef(),
									//	"Ice" 			=> new Ice(),
									//	"Volcano"		=> new Volcano(),
									 );

		for ( $i = 0 ; $i < $x ; $i++){
			for ( $j = 0; $j < $y ; $j++){
				$this->grid[$i][$j] = new Cell($i,$j);
			}
		}
	}

	public function generateTerrain($type="random"){		
		if ($type == "random"){
			$maxRand = sizeof($this->terrainsList)-1;
			$keys = array_keys($this->terrainsList);
			for ( $i = 0 ; $i < $this->x ; $i++){
				for ( $j = 0; $j < $this->y ; $j++){
					$index = $keys[rand(0,$maxRand)];
					$this->grid[$i][$j]->setTerrain($this->terrainsList[$index]);
				}
			}		
		}	
	}

	public function getCell($x,$y){
		return $this->grid[$x][$y];
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
				$this->grid[$i][$j]->setBonus();
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

	public function save($pdo,$worldId,$turn){
		for ( $i = 0 ; $i < $this->x ; $i++){
			for ( $j = 0; $j < $this->y ; $j++){
				$this->grid[$i][$j]->save($pdo,$worldId,$turn);
			}
		}
	}

	public function load($pdo,$worldId,$turn){
		for ( $i = 0 ; $i < $this->x ; $i++){
			for ( $j = 0; $j < $this->y ; $j++){
				$this->grid[$i][$j]->load($pdo,$worldId,$turn);
			}
		}
	}
}
