<?php

namespace Platron\multicarta\pos_xml\preauth;

use Platron\multicarta\pos_xml\auth\Response as AuthResponse;

class Response extends AuthResponse {

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
	 * @return string
	 */
	protected function getValidCommand() {
		return 'PREAUTH';
	}

	/**
	 * @param string $respcode
	 * @return ResponseCode
	 */
	protected function createResponseCode(string $respcode) {
		return new ResponseCode($respcode);
	}
}
