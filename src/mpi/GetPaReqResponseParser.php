<?php

namespace Platron\multicarta\mpi;

class GetPaReqResponseParser extends ResponseParser {

	/**
	 * @return string
	 */
	public function getUrl() {
		if ($this->isSuccess()) {
			return (string)$this->response
				->Response
				->url;
		}
	}

	/**
	 * @return string
	 */
	public function getPareq() {
		if ($this->isSuccess()) {
			return (string)$this->response
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