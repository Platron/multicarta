<?php

namespace Platron\multicarta\pos_xml\preauth;

use Platron\multicarta\pos_xml\auth\Request as AuthRequest;
use Platron\multicarta\Error;
use Platron\multicarta\CurrencyCode;
use DateTime;

class Request extends AuthRequest {

	/**
	 * @param string $termid
	 * @param string $amount
	 * @param CurrencyCode $currency
	 * @param string $invoice
	 * @param int $condition
	 * @param string $pan
	 * @param DateTime $expdate
	 * @param int $cvv2
	 */
	public function __construct(
		string $termid,
		string $amount,
		CurrencyCode $currency,
		string $invoice,
		int $condition,
		string $pan,
		DateTime $expdate,
		int $cvv2
	) {
		parent::__construct(
			$termid,
			$amount,
			$currency,
			$invoice,
			$condition
		);
		$this->setPan($pan);
		$this->setExpdate($expdate);
		$this->setCvv2($cvv2);
	}

	/**
	 * @param string $tdsdata
	 */
	public function setTdsdata(string $tdsdata) {
		if (strlen($tdsdata) > 80) {
			throw new Error("Excess of maximum length (80 characters) in tdsdata");
		}
		$this->request['TDSDATA'] = $tdsdata;
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
	 * @param int $cvv2
	 */
	protected function setCvv2(int $cvv2) {
		if (strlen($cvv2) > 4) {
			throw new Error("Excess of maximum length (4 digits) in cvv2");
		}
		$this->request['CVV2'] = (string)$cvv2;
	}

	/**
	 * @return string
	 */
	protected function getCommand() {
		return 'PREAUTH';
	}
}
