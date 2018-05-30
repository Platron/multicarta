<?php

namespace Platron\multicarta\pos_xml;

class RefundResponseParser extends TerminalResponseParser {

	/**
	 * @return string
	 */
	public function getRrn() {
		$authInfo = $this->getAuthInfo();
		if ($authInfo) {
			return (string)$authInfo->rrn;
		}
	}

	/**
	 * @return string
	 */
	public function getTrXId() {
		$authInfo = $this->getAuthInfo();
		if ($authInfo) {
			return (string)$authInfo->trxid;
		}
	}

	/**
	 * @return SimpleXMLElement
	 */
	protected function getAuthInfo() {
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
	 * @param string $responseCode
	 * @return RefundResponseCode
	 */
	protected function createResponseCode(string $responseCode) {
		return new RefundResponseCode($responseCode);
	}
}
