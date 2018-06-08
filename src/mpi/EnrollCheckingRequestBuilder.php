<?php

namespace Platron\multicarta\mpi;

class EnrollCheckingRequestBuilder extends RequestBuilder {

	/**
 	 * @param string $Merchant
	 * @param int $PAN
	 * @param string $OrderID
	 * @param string $SessionID
	 */
	public function __construct(
		string $Merchant,
		int $PAN,
		string $OrderID,
		string $SessionID
	) {
		parent::__construct($Merchant);
		$this->setPAN($PAN);
		$this->setOrderID($OrderID);
		$this->setSessionID($SessionID);
	}

	/**
	 * @param int $PAN
	 */
	protected function setPAN(int $PAN) {
		$this->request
			->Request
			->addChild('PAN', (string)$PAN);
	}

	/**
	 * @param string $OrderID
	 */
	protected function setOrderID(string $OrderID) {
		$this->request
			->Request
			->Order
			->addChild('OrderID', $OrderID);
	}

	/**
	 * @param string $SessionID
	 */
	protected function setSessionID(string $SessionID) {
		$this->request
			->Request
			->addChild('SessionID', $SessionID);
	}

	/**
	 * @return string
	 */
	protected function getOperation() {
		return 'Check3DSEnrolled';
	}
}