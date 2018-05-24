<?php

namespace Platron\multicarta\mpi;

use SimpleXMLElement;

abstract class RequestBuilder {

	/**
	 * @param SimpleXMLElement $request
	 */
	protected $request;

	/**
	 * @param string $merchantId
	 */
	public function __construct(string $merchantId) {
		$this->initRequest();
		$this->initDefaultValues();
		$this->setMerchantId($merchantId);
	}

	/**
	 * @return SimpleXMLElement
	 */
	public function getRequest() {
		return $this->request;
	}

	/**
	 * @return string
	 */
	abstract protected function getOperation();

	/**
	 * @param string $merchantId
	 */
	protected function setMerchantId(string $merchantId) {
		$this->request
			->Request
			->Order
			->addChild('Merchant', $merchantId);
	}

	protected function initDefaultValues() {
		$this->initOperation();
	}

	protected function initRequest() {
		$this->request = new SimpleXMLElement(
			'<?xml version="1.0" encoding="UTF-8"?><TKKPG/>'
		);
		$this->request
			->addChild('Request');
		$this->request
			->Request
			->addChild('Order');
	}

	protected function initOperation() {
		$this->request
			->Request
			->addChild('Operation', $this->getOperation());
	}
}
