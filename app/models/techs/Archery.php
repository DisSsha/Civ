<?php
namespace app\models\techs;
use \app\models\techs\Technology;

Class Archery extends Technology{
    public $cost = 50;
    public $prerequisites = array("AnimalHusbandry");
  
}
