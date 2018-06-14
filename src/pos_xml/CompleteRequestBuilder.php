<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\Error;
use Platron\multicarta\CurrencyCode;

class CompleteRequestBuilder extends TerminalRequestBuilder {

	/**
	 * @param string $termid
	 * @param string $id
	 * @param string $amount
	 * @param int $condition
	 * @param string $invoice
	 * @param string $authcode
	 * @param string $invoiceorig
	 */
	public function __construct(
		string $termid,
		string $id,
		string $amount,
		int $condition,
		string $invoice,
		string $authcode,
		string $invoiceorig
	) {
		parent::__construct($termid);
		$this->setId($id);
		$this->setAmount($amount);
		$this->setCondition($condition);
		$this->setInvoice($invoice);
		$this->setAuthcode($authcode);
		$this->setInvoiceorig($invoiceorig);
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
	 * @param string $id
	 */
	protected function setId(string $id) {
		if (strlen($id) > 12) {
			throw new Error("Excess of maximum length (12 characters) in id");
		}
		$this->request['ID'] = $id;
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
	 * @param int $condition
	 */
	protected function setCondition(int $condition) {
		if (strlen($condition) > 1) {
			throw new Error("Excess of maximum length (1 digits) in condition");
		}
		$this->request['CONDITION'] = (string)$condition;
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
	 * @param string $authcode
	 */
	protected function setAuthcode(string $authcode) {
		if (strlen($authcode) > 8) {
			throw new Error("Excess of maximum length (8 characters) in authcode");
		}
		$this->request['AUTHCODE'] = $authcode;
	}

	/**
	 * @param string $invoiceorig
	 */
	protected function setInvoiceorig(string $invoiceorig) {
		if (strlen($invoiceorig) > 16) {
			throw new Error("Excess of maximum length (16 characters) in invoiceorig");
		}
		$this->request['INVOICEORIG'] = $invoiceorig;
	}

	/**
	 * @return string
	 */
	protected function getCommand() {
		return 'COMPLETE';
	}
}
