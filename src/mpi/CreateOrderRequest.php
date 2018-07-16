<?php

namespace Platron\multicarta\mpi;

use Platron\multicarta\Error;
use Platron\multicarta\CurrencyCode;

class CreateOrderRequest extends Request {

	/**
	 * @param string $Merchant
	 * @param int $Amount
	 * @param string $Description
	 * @param CurrencyCode $Currency
	 * @param InterfaceLanguage $Language
	 * @param string $TDSVendorMerID
	 * @param string $TDSVendorName
	 */
	public function __construct(
		string $Merchant,
		int $Amount,
		string $Description,
		CurrencyCode $Currency,
		InterfaceLanguage $Language,
		string $TDSVendorMerID,
		string $TDSVendorName
	) {
		parent::__construct($Merchant);
		$this->setAmount($Amount);
		$this->setDescription($Description);
		$this->setCurrency($Currency);
		$this->setLanguage($Language);
		$this->setTDSVendorMerID($TDSVendorMerID);
		$this->setTDSVendorName($TDSVendorName);
	}

	/**
	 * @param CurrencyCode $Currency
	 */
	protected function setCurrency(CurrencyCode $Currency) {
		if ($this->request->Request->Order->Currency) {
			$this->request->Request->Order->Currency = (string)$Currency;
		} else {
			$this->request->Request->Order->addChild('Currency', (string)$Currency);
		}
	}

	/**
	 * @param InterfaceLanguage $Language
	 */
	protected function setLanguage(InterfaceLanguage $Language) {
		if ($this->request->Request->Language) {
			$this->request->Request->Language = (string)$Language;
		} else {
			$this->request->Request->addChild('Language', (string)$Language);
		}
	}

	protected function initDefaultValues() {
		parent::initDefaultValues();
		$this->initOrderType();
	}

	protected function initRequest() {
		parent::initRequest();
		$this->request
			->Request
			->Order
			->addChild('AddParams');
	}

	protected function initOrderType() {
		$this->request
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
	 * @param int $Amount
	 */
	protected function setAmount(int $Amount) {
		$this->request
			->Request
			->Order
			->addChild('Amount', (string)$Amount);
	}

	/**
	 * @param string $Description
	 */
	protected function setDescription(string $Description) {
		if (strrchr($Description, '#')) {
			throw new Error("Invalid character '#' in description");
		}
		$this->request
			->Request
			->Order
			->addChild('Description', $Description);
	}

	/**
	 * @param string $TDSVendorMerID
	 */
	protected function setTDSVendorMerID(string $TDSVendorMerID) {
		$this->request
			->Request
			->Order
			->AddParams
			->addChild('TDSVendorMerID', $TDSVendorMerID);
	}

	/**
	 * @param string $TDSVendorName
	 */
	protected function setTDSVendorName(string $TDSVendorName) {
		if (strlen($TDSVendorName) > 25) {
			throw new Error("Excess of maximum length (25 characters) in vendor name");
		}
		$this->request
			->Request
			->Order
			->AddParams
			->addChild('TDSVendorName', $TDSVendorName);
	}
}
