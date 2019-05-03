<?php
require_once ('Technology.php');

Class Irrigation extends Technology{

    public $cost = 50;
    public $prerequisites = array("Pottery");
    public $name = "Irrigation";
    public $img = "Irrigation.png";

}
