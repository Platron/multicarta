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
	 * @var PaymentSystem $paymentSystem
	 */
	private $paymentSystem;

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
	 * @param PaymentSystem $paymentSystem
	 */
	public function setPaymentSystem(PaymentSystem $paymentSystem) {
		$this->paymentSystem = $paymentSystem;
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
		if (!isset($matchTable[$this->enrollmentResult->getValue()]
			[$this->threeDSecureResult->getValue()]
			[$this->paymentSystem->getValue()]
		)) {
			throw new Error("Wrong parameter combination");
		}
		$dataSet = $matchTable[$this->enrollmentResult->getValue()]
			[$this->threeDSecureResult->getValue()]
			[$this->paymentSystem->getValue()];
		return $dataSet;
	}

	/**
	 * @return boolean
	 */
	private function getMatchTable() {
		return [
			'' => [
				'' => [
					PaymentSystem::VISA => [
						'7',
						false,
						'4',
					],
					PaymentSystem::MASTERCARD => [
						'0',
						false,
						'4',
					],
					PaymentSystem::MIR => [
						'3',
						false,
						'4',
					],
				],
			],
			EnrollmentResult::U => [
				'' => [
					PaymentSystem::VISA => [
						'6',
						false,
						'2',
					],
					PaymentSystem::MASTERCARD => [
						'0',
						false,
						'4',
					],
					PaymentSystem::MIR => [
						'3',
						false,
						'4',
					],
				]
			],
			EnrollmentResult::N => [
				'' => [
					PaymentSystem::VISA => [
						'6',
						false,
						'2',
					],
					PaymentSystem::MASTERCARD => [
						'0',
						false,
						'4',
					],
					PaymentSystem::MIR => [
						'3',
						false,
						'4',
					],
				]
			],
			EnrollmentResult::Y => [
				ThreeDSecureResult::Y => [
					PaymentSystem::VISA => [
						'5',
						true,
						'5',
					],
					PaymentSystem::MASTERCARD => [
						'2',
						true,
						'5',
					],
					PaymentSystem::MIR => [
						'2',
						true,
						'5',
					],
				],
				ThreeDSecureResult::A => [
					PaymentSystem::VISA => [
						'6',
						true,
						'2',
					],
					PaymentSystem::MASTERCARD => [
						'1',
						true,
						'2',
					],
					PaymentSystem::MIR => [
						'1',
						true,
						'2',
					],
				],
				ThreeDSecureResult::U => [
					PaymentSystem::VISA => [
						'6',
						false,
						'2',
					],
					PaymentSystem::MASTERCARD => [
						'0',
						false,
						'4',
					],
					PaymentSystem::MIR => [
						'3',
						false,
						'4',
					],
				]
			]
		];
	}
}