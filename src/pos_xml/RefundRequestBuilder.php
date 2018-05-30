<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\Error;
use Platron\multicarta\CurrencyCode;

class RefundRequestBuilder extends TerminalRequestBuilder {

	/**
	 * @param string $terminalId
	 * @param int $trXId
	 * @param string $session
	 * @param int $amount
	 */
	public function __construct(
		string $terminalId,
		int $trXId,
		string $session,
		int $amount
	) {
		parent::__construct($terminalId);
		$this->setTrXId($trXId);
		$this->setSession($session);
		$this->setAmount($amount);
	}

	/**
	 * @param CurrencyCode $currencyCode
	 */
	public function setCurrencyCode(CurrencyCode $currencyCode) {
		$this->request['CURRENCY'] = (string)$currencyCode;
	}

	/**
	 * @param string $sln
	 */
	public function setSln(string $sln) {
		if (strlen($sln) > 283) {
			throw new Error("Excess of maximum length (283 characters) in sln");
		}
		$this->request['SLN'] = (string)$sln;
	}

	protected function initDefaultValues() {
		parent::initDefaultValues();
		$this->setCurrencyCode(CurrencyCode::RUBLE());
	}

	/**
	 * @param int $trXId
	 */
	protected function setTrXId(int $trXId) {
		if (strlen($trXId) > 12) {
			throw new Error("Excess of maximum length (12 digits) in trXId");
		}
		$this->request['ID'] = (string)$trXId;
	}

	/**
	 * @param string $session
	 */
	protected function setSession(string $session) {
		if (strlen($session) != 40) {
			throw new Error("Invalid length (40 characters) in session");
		}
		$this->request['SESSION'] = (string)$session;
	}

	/**
	 * @param int $amount
	 */
	protected function setAmount(int $amount) {
		$this->request['AMOUNT'] = (string)$amount;
	}

	/**
	 * @return string
	 */
	protected function getCommand() {
		return 'REFUND';
	}
}
