<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\CurrencyCode;
use DateTime;

class PaymentRequestBuilder extends TerminalRequestBuilder {

	/**
	 * @param string $terminalId
	 */
	public function __construct(
		string $terminalId,
		int $pan,
		DateTime $expiryDate,
		int $amount,
		int $securityCode,
		int $condition,
		string $tdsData,
		string $invoice
	) {
		parent::__construct($terminalId);
		$this->setPan($pan);
		$this->setExpiryDate($expiryDate);
		$this->setAmount($amount);
		$this->setCurrencyCode($currencyCode);
		$this->setCondition($condition);
		$this->setTdsData($tdsData);
		$this->setInvoice($invoice);
	}

	/**
	 * @param CurrencyCode $currencyCode
	 */
	public function setCurrencyCode(CurrencyCode $currencyCode) {
		$this->request['CURRENCY'] = (string)$currencyCode;
	}

	protected function initDefaultValues() {
		parent::initDefaultValues();
		$this->setCurrencyCode(CurrencyCode::RUBLE());
	}

	/**
	 * @param int $pan
	 */
	protected function setPan(int $pan) {
		if (strlen($pan) > 19) {
			throw new BuilderError("Excess of maximum length (19 digits) in pan");
		}
		$this->request['PAN'] = (string)$pan;
	}

	/**
	 * @param DateTime $expiryDate
	 */
	protected function setExpiryDate(DateTime $expiryDate) {
		$this->request['EXPDATE'] = $expiryDate->format('ym');
	}

	/**
	 * @param int $amount
	 */
	protected function setAmount(int $amount) {
		$this->request['AMOUNT'] = (string)$amount;
	}

	/**
	 * @param int $securityCode
	 */
	protected function setSecurityCode(int $securityCode) {
		if (strlen($securityCode) > 4) {
			throw new BuilderError("Excess of maximum length (4 digits) in security code");
		}
		$this->request['CVV2'] = (string)$securityCode;
	}

	/**
	 * @param int $condition
	 */
	protected function setCondition(int $condition) {
		if (strlen($condition) > 1) {
			throw new BuilderError("Excess of maximum length (1 digits) in condition");
		}
		$this->request['CONDITION'] = (string)$condition;
	}

	/**
	 * @param string $tdsData
	 */
	protected function setTdsData(string $tdsData) {
		if (strlen($tdsData) > 80) {
			throw new BuilderError("Excess of maximum length (80 characters) in tds data");
		}
		$this->request['TDSDATA'] = (string)$tdsData;
	}

	/**
	 * @param string $invoice
	 */
	protected function setInvoice(string $invoice) {
		if (strlen($invoice) > 16) {
			throw new BuilderError("Excess of maximum length (16 characters) in invoice");
		}
		$this->request['INVOICE'] = (string)$invoice;
	}

	/**
	 * @return string
	 */
	protected function getCommand() {
		return 'PAYMENT';
	}
}
