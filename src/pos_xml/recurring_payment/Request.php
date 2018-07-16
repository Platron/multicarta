<?php

namespace Platron\multicarta\pos_xml\recurring_payment;

use Platron\multicarta\pos_xml\auth\Request as AuthRequest;
use Platron\multicarta\Error;
use Platron\multicarta\CurrencyCode;

class Request extends AuthRequest {

	/**
	 * @param string $termid
	 * @param string $amount
	 * @param CurrencyCode $currency
	 * @param string $invoice
	 * @param int $condition
	 * @param string $id
	 */
	public function __construct(
		string $termid,
		string $amount,
		CurrencyCode $currency,
		string $invoice,
		int $condition,
		string $id
	) {
		parent::__construct(
			$termid,
			$amount,
			$currency,
			$invoice,
			$condition
		);
		$this->setId($id);
	}

	/**
	 * @param string $aet
	 */
	public function setAet(string $aet) {
		if (strlen($aet) != 82) {
			throw new Error("Invalid length (82 characters) in aet");
		}
		$this->request['AET'] = $aet;
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
	 * @return string
	 */
	protected function getCommand() {
		return 'PAYMENT';
	}
}
