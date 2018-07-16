<?php

namespace Platron\multicarta\mpi;

class ClientResult {

	/**
	 * @var string $returnMessage
	 */
	private $returnMessage;

	/**
	 * @var int $errorCode
	 */
	private $errorCode;

	/**
	 * @var string $errorMessage
	 */
	private $errorMessage;

	/**
	 * @param string $returnMessage
	 * @param int $errorCode
	 * @param string $errorMessage
	 */
	public function __construct(
		string $returnMessage,
		int $errorCode,
		string $errorMessage
	) {
		$this->returnMessage = $returnMessage;
		$this->errorCode = $errorCode;
		$this->errorMessage = $errorMessage;
	}

	/**
	 * @return string
	 */
	public function getReturnMessage() {
		return $this->returnMessage;
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