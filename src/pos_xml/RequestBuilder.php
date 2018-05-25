<?php

namespace Platron\multicarta\pos_xml;

abstract class RequestBuilder {

	/**
	 * @param array $request
	 */
	protected $request;

	public function __construct() {
		$this->initRequest();
		$this->initDefaultValues();
	}

	/**
	 * @return array
	 */
	public function getRequest() {
		return $this->request;
	}

	/**
	 * @return string
	 */
	abstract protected function getCommand();

	protected function initDefaultValues() {
		$this->initCommand();
		$this->initVersion();
	}

	protected function initRequest() {
		$this->request = [];
	}

	protected function initCommand() {
		$this->request['COMMAND'] = $this->getCommand();
	}

	protected function initVersion() {
		$this->request['VERSION'] = '110';
	}
}
