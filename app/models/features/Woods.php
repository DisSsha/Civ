<?php

namespace app\models\features;
use \app\models\features\Feature;

# require_once ('Feature.php');

class Woods extends Feature {

	public function init(){
		$this->baseYield = array(
			'food' => 2,
			'production' => 2
		);
	}

}
