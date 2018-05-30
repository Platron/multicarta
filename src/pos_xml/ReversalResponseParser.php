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
	 * @param string $responseCode
	 * @return PaymentResponseCode
	 */
	protected function createResponseCode(string $responseCode) {
		return new ReversalResponseCode($responseCode);
	}
}
