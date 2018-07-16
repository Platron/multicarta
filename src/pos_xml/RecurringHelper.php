<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\BankCardBrand;

class RecurringHelper {

	const CONDITION = 0;
	const NEED_ADDITIONAL_DATA = 1;

	/**
	 * @param BankCardBrand $bankCardBrand
	 * @param Mita $mita
	 * @return string
	 */
	public function getCondition(
		BankCardBrand $bankCardBrand,
		Mita $mita
	) {
		$dataSet = $this->getDataSet($bankCardBrand, $mita);
		return $dataSet[self::CONDITION];
	}

	/**
	 * @param BankCardBrand $bankCardBrand
	 * @param Mita $mita
	 * @return boolean
	 */
	public function needAdditionalData(
		BankCardBrand $bankCardBrand,
		Mita $mita
	) {
		$dataSet = $this->getDataSet($bankCardBrand, $mita);
		return $dataSet[self::NEED_ADDITIONAL_DATA];
	}

	/**
	 * @param BankCardBrand $bankCardBrand
	 * @param Mita $mita
	 * @return array
	 */
	private function getDataSet(
		BankCardBrand $bankCardBrand,
		Mita $mita
	) {
		$matchTable = $this->getMatchTable();
		if (!isset($matchTable[(string)$bankCardBrand]
			[(string)$mita]
		)) {
			throw new Error("Wrong parameter combination");
		}
		$dataSet = $matchTable[(string)$bankCardBrand]
			[(string)$mita];
		return $dataSet;
	}

	/**
	 * @return array
	 */
	private function getMatchTable() {
		return [
			BankCardBrand::VISA => [
				Mita::START_RECURRING => [
					self::CONDITION => '5',
					self::NEED_ADDITIONAL_DATA => true
				],
				Mita::INITIATION_BY_MERCHANT => [
					self::CONDITION => '1',
					self::NEED_ADDITIONAL_DATA => true
				],
				Mita::INITIATION_BY_CARDHOLDER => [
					self::CONDITION => '1',
					self::NEED_ADDITIONAL_DATA => true
				]
			],
			BankCardBrand::MASTERCARD => [
				Mita::START_RECURRING => [
					self::CONDITION => '5',
					self::NEED_ADDITIONAL_DATA => false
				],
				Mita::INITIATION_BY_MERCHANT => [
					self::CONDITION => '6',
					self::NEED_ADDITIONAL_DATA => false
				],
				Mita::INITIATION_BY_CARDHOLDER => [
					self::CONDITION => '6',
					self::NEED_ADDITIONAL_DATA => false
				]
			],
			BankCardBrand::MIR => [
				Mita::START_RECURRING => [
					self::CONDITION => '5',
					self::NEED_ADDITIONAL_DATA => true
				],
				Mita::INITIATION_BY_MERCHANT => [
					self::CONDITION => '6',
					self::NEED_ADDITIONAL_DATA => true
				],
				Mita::INITIATION_BY_CARDHOLDER => [
					self::CONDITION => '1',
					self::NEED_ADDITIONAL_DATA => true
				]
			]
		];
	}
}