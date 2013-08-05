<?php

abstract class Tree {

	private $_head;

	public function __construct($headValue) {
		$this->_head = new Node();
		$this->_head->setValue($headValue);
		$this->_head->setLevel(0);
	}

	public function getHead() {
		return $this->_head;
	}
	private function addFirst() {
		$this->_head = $child;
	}
}	

class Node {

	private $_value;
	private $_children = array();
	private $_parent;
	private $_level;

	public function __construct($value = null, $parentNode = null) {
		$this->setValue($value);
		if (!is_null($parentNode)) {
			$this->setParent($parentNode);
			array_push($parentNode->getChildren(), $this);
		}
	}
	public function setValue($value) {
		$this->_value = $value;
	}
	public function setParent($parent) {
		$this->_parent = $parent;
	}
	public function getValue() {
		return $this->_value;
	}
	public function getChildren() {
		return $this->_children;
	}
	public function setChildren($children) {
		$this->_children = $children;
	}
	public function getParent() {
		return $this->_parent;
	}
	public function appendChild($child) {
		$children = $this->getChildren();
		array_push($children, $child);
		$this->setChildren($children);
	}
	public function detachChild($child) {
		return array_pop($this->getChildren());
	}
	public function setLevel($level) {
		$this->_level = $level;
	}
	public function getLevel() {
		return $this->_level;
	}

}
?>