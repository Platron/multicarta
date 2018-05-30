<?php

namespace Platron\multicarta\pos_xml;

use SimpleXMLElement;
use DateTime;

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
		return ($this->getCommand() == $this->getValidCommand());
	}

	/**
	 * @return bool
	 */
	public function isSuccess() {
		return ($this->getResponseCode() == $this->getSuccessResponseCode());
	}

	/**
	 * @return string
	 */
	public function getCommand() {
		$header = $this->getHeader();
		return (string)$header->command;
	}

	/**
	 * @return string
	 */
	public function getVersion() {
		$header = $this->getHeader();
		return (string)$header->version;
	}

	/**
	 * @return ResponseCode
	 */
	public function getResponseCode() {
		$header = $this->getHeader();
		return $this->createResponseCode((string)$header->respcode);
	}

	/**
	 * @return DateTime
	 */
	public function getProcessingTime() {
		$footer = $this->getFooter();
		$dateTime = new DateTime();
		return $dateTime->setTimestamp((string)$footer->timestamp);
	}

	/**
	 * @return string
	 */
	public function getErrorMessage() {
		if (!$this->isSuccess()) {
			$footer = $this->getFooter();
			return (string)$footer->errormsg;
		}
	}

	/**
	 * @return SimpleXMLElement
	 */
	protected function getHeader() {
		return $this->response->header;
	}

	/**
	 * @return SimpleXMLElement
	 */
	protected function getFooter() {
		return $this->response->footer;
	}

	/**
	 * @return SimpleXMLElement
	 */
	protected function getResult() {
		if ($this->isSuccess()) {
			return $this->response->result;
		}
	}

	/**
	 * @return string
	 */
	abstract protected function getValidCommand();

	/**
	 * @param string $responseCode
	 * @return ResponseCode
	 */
	abstract protected function createResponseCode(string $responseCode);

	/**
	 * @return string
	 */
	protected function getSuccessResponseCode() {
		return ResponseCode::SUCCESS;
	}
}
