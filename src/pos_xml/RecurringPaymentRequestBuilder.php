<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\Error;

class RecurringPaymentRequestBuilder extends AuthRequestBuilder {

	/**
	 * @param string $termid
	 * @param string $amount
	 * @param string $invoice
	 * @param int $condition
	 * @param string $id
	 */
	public function __construct(
		string $termid,
		string $amount,
		string $invoice,
		int $condition,
		string $id
	) {
		parent::__construct(
			$termid,
			$amount,
			$invoice,
			$condition
		);
		$this->setId($id);
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
