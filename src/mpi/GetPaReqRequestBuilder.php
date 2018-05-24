<?php

namespace Platron\multicarta\mpi;

class GetPaReqRequestBuilder extends RequestBuilder {

	/**
	 * @param string $merchantId
	 * @param string $pan
	 * @param string $orderId
	 * @param string $sessionId
	 * @param string $expDate
	 */
	public function __construct(
		string $merchantId,
		string $pan,
		string $orderId,
		string $sessionId,
		string $expDate
	) {
		parent::__construct($merchantId);
		$this->setPan($pan);
		$this->setOrderId($orderId);
		$this->setSessionId($sessionId);
		$this->setExpDate($expDate);
	}

	/**
	 * @param string $pan
	 */
	protected function setPan(string $pan) {
		$this->request
			->Request
			->addChild('PAN', $pan);
	}

	/**
	 * @param string $orderId
	 */
	protected function setOrderId(string $orderId) {
		$this->request
			->Request
			->Order
			->addChild('OrderID', $orderId);
	}

	/**
	 * @param string $sessionId
	 */
	protected function setSessionId(string $sessionId) {
		$this->request
			->Request
			->addChild('SessionID', $sessionId);
	}

	/**
	 * @param string $expDate
	 */
	protected function setExpDate(string $expDate) {
		$this->request
			->Request
			->addChild('ExpDate', $expDate);
	}

	protected function initDefaultValues() {
		parent::initDefaultValues();
		$this->initEncodedPaReq();
	}

	protected function initEncodedPaReq() {
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