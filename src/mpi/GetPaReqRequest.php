<?php

namespace Platron\multicarta\mpi;

use DateTime;

class GetPaReqRequest extends Request {

	/**
	 * @param string $Merchant
	 * @param string $PAN
	 * @param string $OrderID
	 * @param string $SessionID
	 * @param DateTime $ExpDate
	 */
	public function __construct(
		string $Merchant,
		string $PAN,
		string $OrderID,
		string $SessionID,
		DateTime $ExpDate
	) {
		parent::__construct($Merchant);
		$this->setPAN($PAN);
		$this->setOrderID($OrderID);
		$this->setSessionID($SessionID);
		$this->setExpDate($ExpDate);
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
	 * @param DateTime $ExpDate
	 */
	protected function setExpDate(DateTime $ExpDate) {
		$this->request
			->Request
			->addChild('ExpDate', $ExpDate->format('ym'));
	}

	protected function initDefaultValues() {
		parent::initDefaultValues();
		$this->initEncodedPAReq();
	}

	protected function initEncodedPAReq() {
		$this->request
			->Request
			->addChild('EncodedPAReq', 'true');
	}

	/**
	 * @return string
	 */
	protected function getOperation() {
		return 'GetPAReqForm';
	}
}