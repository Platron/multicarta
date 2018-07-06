<?php

namespace Platron\multicarta\pos_xml;

use SimpleXMLElement;

class ClientResult {

	/**
	 * @var mixed $returnedData
	 */
	private $returnedData;

	/**
	 * @var int $errorCode
	 */
	private $errorCode;

	/**
	 * @var string $errorMessage
	 */
	private $errorMessage;

	/**
	 * mixed $returnedData
	 * int $errorCode
	 * string $errorMessage
	 */
	public function __construct(
		$returnedData,
		int $errorCode,
		string $errorMessage
	) {
		$this->returnedData = $returnedData;
		$this->errorCode = $errorCode;
		$this->errorMessage = $errorMessage;
	}

	/**
	 * @return SimpleXMLElement
	 */
	public function getResponse() {
		$returnedData = $this->getReturnedData();
		if ($returnedData !== false) {
			$response = simplexml_load_string($returnedData);
			if ($response !== false) {
				return $response;
			}
		}
	}

	/**
	 * @return mixed
	 */
	public function getReturnedData() {
		return $this->returnedData;
	}

	/**
	 * @return int
	 */
	public function getErrorCode() {
		return $this->errorCode;
	}

	/**
	 * @return string
	 */
	public function getErrorMessage() {
		return $this->errorMessage;
	}
}