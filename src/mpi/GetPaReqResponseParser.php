<?php

namespace Platron\multicarta\mpi;

class GetPaReqResponseParser extends ResponseParser {

	/**
	 * @return string
	 */
	public function getUrl() {
		if ($this->isSuccess()) {
			return (string)$this->xmlData
				->Response
				->url;
		}
	}

	/**
	 * @return string
	 */
	public function getPaReq() {
		if ($this->isSuccess()) {
			return (string)$this->xmlData
				->Response
				->pareq;
		}
	}

	/**
	 * @return string
	 */
	protected function getValidOperation() {
		return 'GetPAReqForm';
	}
}