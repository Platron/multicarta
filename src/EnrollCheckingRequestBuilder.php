<?php

namespace Platron\multicarta;

use SimpleXMLElement;

class EnrollCheckingRequestBuilder extends RequestBuilder {

	/**
 	 * @param string $merchantId
	 * @param string $pan
	 * @param string $orderId
	 * @param string $sessionId
	 */
	public function __construct(
		string $merchantId,
		string $pan,
		string $orderId,
		string $sessionId
	) {
		parent::__construct($merchantId);
		$this->setPan($pan);
		$this->setOrderId($orderId);
		$this->setSessionId($sessionId);
	}

	/**
	 * @param string $pan
	 */
	protected function setPan(string $pan) {
		$this->xmlData
			->Request
			->addChild('PAN', $pan);
	}

	/**
	 * @param string $orderId
	 */
	protected function setOrderId(string $orderId) {
		$this->xmlData
			->Request
			->Order
			->addChild('OrderID', $orderId);
	}

	/**
	 * @param string $sessionId
	 */
	protected function setSessionId(string $sessionId) {
		$this->xmlData
			->Request
			->addChild('SessionID', $sessionId);
	}

	/**
	 * @return string
	 */
	protected function getOperation() {
		return 'Check3DSEnrolled';
	}
}