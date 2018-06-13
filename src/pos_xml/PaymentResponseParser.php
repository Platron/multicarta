<?php

namespace Platron\multicarta\pos_xml;

class PaymentResponseParser extends TerminalResponseParser {

	/**
	 * @return string
	 */
	public function getInvoice() {
		$authInfo = $this->getAuthinfo();
		if ($authInfo) {
			return (string)$authInfo->invoice;
		}
	}

	/**
	 * @return string
	 */
	public function getApproval() {
		$authInfo = $this->getAuthinfo();
		if ($authInfo) {
			return (string)$authInfo->approval;
		}
	}

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
	 * @return string
	 */
	public function getTrxid() {
		$authInfo = $this->getAuthinfo();
		if ($authInfo) {
			return (string)$authInfo->trxid;
		}
	}

	/**
	 * @return string
	 */
	public function getSession() {
		$authInfo = $this->getAuthinfo();
		if ($authInfo) {
			return (string)$authInfo->session;
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
	 * @return PaymentResponseCode
	 */
	protected function createResponseCode(string $respcode) {
		return new PaymentResponseCode($respcode);
	}
}
