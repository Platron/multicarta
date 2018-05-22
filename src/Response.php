<?php

namespace classes\ps\multicarta\sdk;

class Response {

	/**
	 * @var string $result
	 */
	private $result;

	/**
	 * @var string $errorNumber
	 */
	private $errorNumber;

	/**
	 * @var string $errorDescription
	 */
	private $errorDescription;

	/**
	 * @param string $result
	 * @param string $errorNumber
	 * @param string $errorDescription
	 */
	public function __construct(
		string $result,
		string $errorNumber,
		string $errorDescription
	) {
		$this->result = $result;
		$this->errorNumber = $errorNumber;
		$this->errorDescription = $errorDescription;
	}

	/**
	 * @return string
	 */
	public function getResult() {
		return $this->result;
	}

	/**
	 * @return string
	 */
	public function getErrorNumber() {
		return $this->errorNumber;
	}

	/**
	 * @return string
	 */
	public function getErrorDescription() {
		return $this->errorDescription;
	}
}