<?php

namespace Platron\multicarta;

class TdsDataGenerator {

	/**
	 * @param PaymentSystemBrand $paymentSystemBrand
	 * @param string $cavv
	 * @param string $xid
	 * @return string
	 */
	public function generate(
		PaymentSystemBrand $paymentSystemBrand,
		string $cavv,
		string $xid
	) {
		$firstSubField = $this->getFirstSubField($xid);
		$secondSubField = $this->getSecondSubField($paymentSystemBrand, $cavv);

		return $firstSubField . $secondSubField;
	}

	/**
	 * @param string $xid
	 * @return string
	 */
	private function getFirstSubField(string $xid) {
		$result = $this->convertBase64ToUpperCaseHex($xid);
		return $result;
	}

	/**
	 * @param PaymentSystemBrand $paymentSystemBrand
	 * @param string $cavv
	 * @return string
	 */
	private function getSecondSubField(
		PaymentSystemBrand $paymentSystemBrand,
		string $cavv
	) {
		switch ($paymentSystemBrand->getValue()) {
			case PaymentSystemBrand::VISA:
			case PaymentSystemBrand::MIR:
				$result = $this->convertBase64ToUpperCaseHex(
					$cavv
				);
				break;

			case PaymentSystemBrand::MASTERCARD:
				$result = $this->replaceSymbolListToHex(
					$cavv,
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