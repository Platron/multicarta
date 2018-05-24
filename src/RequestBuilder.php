<?php

namespace Platron\multicarta;

use SimpleXMLElement;

abstract class RequestBuilder {

	/**
	 * @param SimpleXMLElement $xmlData
	 */
	protected $xmlData;

	/**
	 * @param string $merchantId
	 */
	public function __construct(string $merchantId) {
		$this->initXmlData();
		$this->initDefaultValues();
		$this->setMerchantId($merchantId);
	}

	/**
	 * @return string
	 */
	public function buildRequest() {
		return $this->xmlData->asXML();
	}

	/**
	 * @return string
	 */
	abstract protected function getOperation();

	/**
	 * @param string $merchantId
	 */
	protected function setMerchantId(string $merchantId) {
		$this->xmlData
			->Request
			->Order
			->addChild('Merchant', $merchantId);
	}

	protected function initDefaultValues() {
		$this->initOperation();
	}

	protected function initXmlData() {
		$this->xmlData = new SimpleXMLElement(
			'<?xml version="1.0" encoding="UTF-8"?><TKKPG/>'
		);
		$this->xmlData
			->addChild('Request');
		$this->xmlData
			->Request
			->addChild('Order');
	}

	protected function initOperation() {
		$this->xmlData
			->Request
			->addChild('Operation', $this->getOperation());
	}
}
