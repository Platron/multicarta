<?php

namespace Platron\multicarta;

class ThreeDSecureDataHelper {

	const ECI = 0;
	const NEED_TDS_DATA = 1;
	const CONDITION = 2;

	/**
	 * @var EnrollmentResult $enrollmentResult
	 */
	private $enrollmentResult;

	/**
	 * @var ThreeDSecureResult $threeDSecureResult
	 */
	private $threeDSecureResult;

	/**
	 * @var PaymentSystemBrand $paymentSystemBrand
	 */
	private $paymentSystemBrand;

	/**
	 * @param EnrollmentResult $enrollmentResult
	 */
	public function setEnrollmentResult(EnrollmentResult $enrollmentResult) {
		$this->enrollmentResult = $enrollmentResult;
	}

	/**
	 * @param ThreeDSecureResult $threeDSecureResult
	 */
	public function setThreeDSecureResult(ThreeDSecureResult $threeDSecureResult) {
		$this->threeDSecureResult = $threeDSecureResult;
	}

	/**
	 * @param PaymentSystemBrand $paymentSystemBrand
	 */
	public function setPaymentSystemBrand(PaymentSystemBrand $paymentSystemBrand) {
		$this->paymentSystemBrand = $paymentSystemBrand;
	}

	/**
	 * @param string $eci
	 * @return boolean
	 */
	public function checkEci(string $eci) {
		$dataSet = $this->getDataSet();
		return ($eci == $dataSet[self::ECI]);
	}

	/**
	 * @return boolean
	 */
	public function needTdsData() {
		$dataSet = $this->getDataSet();
		return $dataSet[self::NEED_TDS_DATA];
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
	private function getDataSet() {
		$matchTable = $this->getMatchTable();
		if (!isset($matchTable[(string)$this->enrollmentResult]
			[(string)$this->threeDSecureResult]
			[(string)$this->paymentSystemBrand]
		)) {
			throw new Error("Wrong parameter combination");
		}
		$dataSet = $matchTable[(string)$this->enrollmentResult]
			[(string)$this->threeDSecureResult]
			[(string)$this->paymentSystemBrand];
		return $dataSet;
	}

	/**
	 * @return boolean
	 */
	private function getMatchTable() {
		return [
			'' => [
				'' => [
					PaymentSystemBrand::VISA => [
						self::ECI => '7',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
					PaymentSystemBrand::MASTERCARD => [
						self::ECI => '0',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
					PaymentSystemBrand::MIR => [
						self::ECI => '3',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
					'' => [
						self::ECI => null,
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
				],
			],
			EnrollmentResult::U => [
				'' => [
					PaymentSystemBrand::VISA => [
						self::ECI => '6',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '2',
					],
					PaymentSystemBrand::MASTERCARD => [
						self::ECI => '0',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
					PaymentSystemBrand::MIR => [
						self::ECI => '3',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
				]
			],
			EnrollmentResult::N => [
				'' => [
					PaymentSystemBrand::VISA => [
						self::ECI => '6',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '2',
					],
					PaymentSystemBrand::MASTERCARD => [
						self::ECI => '0',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
					PaymentSystemBrand::MIR => [
						self::ECI => '3',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
				]
			],
			EnrollmentResult::Y => [
				ThreeDSecureResult::Y => [
					PaymentSystemBrand::VISA => [
						self::ECI => '5',
						self::NEED_TDS_DATA => true,
						self::CONDITION => '5',
					],
					PaymentSystemBrand::MASTERCARD => [
						self::ECI => '2',
						self::NEED_TDS_DATA => true,
						self::CONDITION => '5',
					],
					PaymentSystemBrand::MIR => [
						self::ECI => '2',
						self::NEED_TDS_DATA => true,
						self::CONDITION => '5',
					],
				],
				ThreeDSecureResult::A => [
					PaymentSystemBrand::VISA => [
						self::ECI => '6',
						self::NEED_TDS_DATA => true,
						self::CONDITION => '2',
					],
					PaymentSystemBrand::MASTERCARD => [
						self::ECI => '1',
						self::NEED_TDS_DATA => true,
						self::CONDITION => '2',
					],
					PaymentSystemBrand::MIR => [
						self::ECI => '1',
						self::NEED_TDS_DATA => true,
						self::CONDITION => '2',
					],
				],
				ThreeDSecureResult::U => [
					PaymentSystemBrand::VISA => [
						self::ECI => '6',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '2',
					],
					PaymentSystemBrand::MASTERCARD => [
						self::ECI => '0',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
					PaymentSystemBrand::MIR => [
						self::ECI => '3',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
				]
			]
		];
	}
}