<?php

namespace Platron\multicarta\pos_xml\refund;

use Platron\multicarta\pos_xml\terminal\Response as TerminalResponse;

class Response extends TerminalResponse {

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
	public function getTrxid() {
		$authInfo = $this->getAuthinfo();
		if ($authInfo) {
			return (string)$authInfo->trxid;
		}
	}

	/**
	 * @return string
	 */
	protected function getValidCommand() {
		return 'REFUND';
	}

	/**
	 * @param string $respcode
	 * @return ResponseCode
	 */
	protected function createResponseCode(string $respcode) {
		return new ResponseCode($respcode);
	}
}
