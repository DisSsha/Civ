<?php
require_once ('Technology.php');

Class Archery extends Technology{
    public $cost = 50;
    public $prerequisites = array("AnimalHusbandry");
    public $name = "Archery";
    public $img = "Archery.png";
}
