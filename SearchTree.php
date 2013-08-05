<?php 
require_once('Tree.php');

abstract class SearchTree extends Tree {

	private $_currentNode;
	private $_goal;
	private $_frontier = array();
	private $_explored = array();

	public function __construct($headValue) {
		parent::__construct($headValue);
	}

	abstract public function frontierAdd($nodeList);
	abstract public function frontierVisit();
	
	public function exploredAdd() {
		$explored = $this->getExplored();
		array_push($explored, $this->getCurrentNode());
		$this->setExplored($explored);
	}

	public function initSearch($goal) {
		$currentNode = parent::getHead();
		$this->setGoal($goal);
	}

	public function testGoal() {
		if ($this->getGoal() == $this->getCurrentNode()->getValue()) {
			return true;
		}
		return false;
	}

	public function getGoal() {
		return $this->_goal;
	}

	public function setGoal($value) {
		$this->_goal = $value;
	}
	
	public function getFrontier() {
		return $this->_frontier;
	}

	public function setFrontier($frontier) {
		$this->_frontier = $frontier;
	}

	public function getCurrentNode() {
		return $this->_currentNode;
	}

	public function setCurrentNode($value) {
		$this->_currentNode = $value;
	}

	public function getExplored() {
		return $this->_explored;
	}
	public function setExplored($explored) {
		$this->_explored = $explored;
	}
}