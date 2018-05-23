<?php

namespace Platron\multicarta;

use SimpleXMLElement;

class CreateOrderRequestBuilder extends RequestBuilder {

	/**
	 *
	 * @param SslData $sslData
	 * @param string $merchantId
	 * @param string $amount
	 * @param string $description
	 * @param string $vendorId
	 * @param string $vendorName
	 */
	public function __construct(
		SslData $sslData,
		string $merchantId,
		string $amount,
		string $description,
		string $vendorId,
		string $vendorName
	) {
		parent::__construct($sslData, $merchantId);
		$this->setAmount($amount);
		$this->setDescription($description);
		$this->setVendorId($vendorId);
		$this->setVendorName($vendorName);
	}

	/**
	 * @param InterfaceLanguage $interfaceLanguage
	 */
	public function setInterfaceLanguage(InterfaceLanguage $interfaceLanguage) {
		$this->xmlData->Request->addChild('Language', (string)$interfaceLanguage);
	}

	/**
	 * @param CurrencyCode $currencyCode
	 */
	public function setCurrencyCode(CurrencyCode $currencyCode) {
		$this->xmlData->Request->Order->addChild('Currency', (string)$currencyCode);
	}

	protected function initDefaultValues() {
		parent::initDefaultValues();
		$this->initOrderType();
		$this->setInterfaceLanguage(InterfaceLanguage::RUSSIAN());
		$this->setCurrencyCode(CurrencyCode::RUBLE());
	}

	protected function initXmlData() {
		parent::initXmlData();
		$this->xmlData
			->Request
			->Order
			->addChild('AddParams');
	}

	protected function initOrderType() {
		$this->xmlData
			->Request
			->Order
			->addChild('OrderType', $this->getOrderType());
	}

	/**
	 * @return string
	 */
	protected function getOperation() {
		return 'CreateOrder';
	}

	/**
	 * @return string
	 */
	protected function getOrderType() {
		return '3DSOnly';
	}

	/**
	 * @param string $amount
	 */
	protected function setAmount(string $amount) {
		$this->xmlData
			->Request
			->Order
			->addChild('Amount', $amount);
	}

	/**
	 * @param string $description
	 */
	protected function setDescription(string $description) {
		$this->xmlData
			->Request
			->Order
			->addChild('Description', $description);
	}

	/**
	 * @param string $vendorId
	 */
	protected function setVendorId(string $vendorId) {
		$this->xmlData
			->Request
			->Order
			->AddParams
			->addChild('TDSVendorMerID', $vendorId);
	}

	/**
	 * @param string $vendorName
	 */
	protected function setVendorName(string $vendorName) {
		$this->xmlData
			->Request
			->Order
			->AddParams
			->addChild('TDSVendorName', $vendorName);
	}
}
