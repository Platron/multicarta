<?php

namespace classes\ps\multicarta\sdk;

use SimpleXMLElement;

abstract class RequestBuilder {

	/**
	 * @param SslData $sslData
	 */
	protected $sslData;

	/**
	 * @param string $xmlData
	 */
	protected $xmlData;

	/**
	 * @param SslData $sslData
	 * @param string $merchantId
	 */
	public function __construct(
		SslData $sslData,
		string $merchantId
	) {
		$this->sslData = $sslData;
		$this->initXmlData();
		$this->initDefaultValues();
		$this->setMerchantId($merchantId);
	}

	/**
	 * @return Request
	 */
	public function buildRequest() {
		$request = new Request(
			$this->getUrl(),
			$this->getPost(),
			$this->getCertificatePath(),
			$this->getPrivateKeyPath(),
			$this->getHeaders()
		);
		return $request;
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

	/**
	 * @return string
	 */
	protected function getUrl() {
		return 'https://mishop02.multicarta.ru:8443/Exec';
	}

	/**
	 * @return string
	 */
	protected function getPost() {
		return $this->xmlData->asXML();
	}

	/**
	 * @return string
	 */
	protected function getCertificatePath() {
		return $this->sslData->getCertificatePath();
	}

	/**
	 * @return string
	 */
	protected function getPrivateKeyPath() {
		return $this->sslData->getPrivateKeyPath();
	}

	/**
	 * @return array
	 */
	protected function getHeaders() {
		return ['Content-type: text/xml'];
	}
}
