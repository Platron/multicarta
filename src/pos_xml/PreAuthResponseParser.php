<?php

namespace Platron\multicarta\pos_xml;

class PreauthResponseParser extends AuthResponseParser {

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
		return 'PREAUTH';
	}

	/**
	 * @param string $respcode
	 * @return PreauthResponseCode
	 */
	protected function createResponseCode(string $respcode) {
		return new PreauthResponseCode($respcode);
	}
}
