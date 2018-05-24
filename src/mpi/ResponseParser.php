<?php

namespace Platron\multicarta\mpi;

use SimpleXMLElement;

abstract class ResponseParser {

	/**
	 * @param SimpleXMLElement $response
	 */
	protected $response;

	/**
	 * @param SimpleXMLElement $response
	 */
	public function __construct(SimpleXMLElement $response) {
		$this->response = $response;
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
		return new Status((string)$this->response
			->Response
			->Status);
	}

	/**
	 * @return string
	 */
	public function getOperation() {
		return (string)$this->response
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
