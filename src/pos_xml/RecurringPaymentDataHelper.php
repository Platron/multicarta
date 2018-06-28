<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\PaymentSystemBrand;

class RecurringPaymentDataHelper {

	const CONDITION = 0;
	const NEED_ADDITIONAL_DATA = 1;

	/**
	 * @param PaymentSystemBrand $paymentSystemBrand
	 * @param Mita $mita
	 * @return string
	 */
	public function getCondition(
		PaymentSystemBrand $paymentSystemBrand,
		Mita $mita
	) {
		$dataSet = $this->getDataSet($paymentSystemBrand, $mita);
		return $dataSet[self::CONDITION];
	}

	/**
	 * @param PaymentSystemBrand $paymentSystemBrand
	 * @param Mita $mita
	 * @return boolean
	 */
	public function needAdditionalData(
		PaymentSystemBrand $paymentSystemBrand,
		Mita $mita
	) {
		$dataSet = $this->getDataSet($paymentSystemBrand, $mita);
		return $dataSet[self::NEED_ADDITIONAL_DATA];
	}

	/**
	 * @param PaymentSystemBrand $paymentSystemBrand
	 * @param Mita $mita
	 * @return array
	 */
	private function getDataSet(
		PaymentSystemBrand $paymentSystemBrand,
		Mita $mita
	) {
		$matchTable = $this->getMatchTable();
		if (!isset($matchTable[(string)$paymentSystemBrand]
			[(string)$mita]
		)) {
			throw new Error("Wrong parameter combination");
		}
		$dataSet = $matchTable[(string)$paymentSystemBrand]
			[(string)$mita];
		return $dataSet;
	}

	/**
	 * @return array
	 */
	private function getMatchTable() {
		return [
			PaymentSystemBrand::VISA => [
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
			PaymentSystemBrand::MASTERCARD => [
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
			PaymentSystemBrand::MIR => [
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