<?php
require_once ('Technology.php');

Class Writing extends Technology{

    public $cost = 50;
    public $prerequisites = array("Pottery");
    public $name = "Writing";
    public $img = "Writing.png";
}
