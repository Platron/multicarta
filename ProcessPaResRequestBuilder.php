<?php

namespace classes\ps\multicarta\sdk;

use SimpleXMLElement;

class ProcessPaResRequestBuilder extends RequestBuilder {

	/**
	 * @param SslData $sslData
	 * @param string $merchantId
	 * @param string $pan
	 * @param string $orderId
	 * @param string $sessionId
	 * @param string $paRes
	 */
	public function __construct(
		SslData $sslData,
		string $merchantId,
		string $pan,
		string $orderId,
		string $sessionId,
		string $paRes
	) {
		parent::__construct($sslData, $merchantId);
		$this->setPan($pan);
		$this->setOrderId($orderId);
		$this->setSessionId($sessionId);
		$this->setPaRes($paRes);
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
	 * @param string $paRes
	 */
	protected function setPaRes(string $paRes) {
		$this->xmlData
			->Request
			->addChild('PARes', $paRes);
	}

	/**
	 * @return string
	 */
	protected function getOperation() {
		return 'ProcessPARes';
	}
}