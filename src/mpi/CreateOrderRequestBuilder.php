<?php

namespace Platron\multicarta\mpi;

use Platron\multicarta\CurrencyCode;

class CreateOrderRequestBuilder extends RequestBuilder {

	/**
	 * @param string $merchantId
	 * @param int $amount
	 * @param string $description
	 * @param string $vendorId
	 * @param string $vendorName
	 */
	public function __construct(
		string $merchantId,
		int $amount,
		string $description,
		string $vendorId,
		string $vendorName
	) {
		parent::__construct($merchantId);
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
	 * @param int $amount
	 */
	protected function setAmount(int $amount) {
		$this->xmlData
			->Request
			->Order
			->addChild('Amount', (string)$amount);
	}

	/**
	 * @param string $description
	 */
	protected function setDescription(string $description) {
		if (strrchr($description, '#')) {
			throw new BuilderError("Invalid character '#' in description");
		}
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
		if (strlen($vendorName) > 25) {
			throw new BuilderError("Excess of maximum length (25 characters) in vendor name");
		}
		$this->xmlData
			->Request
			->Order
			->AddParams
			->addChild('TDSVendorName', $vendorName);
	}
}
