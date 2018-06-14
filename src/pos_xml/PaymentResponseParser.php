<?php

namespace Platron\multicarta\pos_xml;

class PaymentResponseParser extends AuthResponseParser {

	/**
	 * @return string
	 */
	public function getRrn() {
		$authInfo = $this->getAuthinfo();
		if ($authInfo) {
			return (string)$authInfo->rrn;
		}
	}

	/**
	 * @return string
	 */
	protected function getValidCommand() {
		return 'PAYMENT';
	}

	/**
	 * @param string $respcode
	 * @return PaymentResponseCode
	 */
	protected function createResponseCode(string $respcode) {
		return new PaymentResponseCode($respcode);
	}
}
