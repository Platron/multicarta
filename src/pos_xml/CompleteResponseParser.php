<?php

namespace Platron\multicarta\pos_xml;

class CompleteResponseParser extends AuthResponseParser {

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
		return 'COMPLETE';
	}

	/**
	 * @param string $respcode
	 * @return CompleteResponseCode
	 */
	protected function createResponseCode(string $respcode) {
		return new CompleteResponseCode($respcode);
	}
}
