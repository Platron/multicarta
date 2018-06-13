<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\Error;

abstract class TerminalRequestBuilder extends RequestBuilder {

	/**
	 * @param string $termid
	 */
	public function __construct(string $termid) {
		parent::__construct();
		$this->setTermid($termid);
	}

	/**
	 * @param string $termid
	 */
	protected function setTermid(string $termid) {
		if (strlen($termid) > 16) {
			throw new Error("Excess of maximum length (16 characters) in termid");
		}
		$this->request['TERMID'] = $termid;
	}
}
