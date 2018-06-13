<?php

namespace Platron\multicarta\pos_xml;

class RefundResponseParser extends TerminalResponseParser {

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
	 * @return SimpleXMLElement
	 */
	protected function getAuthinfo() {
		$result = $this->getResult();
		if ($result) {
			return $result->authinfo;
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
	 * @return RefundResponseCode
	 */
	protected function createResponseCode(string $respcode) {
		return new RefundResponseCode($respcode);
	}
}
