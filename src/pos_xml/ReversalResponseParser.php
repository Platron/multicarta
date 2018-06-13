<?php

namespace Platron\multicarta\pos_xml;

class ReversalResponseParser extends TerminalResponseParser {

	/**
	 * @return string
	 */
	protected function getValidCommand() {
		return 'PAYMENTREVERSAL';
	}

	/**
	 * @param string $respcode
	 * @return ReversalResponseCode
	 */
	protected function createResponseCode(string $respcode) {
		return new ReversalResponseCode($respcode);
	}
}
