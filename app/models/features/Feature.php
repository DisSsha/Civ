<?php

namespace app\models\features;

abstract class Feature {

	public $name;
	public $movement;
	// Cultural,Science,Gold,Faith,Production,Food
	public $baseYield;
	public $img;
}
