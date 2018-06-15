<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\Error;
use Platron\multicarta\CurrencyCode;

abstract class AuthRequestBuilder extends TerminalRequestBuilder {

	/**
	 * @param string $termid
	 * @param string $amount
	 * @param string $invoice
	 * @param int $condition
	 */
	public function __construct(
		string $termid,
		string $amount,
		string $invoice,
		int $condition
	) {
		parent::__construct($termid);
		$this->setAmount($amount);
		$this->setInvoice($invoice);
		$this->setCondition($condition);
	}

	/**
	 * @param CurrencyCode $currency
	 */
	public function setCurrency(CurrencyCode $currency) {
		$this->request['CURRENCY'] = (string)$currency;
	}

	protected function initDefaultValues() {
		parent::initDefaultValues();
		$this->setCurrency(CurrencyCode::RUBLE());
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
	 * @param string $invoice
	 */
	protected function setInvoice(string $invoice) {
		if (strlen($invoice) > 16) {
			throw new Error("Excess of maximum length (16 characters) in invoice");
		}
		$this->request['INVOICE'] = $invoice;
	}

	/**
	 * @param int $condition
	 */
	protected function setCondition(int $condition) {
		if (strlen($condition) > 1) {
			throw new Error("Excess of maximum length (1 digits) in condition");
		}
		$this->request['CONDITION'] = (string)$condition;
	}
}
