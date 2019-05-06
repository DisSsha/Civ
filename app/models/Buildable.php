<?php

namespace app\models;

abstract class Buildable {

    public $prerequisites = array();
    public $cost;

	public function build($production){
		$this->cost -= $production;
	}

    public function satisfy($unlockedList){
        foreach($this->prerequisites as $pre ){
            if (!in_array($pre,$unlockedList)){
                return false;
            }
        }
        return true;
    }
}
