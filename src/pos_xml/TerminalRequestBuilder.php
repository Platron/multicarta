<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\Error;

abstract class TerminalRequestBuilder extends RequestBuilder {

	/**
	 * @param string $terminalId
	 */
	public function __construct(string $terminalId) {
		parent::__construct();
		$this->setTerminalId($terminalId);
	}

	/**
	 * @param string $terminalId
	 */
	protected function setTerminalId(string $terminalId) {
		if (strlen($terminalId) > 16) {
			throw new Error("Excess of maximum length (16 characters) in terminal id");
		}
		$this->request['TERMID'] = $terminalId;
	}
}
