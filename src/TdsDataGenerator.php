<?php

namespace Platron\multicarta;

class TdsDataGenerator {

	/**
	 * @var PaymentSystemBrand $paymentSystemBrand
	 */
	private $paymentSystemBrand;

	/**
	 * @var string $cavv
	 */
	private $cavv;

	/**
	 * @var string $xid
	 */
	private $xid;

	/**
	 * @param PaymentSystemBrand $paymentSystemBrand
	 * @param string $cavv
	 * @param string $xid
	 */
	public function __construct(
		PaymentSystemBrand $paymentSystemBrand,
		string $cavv,
		string $xid
	) {
		$this->paymentSystemBrand = $paymentSystemBrand;
		$this->cavv = $cavv;
		$this->xid = $xid;
	}

	/**
	 * @return string
	 */
	public function getTdsData() {
		$firstSubField = $this->getFirstSubField();
		$secondSubField = $this->getSecondSubField();

		return $firstSubField . $secondSubField;
	}

	/**
	 * @return string
	 */
	private function getFirstSubField() {
		$result = $this->convertBase64ToUpperCaseHex(
			$this->xid
		);
		return $result;
	}

	/**
	 * @return string
	 */
	private function getSecondSubField() {
		switch ($this->paymentSystemBrand->getValue()) {
			case PaymentSystemBrand::VISA:
			case PaymentSystemBrand::MIR:
				$result = $this->convertBase64ToUpperCaseHex(
					$this->cavv
				);
				break;

			case PaymentSystemBrand::MASTERCARD:
				$result = $this->replaceSymbolListToHex(
					$this->cavv,
					['+', '/', '=']
				);
				break;
			
			default:
				throw new Error("Unknown payment system");
				break;
		}
		return $result;
	}

	/**
	 * @param string $value
	 * @return string
	 */
	private function convertBase64ToUpperCaseHex(string $value) {
		$result = strtoupper(
			bin2hex(
				base64_decode($value)
			)
		);
		return $result;
	}

	/**
	 * @param string $value
	 * @param array $symbolList
	 * @return string
	 */
	private function replaceSymbolListToHex(string $value, array $symbolList) {
		$shieldedSymbolList = [];
		foreach ($symbolList as $key => $symbol) {
			$shieldedSymbolList[$key] = '\\' . $symbol;
		}
		$regExp = '/' . implode('|', $shieldedSymbolList) . '/';
		$result = preg_replace_callback(
			$regExp,
			function ($matches) {
				return bin2hex($matches[0]);
			},
			$value
		);
		return $result;
	}
}