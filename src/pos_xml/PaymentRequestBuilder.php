<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\Error;
use Platron\multicarta\CurrencyCode;
use DateTime;

class PaymentRequestBuilder extends TerminalRequestBuilder {

	/**
	 * @param string $termid
	 * @param string $pan
	 * @param DateTime $expdate
	 * @param string $amount
	 * @param int $cvv2
	 * @param int $condition
	 * @param string $tdsdata
	 * @param string $invoice
	 */
	public function __construct(
		string $termid,
		string $pan,
		DateTime $expdate,
		string $amount,
		int $cvv2,
		int $condition,
		string $tdsdata,
		string $invoice
	) {
		parent::__construct($termid);
		$this->setPan($pan);
		$this->setExpdate($expdate);
		$this->setAmount($amount);
		$this->setCvv2($cvv2);
		$this->setCondition($condition);
		$this->setTdsdata($tdsdata);
		$this->setInvoice($invoice);
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
	 * @param string $pan
	 */
	protected function setPan(string $pan) {
		if (!preg_match('/^\d{0,19}$/', $pan)) {
			throw new Error(
				"Pan does not match the format
				(number with maximum length of 19 digits)"
			);
		}
		$this->request['PAN'] = $pan;
	}

	/**
	 * @param DateTime $expdate
	 */
	protected function setExpdate(DateTime $expdate) {
		$this->request['EXPDATE'] = $expdate->format('ym');
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
	 * @param int $cvv2
	 */
	protected function setCvv2(int $cvv2) {
		if (strlen($cvv2) > 4) {
			throw new Error("Excess of maximum length (4 digits) in cvv2");
		}
		$this->request['CVV2'] = (string)$cvv2;
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
	 * @param string $tdsdata
	 */
	protected function setTdsdata(string $tdsdata) {
		if (strlen($tdsdata) > 80) {
			throw new Error("Excess of maximum length (80 characters) in tdsdata");
		}
		$this->request['TDSDATA'] = $tdsdata;
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
	 * @return string
	 */
	protected function getCommand() {
		return 'PAYMENT';
	}
}
