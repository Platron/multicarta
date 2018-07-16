<?php

namespace Platron\multicarta\pos_xml\recurring_payment;

use Platron\multicarta\pos_xml\auth\Response as AuthResponse;

class Response extends AuthResponse {

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
	public function getEtid() {
		$authInfo = $this->getAuthinfo();
		if ($authInfo) {
			return (string)$authInfo->etid;
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
		return 'PAYMENT';
	}

	/**
	 * @param string $respcode
	 * @return ResponseCode
	 */
	protected function createResponseCode(string $respcode) {
		return new ResponseCode($respcode);
	}
}
