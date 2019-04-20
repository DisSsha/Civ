<?php 

class Render {

	public function __construct(){
	}

	public function generate

	public function render($world){
		$html = "<!doctype html>
			<html>
			<head>
			  <style>";
		$html .= ".container {
			  display: grid;
			  grid-template-columns: repeat(".$world->x.",40px);
			  grid-template-rows: repeat(".$world->y.",40px);
			  }";
		$html .= ".Grassland {
			  background-image : url(../img/grassland.jpg);
			  }";
		$html .= ".Woods {
			  content : url(../img/woods.png);
			  width: 100%;
			  height: 100%;
			  }";
		$html .= "</style> 
			</head>
			<body>";
		$html .= "<div class=\"container\">";
		for ($i=0;$i < $world->x;$i++){
			for ($j=0;$j < $world->y;$j++){
				$html.= "<div class=\"tile ".$world->getCell($i,$j)->getTerrain()->name." ".$world->getCell($i,$j)->getFeature()."\"></div>";
			}
		}
		$html .= "</div>";
		$html .= "</body>
			</html>";
		return $html;
	}
}
