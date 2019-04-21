<?php

require_once('core/Game.php');
include ('utils/database.php');

$game = new Game();
if (isset($_GET["world"]) && isset($_GET["turn"]) ){
	$game->loadGame($pdo,$_GET["world"],$_GET["turn"]);
}
if ( isset( $_GET["new"] ) ){
	$game->newGame();	
	$game->save($pdo);
}
print $game->render();