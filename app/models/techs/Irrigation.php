<?php
namespace app\models\techs;
use \app\models\techs\Technology;

Class Irrigation extends Technology{

    public $cost = 50;
    public $prerequisites = array("Pottery");
    public $name = "Irrigation";
    public $img = "Irrigation.png";

}
