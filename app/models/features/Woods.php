<?php

namespace app\models\features;
use \app\models\features\Feature;

# require_once ('Feature.php');

class Woods extends Feature {

	public function __construct(){
		$this->baseYield(rray(
			'food' => 2,
			'production' => 2
		));
	}

}
