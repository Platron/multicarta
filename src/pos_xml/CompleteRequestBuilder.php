<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\Error;

class CompleteRequestBuilder extends AuthRequestBuilder {

	/**
	 * @param string $termid
	 * @param string $amount
	 * @param string $invoice
	 * @param int $condition
	 * @param string $id
	 * @param string $authcode
	 * @param string $invoiceorig
	 */
	public function __construct(
		string $termid,
		string $amount,
		string $invoice,
		int $condition,
		string $id,
		string $authcode,
		string $invoiceorig
	) {
		parent::__construct(
			$termid,
			$amount,
			$invoice,
			$condition
		);
		$this->setId($id);
		$this->setAuthcode($authcode);
		$this->setInvoiceorig($invoiceorig);
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
