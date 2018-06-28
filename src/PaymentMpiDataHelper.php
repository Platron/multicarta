<?php

namespace Platron\multicarta;

class PaymentMpiDataHelper {

	const ECI = 0;
	const NEED_TDS_DATA = 1;
	const CONDITION = 2;

	/**
	 * @var TdsDataGenerator $tdsDataGenerator
	 */
	private $tdsDataGenerator;

	/**
	 * @param TdsDataGenerator $tdsDataGenerator
	 */
	public function __construct(TdsDataGenerator $tdsDataGenerator) {
		$this->tdsDataGenerator = $tdsDataGenerator;
	}

	/**
	 * @param PaymentMpiData $paymentMpiData
	 * @return string
	 */
	public function getCondition(PaymentMpiData $paymentMpiData) {
		$dataSet = $this->getDataSet($paymentMpiData);
		return $dataSet[self::CONDITION];
	}

	/**
	 * @param PaymentMpiData $paymentMpiData
	 * @return boolean
	 */
	public function needTdsData(PaymentMpiData $paymentMpiData) {
		$dataSet = $this->getDataSet($paymentMpiData);
		return $dataSet[self::NEED_TDS_DATA];
	}

	/**
	 * @param PaymentMpiData $paymentMpiData
	 * @return string
	 */
	public function getTdsData(PaymentMpiData $paymentMpiData) {
		$tdsDataGenerator = $this->getTdsDataGenerator();
		$tdsData = $tdsDataGenerator->generate(
			$paymentMpiData->getPaymentSystemBrand(),
			$paymentMpiData->getCavv(),
			$paymentMpiData->getXid()
		);
		return $tdsData;
	}

	/**
	 * @param PaymentMpiData $paymentMpiData
	 * @return boolean
	 */
	public function checkEci(PaymentMpiData $paymentMpiData) {
		$eci = $paymentMpiData->getEci();
		$dataSet = $this->getDataSet($paymentMpiData);
		return ($eci == $dataSet[self::ECI]);
	}

	/**
	 * @return TdsDataGenerator
	 */
	protected function getTdsDataGenerator() {
		return $this->tdsDataGenerator;
	}

	/**
	 * @param PaymentMpiData $paymentMpiData
	 * @return array
	 */
	private function getDataSet(PaymentMpiData $paymentMpiData) {
		$enrollmentResult = $paymentMpiData->getEnrollmentResult();
		$threeDSecureResult = $paymentMpiData->getThreeDSecureResult();
		$paymentSystemBrand = $paymentMpiData->getPaymentSystemBrand();
		$matchTable = $this->getMatchTable();
		if (!isset($matchTable[(string)$enrollmentResult]
			[(string)$threeDSecureResult]
			[(string)$paymentSystemBrand]
		)) {
			throw new Error("Wrong parameter combination");
		}
		$dataSet = $matchTable[(string)$enrollmentResult]
			[(string)$threeDSecureResult]
			[(string)$paymentSystemBrand];
		return $dataSet;
	}

	/**
	 * @return array
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