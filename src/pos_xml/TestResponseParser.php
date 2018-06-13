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
	 * @param string $respcode
	 * @return ResponseCode
	 */
	protected function createResponseCode(string $respcode) {
		return new ResponseCode($respcode);
	}
}
