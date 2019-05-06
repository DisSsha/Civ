<?php

require_once "vendor/autoload.php";

use \app\utils\Database;
use \app\core\Game;

#require_once ('core/Game.php');
#require_once ('utils/Database.php');

if (isset ($_GET["clearall"])){
	$pdo = Database::getInstance();
	$reply = $pdo->query("TRUNCATE TABLE `cells`;");
	$reply = $pdo->query("TRUNCATE TABLE `civs`;");
	$reply = $pdo->query("TRUNCATE TABLE `game`;");
	$reply = $pdo->query("TRUNCATE TABLE `units`;");
	exit;
}
$game = new Game();
if (isset($_GET["world"]) && isset($_GET["turn"]) ){
	$game->load($_GET["world"],$_GET["turn"]);
}
if (isset($_GET["world"]) && isset($_GET["lasturn"])){
	$game->loadLastTurn($_GET["world"]);
}
if (isset($_GET["world"]) && isset($_GET["newturn"])){
	$game->loadLastTurn($_GET["world"]);
  $game->turn();
  $game->save();
}
if ( isset( $_GET["new"] ) ){
	$game->newGame();
	$game->save();
}

print $game->render();
