<?php

namespace Platron\multicarta;

class DataHelper {

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
		return ($eci == $dataSet[0]);
	}

	/**
	 * @return boolean
	 */
	public function needTdsData() {
		$dataSet = $this->getDataSet();
		return $dataSet[1];
	}

	/**
	 * @return string
	 */
	public function getCondition() {
		$dataSet = $this->getDataSet();
		return $dataSet[2];
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
						'7',
						false,
						'4',
					],
					PaymentSystemBrand::MASTERCARD => [
						'0',
						false,
						'4',
					],
					PaymentSystemBrand::MIR => [
						'3',
						false,
						'4',
					],
				],
			],
			EnrollmentResult::U => [
				'' => [
					PaymentSystemBrand::VISA => [
						'6',
						false,
						'2',
					],
					PaymentSystemBrand::MASTERCARD => [
						'0',
						false,
						'4',
					],
					PaymentSystemBrand::MIR => [
						'3',
						false,
						'4',
					],
				]
			],
			EnrollmentResult::N => [
				'' => [
					PaymentSystemBrand::VISA => [
						'6',
						false,
						'2',
					],
					PaymentSystemBrand::MASTERCARD => [
						'0',
						false,
						'4',
					],
					PaymentSystemBrand::MIR => [
						'3',
						false,
						'4',
					],
				]
			],
			EnrollmentResult::Y => [
				ThreeDSecureResult::Y => [
					PaymentSystemBrand::VISA => [
						'5',
						true,
						'5',
					],
					PaymentSystemBrand::MASTERCARD => [
						'2',
						true,
						'5',
					],
					PaymentSystemBrand::MIR => [
						'2',
						true,
						'5',
					],
				],
				ThreeDSecureResult::A => [
					PaymentSystemBrand::VISA => [
						'6',
						true,
						'2',
					],
					PaymentSystemBrand::MASTERCARD => [
						'1',
						true,
						'2',
					],
					PaymentSystemBrand::MIR => [
						'1',
						true,
						'2',
					],
				],
				ThreeDSecureResult::U => [
					PaymentSystemBrand::VISA => [
						'6',
						false,
						'2',
					],
					PaymentSystemBrand::MASTERCARD => [
						'0',
						false,
						'4',
					],
					PaymentSystemBrand::MIR => [
						'3',
						false,
						'4',
					],
				]
			]
		];
	}
}