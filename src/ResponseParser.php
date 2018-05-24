<?php

namespace Platron\multicarta;

use SimpleXMLElement;

abstract class ResponseParser {

	/**
	 * @param SimpleXMLElement $xmlData
	 */
	protected $xmlData;

	/**
	 * @param string $response
	 */
	public function __construct(string $response) {
		$this->xmlData = new SimpleXMLElement($response);
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
	 * @return Status
	 */
	public function getStatus() {
		return new Status((string)$this->xmlData
			->Response
			->Status);
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
		return Status::SUCCESS;
	}
}
