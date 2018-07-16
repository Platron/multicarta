<?php

namespace Platron\multicarta\pos_xml\refund;

use Platron\multicarta\pos_xml\terminal\Request as TerminalRequest;
use Platron\multicarta\Error;
use Platron\multicarta\CurrencyCode;

class Request extends TerminalRequest {

	/**
	 * @param string $termid
	 * @param string $id
	 * @param string $session
	 * @param string $amount
	 * @param CurrencyCode $currency
	 */
	public function __construct(
		string $termid,
		string $id,
		string $session,
		string $amount,
		CurrencyCode $currency
	) {
		parent::__construct($termid);
		$this->setId($id);
		$this->setSession($session);
		$this->setAmount($amount);
		$this->setCurrency($currency);
	}

	/**
	 * @param string $sln
	 */
	public function setSln(string $sln) {
		if (strlen($sln) > 283) {
			throw new Error("Excess of maximum length (283 characters) in sln");
		}
		$this->request['SLN'] = $sln;
	}

	protected function initDefaultValues() {
		parent::initDefaultValues();
	}

	/**
	 * @param string $id
	 */
	protected function setId(string $id) {
		if (!preg_match('/^\d{0,12}$/', $id)) {
			throw new Error(
				"Id does not match the format
				(number with maximum length of 12 digits)"
			);
		}
		$this->request['ID'] = $id;
	}

	/**
	 * @param string $session
	 */
	protected function setSession(string $session) {
		if (strlen($session) != 40) {
			throw new Error("Invalid length (40 characters) in session");
		}
		$this->request['SESSION'] = $session;
	}

	/**
	 * @param string $amount
	 */
	protected function setAmount(string $amount) {
		if (!preg_match('/^\d{0,18}$/', $amount)) {
			throw new Error(
				"Amount does not match the format
				(number with maximum length of 19 digits)"
			);
		}
		$this->request['AMOUNT'] = $amount;
	}

	/**
	 * @param CurrencyCode $currency
	 */
	protected function setCurrency(CurrencyCode $currency) {
		$this->request['CURRENCY'] = (string)$currency;
	}

	/**
	 * @return string
	 */
	protected function getCommand() {
		return 'REFUND';
	}
}
