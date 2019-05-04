<?php

require_once('core/Game.php');
include ('utils/database.php');
if (isset ($_GET["clearall"])){
	$reply = $pdo->query("TRUNCATE TABLE `cells`;");
	$reply = $pdo->query("TRUNCATE TABLE `civs`;");
	$reply = $pdo->query("TRUNCATE TABLE `game`;");
	$reply = $pdo->query("TRUNCATE TABLE `units`;");
	exit;
}
$game = new Game();
if (isset($_GET["world"]) && isset($_GET["turn"]) ){
	$game->load($pdo,$_GET["world"],$_GET["turn"]);
}
if (isset($_GET["world"]) && isset($_GET["lasturn"])){
	$game->loadLastTurn($pdo,$_GET["world"]);
}
if (isset($_GET["world"]) && isset($_GET["newturn"])){
	$game->loadLastTurn($pdo,$_GET["world"]);
  $game->turn($pdo);
  $game->save($pdo);
}
if ( isset( $_GET["new"] ) ){
	$game->newGame();
	$game->save($pdo);
}

print $game->render();
