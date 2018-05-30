<?php

namespace Platron\multicarta\pos_xml;

class ReversalResponseParser extends TerminalResponseParser {

	/**
	 * @return string
	 */
	public function getTrXId() {
		$result = $this->getResult();
		if ($result) {
			return (string)$result->trxid;
		}
	}

	/**
	 * @return string
	 */
	public function getSession() {
		$result = $this->getResult();
		if ($result) {
			return (string)$result->session;
		}
	}

	/**
	 * @return string
	 */
	public function getTerminalId() {
		$result = $this->getResult();
		if ($result) {
			return (string)$result->termid;
		}
	}

	/**
	 * @return string
	 */
	protected function getValidCommand() {
		return 'PAYMENTREVERSAL';
	}

	/**
	 * @param string $responseCode
	 * @return PaymentResponseCode
	 */
	protected function createResponseCode(string $responseCode) {
		return new ReversalResponseCode($responseCode);
	}
}
