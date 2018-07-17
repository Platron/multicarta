<?php

namespace Platron\multicarta\pos_xml\auth;

use Platron\multicarta\pos_xml\terminal\Request as TerminalRequest;
use Platron\multicarta\Error;
use Platron\multicarta\CurrencyCode;
use Platron\multicarta\Mita;
use Platron\multicarta\AdditionalRecurringData;

abstract class Request extends TerminalRequest {

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
	 * @param Mita $mita
	 */
	public function setMita(
		Mita $mita
	) {
		$this->request['MITA'] = (string)$mita;
	}

	/**
	 * @param AdditionalRecurringData $additionalRecurringData
	 */
	public function setAdditionalRecurringData(
		AdditionalRecurringData $additionalRecurringData
	) {
		$etid = $additionalRecurringData->getEtid();
		$origrrn = $additionalRecurringData->getOrigrrn();

		$this->request['ETID'] = $etid;
		$this->request['ORIGRRN'] = $origrrn;
	}

	/**
	 * @param FacilitatorData $facilitatorData
	 */
	public function setFacilitatorData(FacilitatorData $facilitatorData) {
		$pfsname = $facilitatorData->getPfsname();
		$smid = $facilitatorData->getSmid();
		$smmcc = $facilitatorData->getSmmcc();
		$smaddress = $facilitatorData->getSmaddress();
		$smcountry = $facilitatorData->getSmcountry();
		$smcity = $facilitatorData->getSmcity();
		$smpostcode = $facilitatorData->getSmpostcode();

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
