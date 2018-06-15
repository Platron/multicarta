<?php

namespace Platron\multicarta\pos_xml;

class PreauthResponseParser extends AuthResponseParser {

	/**
	 * @return string
	 */
	protected function getValidCommand() {
		return 'PREAUTH';
	}

	/**
	 * @param string $respcode
	 * @return PaymentResponseCode
	 */
	protected function createResponseCode(string $respcode) {
		return new PreauthResponseCode($respcode);
	}
}
