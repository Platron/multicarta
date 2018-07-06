<?php

namespace Platron\multicarta\pos_xml;

use SimpleXMLElement;

class ClientResult {

	/**
	 * @var string $message
	 */
	private $message;

	/**
	 * @var int $errorCode
	 */
	private $errorCode;

	/**
	 * @var string $errorMessage
	 */
	private $errorMessage;

	/**
	 * @param string $message
	 * @param int $errorCode
	 * @param string $errorMessage
	 */
	public function __construct(
		string $message,
		int $errorCode,
		string $errorMessage
	) {
		$this->message = $message;
		$this->errorCode = $errorCode;
		$this->errorMessage = $errorMessage;
	}

	/**
	 * @return SimpleXMLElement
	 */
	public function getResponse() {
		$message = $this->getMessage();
		$response = simplexml_load_string($message);
		if ($response !== false) {
			return $response;
		}
	}

	/**
	 * @return ClientError
	 */
	public function getError() {
		$error = new ClientError(
			$this->getMessage(),
			$this->getErrorCode(),
			$this->getErrorMessage()
		);
		return $error;
	}

	/**
	 * @return string
	 */
	protected function getMessage() {
		return $this->message;
	}

	/**
	 * @return int
	 */
	protected function getErrorCode() {
		return $this->errorCode;
	}

	/**
	 * @return string
	 */
	protected function getErrorMessage() {
		return $this->errorMessage;
	}
}

class ClientError {

	/**
	 * @var string $resultMessage
	 */
	private $resultMessage;

	/**
	 * @var int $code
	 */
	private $code;

	/**
	 * @var string $message
	 */
	private $message;

	/**
	 * @param string $resultMessage
	 * @param int $code
	 * @param string $message
	 */
	public function __construct(
		string $resultMessage,
		int $code,
		string $message
	) {
		$this->resultMessage = $resultMessage;
		$this->code = $code;
		$this->message = $message;
	}

	/**
	 * @return string
	 */
	public function getResultMessage() {
		return $this->resultMessage;
	}

	/**
	 * @return int
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}
}