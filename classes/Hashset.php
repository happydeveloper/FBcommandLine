<?php
/**
 * PHP implementation of Java HashSet
 *
 * @author mpelzsherman
 */

class HashSet {

    private $_objects = array();

	/**
	 * @param  $o Object to be added to this set
	 * Returns: true if the set did not already contain the specified element.
	 */
	public function add($o) {
		foreach($this->_objects as $obj) {
			if ($obj == $o) {
				return false;
			}
		}
		$this->_objects[] = $o;
		return true;
	}

	/**
	 * @param  $o Object to be removed from this set
	 * Returns: true if the set contained the specified element.
	 */
	public function remove($o) {
		foreach($this->_objects as $obj) {
			if ($obj == $o) {
				array_splice($this->_objects, $obj);
				return true;
			}
		}
		return false;
	}

	/**
	 * @param  $o
	 * Returns true if this set contains the specified element.
	 */
	public function contains($o) {
		foreach($this->_objects as $obj) {
			if ($obj == $o) {
				return true;
			}
		}
		return false;
	}

	public function size() {
		return count($this->_objects);
	}

	public function objects() {
		return $this->_objects;
	}

	/**
	 * Removes all of the elements from this set.
	 */
	public function clear() {
		$this->_objects = array();
	}
}
?>
