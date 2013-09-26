<?php

/**
 * This file contains classes implementing security manager feature.
 */
class StatePersister extends CStatePersister implements IStatePersister {

	private $stateOnLoad;

	/**
	 * Loads state data from persistent storage.
	 * @return mixed state data. Null if no state data available.
	 */
	public function load() {
		return $this->stateOnLoad = parent::load();
	}

	/**
	 * Saves application state in persistent storage.
	 * @param mixed $state state data (must be serializable).
	 */
	public function save($state) {
		if (is_array($state) && is_array($this->stateOnLoad))
			foreach ($state as $k => $v)
				if ($this->stateOnLoad[$k] === $v)
					unset($state[$k]);
		if (!is_array($state))
			$state = array();
		if (!is_array($this->stateOnLoad))
			$this->stateOnLoad = array();
		if (file_exists($this->stateFile))
			$storedState = unserialize(file_get_contents($this->stateFile));
		if (!isset($storedState) || !is_array($storedState))
			$storedState = array();
		$stateHandle = fopen($this->stateFile, 'w');
		flock($stateHandle, LOCK_EX);
		fwrite($stateHandle, serialize($state + $storedState + $this->stateOnLoad));
		fclose($stateHandle);
	}

}

