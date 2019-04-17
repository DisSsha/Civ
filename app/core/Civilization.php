<?php



class Civilization {
	
	public leader;
	// choice is here !
	public agenda;
	public Civbonus;
	public cities = array();
	public units = array();
	public gold = 0;
	public faith = 0;
	public tradeRoadLimit = 0;
	public strategicRessources ;
	public unlockedTechnologies;
	public ongoingTechnology;
	public ongoingCultural;
	public unlockedCultural;
	/** Name
		inherit bonus (2)
		Military cards
		Economic cards
		Diplomatic cards
		Wild cards
	*/
	public government;
	public unlockedCards;
	public unlockedGovernment;
	public CivRelationShip;

	__construct(){

	}
	public function addUnit($unit){
		$this->units[] = $unit;
		$unit->setCiv = $this;
	}


}