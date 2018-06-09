<?php

namespace Platron\multicarta\mpi;

class ProcessPaResRequestBuilder extends RequestBuilder {

	/**
	 * @param string $Merchant
	 * @param string $PAN
	 * @param string $OrderID
	 * @param string $SessionID
	 * @param string $PARes
	 */
	public function __construct(
		string $Merchant,
		string $PAN,
		string $OrderID,
		string $SessionID,
		string $PARes
	) {
		parent::__construct($Merchant);
		$this->setPAN($PAN);
		$this->setOrderID($OrderID);
		$this->setSessionID($SessionID);
		$this->setPARes($PARes);
	}

	/**
	 * @param string $PAN
	 */
	protected function setPAN(string $PAN) {
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
	 * @param string $PARes
	 */
	protected function setPARes(string $PARes) {
		$this->request
			->Request
			->addChild('PARes', $PARes);
	}

	/**
	 * @return string
	 */
	protected function getOperation() {
		return 'ProcessPARes';
	}
}