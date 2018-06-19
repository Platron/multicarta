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

	/**
	 * @param Mita $mita
	 */
	public function setMita(Mita $mita) {
		$this->request['MITA'] = (string)$mita;
	}

	/**
	 * @param string $etid
	 */
	public function setEtid(string $etid) {
		if (strlen($etid) > 20) {
			throw new Error("Excess of maximum length (20 characters) in etid");
		}
		$this->request['ETID'] = $etid;
	}

	/**
	 * @param string $origrrn
	 */
	public function setOrigrrn(string $origrrn) {
		if (strlen($origrrn) > 12) {
			throw new Error("Excess of maximum length (12 characters) in origrrn");
		}
		$this->request['ORIGRRN'] = $origrrn;
	}

	/**
	 * @param string $pfsname
	 */
	public function setPfsname(string $pfsname) {
		if (strlen($pfsname) > 18) {
			throw new Error("Excess of maximum length (18 characters) in pfsname");
		}
		$this->request['PFSNAME'] = $pfsname;
	}

	/**
	 * @param string $smid
	 */
	public function setSmid(string $smid) {
		if (strlen($smid) > 15) {
			throw new Error("Excess of maximum length (15 characters) in smid");
		}
		$this->request['SMID'] = $smid;
	}

	/**
	 * @param int $smmcc
	 */
	public function setSmmcc(int $smmcc) {
		if (strlen($smmcc) > 4) {
			throw new Error("Excess of maximum length (4 digits) in smmcc");
		}
		$this->request['SMMCC'] = (string)$smmcc;
	}

	/**
	 * @param string $smaddress
	 */
	public function setSmaddress(string $smaddress) {
		if (strlen($smaddress) > 48) {
			throw new Error("Excess of maximum length (48 characters) in smaddress");
		}
		$this->request['SMADDRESS'] = $smaddress;
	}

	/**
	 * @param string $smcountry
	 */
	public function setSmcountry(string $smcountry) {
		if (strlen($smcountry) > 3) {
			throw new Error("Excess of maximum length (3 characters) in smcountry");
		}
		$this->request['SMCOUNTRY'] = $smcountry;
	}

	/**
	 * @param string $smcity
	 */
	public function setSmcity(string $smcity) {
		if (strlen($smcity) > 13) {
			throw new Error("Excess of maximum length (13 characters) in smcity");
		}
		$this->request['SMCITY'] = $smcity;
	}

	/**
	 * @param string $smpostcode
	 */
	public function setSmpostcode(string $smpostcode) {
		if (strlen($smpostcode) > 10) {
			throw new Error("Excess of maximum length (10 characters) in smpostcode");
		}
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
