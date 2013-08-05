<?php

require_once('SearchTree.php');

class DepthSearchTree extends SearchTree {

	private $_limitLevel;

	public function __construct($headValue) {
		parent::__construct($headValue);
	}

	public function frontierAdd($nodeList) {
		if ($this->getCurrentNode()->getLevel() == $this->getlimitLevel()) {
			return false;
		}
		$hasInserted = false;
		if (!empty($nodeList)) {
			//print_r($nodeList);
			$newFrontier = $this->getFrontier();
			foreach($nodeList as $currNode) {
				$isInFrontier = false;
				foreach ($newFrontier as $currFrontNode) {
					// Não deixa adicionar itens repetidos à fronteira
					if ($currNode == $currFrontNode->getValue()) {
						//echo "No fronteira atual: "; print_r($currFrontNode->getValue()); echo '<br>';
						//echo "No atual: "; print_r($currNode); echo '<br>';
						$isInFrontier = true;
					}
				}
				// Se não está na fronteira, adiciona nó
				if (!$isInFrontier) {
					$node = new Node();
					$node->setValue($currNode);
					$node->setParent($this->getCurrentNode());
					$node->setLevel($this->getCurrentNode()->getLevel() + 1);
					array_push($newFrontier, $node);
					$this->getCurrentNode()->appendChild($node);
					if (!$hasInserted) {
						$hasInserted = true;
					}
				}
			}
			$this->setFrontier($newFrontier);
		}
		// Retorna dizendo se a fronteira mudou ou não
		return $hasInserted;
	}

	public function frontierVisit() {
		$frontier = $this->getFrontier();
		$node = array_pop($frontier);
		$this->setFrontier($frontier);
		return $node;
	}

	private function explore() {
		array_pop($frontier);
	}
	public function setLimitLevel($limitLevel) {
		$this->_limitLevel = $limitLevel;
	}
	
	public function getLimitLevel() {
		return $this->_limitLevel;
	}
}