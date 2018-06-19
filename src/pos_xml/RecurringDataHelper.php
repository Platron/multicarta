<?php

namespace Platron\multicarta\pos_xml;

class RecurringDataHelper {

	const CONDITION = 0;
	const NEED_RECURRING_DATA = 1;

	/**
	 * @var PaymentSystemBrand $paymentSystemBrand
	 */
	private $paymentSystemBrand;

	/**
	 * @var Mita $mita
	 */
	private $mita;

	/**
	 * @param PaymentSystemBrand $paymentSystemBrand
	 * @param Mita $mita
	 */
	public function __construct(
		PaymentSystemBrand $paymentSystemBrand,
		Mita $mita
	) {
		$this->setPaymentSystemBrand($paymentSystemBrand);
		$this->setMita($mita);
	}

	/**
	 * @return string
	 */
	public function getCondition() {
		$dataSet = $this->getDataSet();
		return $dataSet[self::CONDITION];
	}

	/**
	 * @return boolean
	 */
	public function needRecurringData() {
		$dataSet = $this->getDataSet();
		return $dataSet[self::NEED_RECURRING_DATA];
	}

	/**
	 * @param PaymentSystemBrand $paymentSystemBrand
	 */
	protected function setPaymentSystemBrand(PaymentSystemBrand $paymentSystemBrand) {
		$this->paymentSystemBrand = $paymentSystemBrand;
	}

	/**
	 * @param Mita $mita
	 */
	protected function setMita(Mita $mita) {
		$this->mita = $mita;
	}

	/**
	 * @return boolean
	 */
	private function getDataSet() {
		$matchTable = $this->getMatchTable();
		if (!isset($matchTable[(string)$this->paymentSystemBrand]
			[(string)$this->mita]
		)) {
			throw new Error("Wrong parameter combination");
		}
		$dataSet = $matchTable[(string)$this->paymentSystemBrand]
			[(string)$this->mita];
		return $dataSet;
	}

	/**
	 * @return boolean
	 */
	private function getMatchTable() {
		return [
			PaymentSystemBrand::VISA => [
				Mita::START_RECURRING => [
					self::CONDITION => '5',
					self::NEED_RECURRING_DATA => true
				],
				Mita::INITIATION_BY_MERCHANT => [
					self::CONDITION => '1',
					self::NEED_RECURRING_DATA => true
				],
				Mita::INITIATION_BY_CARDHOLDER => [
					self::CONDITION => '1',
					self::NEED_RECURRING_DATA => true
				]
			],
			PaymentSystemBrand::MASTERCARD => [
				Mita::START_RECURRING => [
					self::CONDITION => '5',
					self::NEED_RECURRING_DATA => false
				],
				Mita::INITIATION_BY_MERCHANT => [
					self::CONDITION => '6',
					self::NEED_RECURRING_DATA => false
				],
				Mita::INITIATION_BY_CARDHOLDER => [
					self::CONDITION => '6',
					self::NEED_RECURRING_DATA => false
				]
			],
			PaymentSystemBrand::MIR => [
				Mita::START_RECURRING => [
					self::CONDITION => '5',
					self::NEED_RECURRING_DATA => true
				],
				Mita::INITIATION_BY_MERCHANT => [
					self::CONDITION => '6',
					self::NEED_RECURRING_DATA => true
				],
				Mita::INITIATION_BY_CARDHOLDER => [
					self::CONDITION => '1',
					self::NEED_RECURRING_DATA => true
				]
			]
		];
	}
}