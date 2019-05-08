<?php

namespace app\core;
use \app\utils\Logger;

class Render {

	public $world;
	public $game;

	public function __construct($game){
		$this->game = $game;
	}

	public function generateHeader(){
		$html = "<!doctype html>\n";
		$html .= "<html>\n";
		$html .= "\t<head>\n";
		$html .= $this->generateCSS();
		$html .= "\t</head>\n";
		return $html;
	}

	public function generateLogs(){
		$html = "\t\t<div class=\"logs\">\n";
		$logs = Logger::getLogs($game->id);
		var_dump($logs);
		$html .= "\t\t<table>\n";
		foreach ($logs as $key => $value){
			$html .= "\t\t<tr><td>".$value['message']."</td></tr>\n";
		}
		$html .= "\t\t</table>\n";
		$html .= "\t\t</div>\n";
		return $html;
	}

	public function generateCSS(){
		$css = "\t\t<style>\n";
		$css .= "\t\t\t.container {\n";
		$css .= "\t\t\t\tdisplay: grid;\n";
		$css .= "\t\t\t\tgrid-template-columns: repeat(".$this->world->x.",40px);\n";
		$css .= "\t\t\t\tgrid-template-rows: repeat(".$this->world->y.",40px);\n";
		$css .= "\t\t\tgrid-area: container\n";
		$css .= "\t\t\t}\n";
		$css .= "\t\t\tbody {\n";
		$css .= "\t\t\t\tdisplay: grid;\n";
		$css .= "\t\t\t\tgrid-template-columns: 10% 90%;\n";
		$css .= "\t\t\t\tgrid-template-areas: \"sidebar container\"\n";
		$css .= "\t\t\t\t \"logs logs\";\n";
		$css .= "\t\t\t}\n";
		$css .= "\t\t\t.sidebar {\n";
		$css .= "\t\t\tgrid-area: sidebar\n";
		$css .= "\t\t\t}\n";
		$css .= "\t\t\t.logs {\n";
		$css .= "\t\t\tgrid-area: logs\n";
		$css .= "\t\t\t}\n";
		foreach ($this->world->terrainsList as $key => $value ){
			$css .= "\t\t\t.".$value->name." {\n";
			$css .= "\t\t\t\tbackground-image : url(img/".$value->img.");\n";
			$css .= "\t\t\t}\n";
		}
		/**foreach ($this->world->featuresList as $key => $value ){
			$css .= "\t\t\t.".$value->name." {\n";
			$css .= "\t\t\t\tcontent : url(img/".$value->img.");\n";
			$css .= "\t\t\t\twidth: 100%;\n";
			$css .= "\t\t\t\theight: 100%;\n";
			$css .= "\t\t\t}\n";
		}
		foreach ($this->world->unitList as $key => $value ){
			$css .= "\t\t\t.".$value->name." {\n";
			$css .= "\t\t\t\tcontent : url(img/".$value->img.");\n";
			$css .= "\t\t\t\twidth: 100%;\n";
			$css .= "\t\t\t\theight: 100%;\n";
			$css .= "\t\t\t}\n";
		}*/
		$css .= "\t\t</style>\n";
		return $css;
	}

	public function generateFooter(){
		$html = "\t</body>\n";
		$html .= "</html>";
		return $html;
	}

	public function render($world){
		$this->world = $world;
		$html = $this->generateHeader();
		$html .= "\t<body>\n";
		$html .= "\t<div class=\"sidebar\">\n";
		$html .= "\t<p>Turn : ".$this->game->turn."</p>\n";
		$html .= "\t<p>ID ".$this->game->id."</p>\n";
		$html .= "\t</div>\n";
		$html .= "\t\t<div class=\"container\">\n";
		for ($i=0;$i < $this->world->x;$i++){
			for ($j=0;$j < $this->world->y;$j++){
				$cell = $this->world->getCell($i,$j);
				$terrain = $cell->getTerrain()->name;
				$featureImg = "";
				if ($cell->getFeature() != null ){
					$feature = $cell->getFeature();
					$featureImg = "<img src=\"img/".$feature->img."\" style=\"grid-column-start: 1;grid-row-start: 1;z-index:1;width:100%;height:100%\" />";
				}
				$unitImg = "";
				if ($cell->getUnit() != null ){
					$unit = $cell->getUnit();
					$unitImg = "<img src=\"img/".$unit->img."\" style=\"grid-column-start: 1;grid-row-start: 1;z-index:2;width:100%;height:100%\" />";
				}
				$html.= "\t\t\t<div class=\"tile ".$terrain."\" style=\"display:grid\">".$featureImg." ".$unitImg."</div>\n";
			}
		}
		$html .= "\t\t</div>\n";
		$html .= $this->generateLogs();
		$html .= $this->generateFooter();
		return $html;
	}
}
