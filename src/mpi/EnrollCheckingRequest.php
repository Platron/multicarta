<?php

namespace Platron\multicarta\mpi;

class EnrollCheckingRequest extends Request {

	/**
 	 * @param string $Merchant
	 * @param string $PAN
	 * @param string $OrderID
	 * @param string $SessionID
	 */
	public function __construct(
		string $Merchant,
		string $PAN,
		string $OrderID,
		string $SessionID
	) {
		parent::__construct($Merchant);
		$this->setPAN($PAN);
		$this->setOrderID($OrderID);
		$this->setSessionID($SessionID);
	}

	/**
	 * @param string $PAN
	 */
	protected function setPAN(string $PAN) {
		$this->request
			->Request
			->addChild('PAN', $PAN);
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