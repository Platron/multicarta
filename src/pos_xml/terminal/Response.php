<?php

namespace Platron\multicarta\pos_xml\terminal;

use Platron\multicarta\pos_xml\Response as BaseResponse;

abstract class Response extends BaseResponse {

	/**
	 * @return SimpleXMLElement
	 */
	protected function getAuthinfo() {
		$result = $this->getResult();
		if ($result) {
			return $result->authinfo;
		}
	}
}