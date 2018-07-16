<?php

namespace Platron\multicarta\pos_xml;

use SimpleXMLElement;
use DateTime;

abstract class Response {

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
		return (
			($this->getVersion() == '110')
			&&
			($this->getCommand() == $this->getValidCommand())
		);
	}

	/**
	 * @return bool
	 */
	public function isSuccess() {
		return ($this->getRespcode() == $this->getSuccessRespcode());
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
	public function getRespcode() {
		$header = $this->getHeader();
		return $this->createResponseCode((string)$header->respcode);
	}

	/**
	 * @return DateTime
	 */
	public function getTimestamp() {
		$footer = $this->getFooter();
		return DateTime::createFromFormat(
			'dmYHis',
			(string)$footer->timestamp
		);
	}

	/**
	 * @return string
	 */
	public function getErrormsg() {
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
	 * @param string $respcode
	 * @return ResponseCode
	 */
	abstract protected function createResponseCode(string $respcode);

	/**
	 * @return string
	 */
	protected function getSuccessRespcode() {
		return ResponseCode::SUCCESS;
	}
}
