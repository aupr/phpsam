<?php
class Log {
	private $handle;

	public function __construct($logpath, $filename) {
		$this->handle = fopen($logpath . $filename, 'a');
	}

	public function write($message) {
		fwrite($this->handle, date('Y-m-d G:i:s') . ' - ' . print_r($message, true) . "\n");
	}

	public function __destruct() {
		fclose($this->handle);
	}
}