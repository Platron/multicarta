<?php

namespace Platron\multicarta;

use SimpleXMLElement;

abstract class ResponseParser {

	/**
	 * @param SimpleXMLElement $xmlData
	 */
	protected $xmlData;

	/**
	 * @param Response $response
	 */
	public function __construct(Response $response) {
		$this->xmlData = new SimpleXMLElement(
			$response->getResult()
		);
	}

	/**
	 * @return bool
	 */
	public function isValid() {
		return ($this->getOperation() == $this->getValidOperation());
	}

	/**
	 * @return bool
	 */
	public function isSuccess() {
		return ($this->getStatus() == $this->getSuccessStatus());
	}

	/**
	 * @return string
	 */
	public function getStatus() {
		return (string)$this->xmlData
			->Response
			->Status;
	}

	/**
	 * @return string
	 */
	public function getOperation() {
		return (string)$this->xmlData
			->Response
			->Operation;
	}

	/**
	 * @return string
	 */
	abstract protected function getValidOperation();

	/**
	 * @return string
	 */
	protected function getSuccessStatus() {
		return '00';
	}
}
