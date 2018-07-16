<?php

namespace Platron\multicarta;

class TdsDataGenerator {

	/**
	 * @param BankCardBrand $bankCardBrand
	 * @param string $cavv
	 * @param string $xid
	 * @return string
	 */
	public function generate(
		BankCardBrand $bankCardBrand,
		string $cavv,
		string $xid
	) {
		$firstSubField = $this->getFirstSubField($xid);
		$secondSubField = $this->getSecondSubField($bankCardBrand, $cavv);

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
	 * @param BankCardBrand $bankCardBrand
	 * @param string $cavv
	 * @return string
	 */
	private function getSecondSubField(
		BankCardBrand $bankCardBrand,
		string $cavv
	) {
		switch ($bankCardBrand->getValue()) {
			case BankCardBrand::VISA:
			case BankCardBrand::MIR:
				$result = $this->convertBase64ToUpperCaseHex(
					$cavv
				);
				break;

			case BankCardBrand::MASTERCARD:
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