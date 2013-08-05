<?php
require_once('DepthSearchTree.php');

class Pathfinder {

	// Expressão Regular que captura links
	const LINK_HTML_PATTERN = "<a\shref=\"([^\"]*)\">(.*)<\/a>";

	public static function findPath($fromUrl, $toUrl) {
		$path = array();
		$depthSearchTree = new DepthSearchTree($fromUrl);

		// Inicializa os valores do nó raiz e de objetivo da busca
		$depthSearchTree->setCurrentNode($depthSearchTree->getHead());
		$depthSearchTree->initSearch($toUrl);
		$depthSearchTree->setLimitLevel(20);

		// Se a raiz não tem caminho, retorna falso;
		if (!$depthSearchTree->frontierAdd(self::getLinks($depthSearchTree->getCurrentNode()->getValue()))) {
			return false;
		}
		
		$depthSearchTree->exploredAdd();
		$frontier = $depthSearchTree->getFrontier();
		$depthSearchTree->setCurrentNode($depthSearchTree->frontierVisit());


		while(!$depthSearchTree->testGoal() and !empty($frontier)) {
			// Se o nó atual NÃO foi explorado
			if (!in_array($depthSearchTree->getCurrentNode(), $depthSearchTree->getExplored())) {
				// Explora o nó atual
				$depthSearchTree->exploredAdd();
				// Se a fronteira mudou, muda o nó corrente pro próximo filho
				if ($depthSearchTree->frontierAdd(self::getLinks($depthSearchTree->getCurrentNode()->getValue()))){
					$depthSearchTree->setCurrentNode($depthSearchTree->frontierVisit());
				}
				// Senão, volta para o Pai
				else {
					$depthSearchTree->setCurrentNode($depthSearchTree->getCurrentNode()->getParent());
				}
			}
			// Se foi explorado
			else {
				$depthSearchTree->setCurrentNode($depthSearchTree->frontierVisit());
			}
			$frontier = $depthSearchTree->getFrontier();
		}
		

		// Monta o caminho
		$foundRoot = false;
		if ($depthSearchTree->testGoal()) {
			$pathNode = $depthSearchTree->getCurrentNode();
			if ($pathNode->getParent() == null) {
				$foundRoot = true;
			}
			while (!$foundRoot) {
				array_push($path, $pathNode);
				if (($pathNode = $pathNode->getParent()) == null) {
					$foundRoot = true;
				}
			}
			$path = array_reverse($path);
		}
		// Se não achou caminho, retorna false
		else {
			return false;
		}
		
		return $path;
	}
	private static function getLinks ($url) {
		$regexp = self::LINK_HTML_PATTERN;
		$output = array();
		$origin = utf8_encode(@file_get_contents($url));

		if ($origin === false) {
			return $output;
		}

		$lastBarPos = strripos($url, '/', -1);
		$url = substr($url, 0, $lastBarPos+1);

		preg_match_all("/$regexp/siU", $origin, $results, PREG_SET_ORDER);
		foreach($results as $result) {
			$currentLink = $result[1];

			if (($currentLink == $url) OR ($currentLink == ''))
				continue;

			switch ($currentLink{0}) {
				case '#': {
					// Case criado para ignorar as âncoras
					break;
				}
				case "/": {
					// Tira a relatividade dos links
					$currentLink = rtrim($url, "/").$currentLink;
					array_push($output, $currentLink);
					break;
				}
				default: {
					//Tira relatividade dos links
					if ((strpos($currentLink, "http://") === false) and (strpos($currentLink, "https://") === false)) {
						$currentLink = $url.$currentLink;
					}
					// Caso default: o link é absoluto e é presumido que está bem formado
					if (strpos($currentLink, "mailto:") === false) {
						array_push($output, $currentLink);
					}
						
				}	
			}
			
		}

		return $output;
	}
}