<?php

namespace app\models\techs;
use \app\models\techs\Technology;

Class Writing extends Technology{

    public $cost = 50;
    public $prerequisites = array("Pottery");
    public $name = "Writing";
    public $img = "Writing.png";
}
