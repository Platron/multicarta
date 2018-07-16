<?php

namespace Platron\multicarta\pos_xml\reversal;

use Platron\multicarta\pos_xml\terminal\Response as TerminalResponse;

class Response extends TerminalResponse {

	/**
	 * @return string
	 */
	protected function getValidCommand() {
		return 'PAYMENTREVERSAL';
	}

	/**
	 * @param string $respcode
	 * @return ResponseCode
	 */
	protected function createResponseCode(string $respcode) {
		return new ResponseCode($respcode);
	}
}
