<?php

namespace Platron\multicarta\pos_xml;

class PaymentResponseParser extends TerminalResponseParser {

	/**
	 * @return string
	 */
	public function getInvoice() {
		$authInfo = $this->getAuthInfo();
		if ($authInfo) {
			return (string)$authInfo->invoice;
		}
	}

	/**
	 * @return string
	 */
	public function getApproval() {
		$authInfo = $this->getAuthInfo();
		if ($authInfo) {
			return (string)$authInfo->approval;
		}
	}

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
	public function getEtId() {
		$authInfo = $this->getAuthInfo();
		if ($authInfo) {
			return (string)$authInfo->etid;
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
	 * @return string
	 */
	public function getSession() {
		$authInfo = $this->getAuthInfo();
		if ($authInfo) {
			return (string)$authInfo->session;
		}
	}

	/**
	 * @return SimpleXMLElement
	 */
	protected function getAuthInfo() {
		$result = $this->getResult();
		if ($result) {
			return $this->result->authinfo;
		}
	}

	/**
	 * @return string
	 */
	protected function getValidCommand() {
		return 'PAYMENT';
	}

	/**
	 * @param string $responseCode
	 * @return PaymentResponseCode
	 */
	protected function createResponseCode(string $responseCode) {
		return new PaymentResponseCode($responseCode);
	}
}
