<?php

namespace Platron\multicarta\pos_xml;

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
		$this->request['TERMID'] = $terminalId;
	}
}
