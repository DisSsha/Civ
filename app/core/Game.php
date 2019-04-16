<?php 

require_once ('World.php');

$world = new World(60,60);
$world->generateTerrain();
$world->generateFeatures();

$world->printWorld();