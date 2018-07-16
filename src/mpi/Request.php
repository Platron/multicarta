<?php

namespace Platron\multicarta\mpi;

use SimpleXMLElement;

abstract class Request {

	/**
	 * @param SimpleXMLElement $request
	 */
	protected $request;

	/**
	 * @param string $merchant
	 */
	public function __construct(string $merchant) {
		$this->initRequest();
		$this->initDefaultValues();
		$this->setMerchant($merchant);
	}

	/**
	 * @return SimpleXMLElement
	 */
	public function asSimpleXml() {
		return $this->request;
	}

	/**
	 * @return string
	 */
	abstract protected function getOperation();

	/**
	 * @param string $merchant
	 */
	protected function setMerchant(string $merchant) {
		$this->request
			->Request
			->Order
			->addChild('Merchant', $merchant);
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
