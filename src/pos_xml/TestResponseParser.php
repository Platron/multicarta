<?php

namespace Platron\multicarta\pos_xml;

class TestResponseParser extends ResponseParser {

	/**
	 * @return string
	 */
	protected function getValidCommand() {
		return 'TEST';
	}

	/**
	 * @param string $responseCode
	 * @return ResponseCode
	 */
	protected function createResponseCode(string $responseCode) {
		return new ResponseCode($responseCode);
	}
}
