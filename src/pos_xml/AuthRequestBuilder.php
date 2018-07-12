<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\Error;
use Platron\multicarta\CurrencyCode;

abstract class AuthRequestBuilder extends TerminalRequestBuilder {

	/**
	 * @param string $termid
	 * @param string $amount
	 * @param CurrencyCode $currency
	 * @param string $invoice
	 * @param int $condition
	 */
	public function __construct(
		string $termid,
		string $amount,
		CurrencyCode $currency,
		string $invoice,
		int $condition
	) {
		parent::__construct($termid);
		$this->setAmount($amount);
		$this->setCurrency($currency);
		$this->setInvoice($invoice);
		$this->setCondition($condition);
	}

	/**
	 * @param RecurringData $recurringData
	 */
	public function setRecurringData(RecurringData $recurringData) {
		$mita = $recurringData->getMita();
		$etid = $recurringData->getEtid();
		$origrrn = $recurringData->getOrigrrn();

		$this->request['MITA'] = (string)$mita;
		$this->request['ETID'] = $etid;
		$this->request['ORIGRRN'] = $origrrn;
	}

	public function setPaymentFacilitatorData(PaymentFacilitatorData $paymentFacilitatorData) {
		$pfsname = $paymentFacilitatorData->getPfsname();
		$smid = $paymentFacilitatorData->getSmid();
		$smmcc = $paymentFacilitatorData->getSmmcc();
		$smaddress = $paymentFacilitatorData->getSmaddress();
		$smcountry = $paymentFacilitatorData->getSmcountry();
		$smcity = $paymentFacilitatorData->getSmcity();
		$smpostcode = $paymentFacilitatorData->getSmpostcode();

		$this->request['PFSNAME'] = $pfsname;
		$this->request['SMID'] = $smid;
		$this->request['SMMCC'] = (string)$smmcc;
		$this->request['SMADDRESS'] = $smaddress;
		$this->request['SMCOUNTRY'] = $smcountry;
		$this->request['SMCITY'] = $smcity;
		$this->request['SMPOSTCODE'] = $smpostcode;
	}

	/**
	 * @param string $dsrp
	 */
	public function setDsrp(string $dsrp) {
		if (strlen($dsrp) > 1) {
			throw new Error("Excess of maximum length (1 characters) in dsrp");
		}
		$this->request['DSRP'] = $dsrp;
	}

	/**
	 * @param string $waid
	 */
	public function setWaid(string $waid) {
		if (strlen($waid) > 3) {
			throw new Error("Excess of maximum length (3 characters) in waid");
		}
		$this->request['WAID'] = $waid;
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
	 * @param CurrencyCode $currency
	 */
	protected function setCurrency(CurrencyCode $currency) {
		$this->request['CURRENCY'] = (string)$currency;
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
