<?php

namespace Platron\multicarta;

class MpiDataHelper {

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
	 * @param MpiData $mpiData
	 * @return string
	 */
	public function getCondition(MpiData $mpiData) {
		$dataSet = $this->getDataSet($mpiData);
		return $dataSet[self::CONDITION];
	}

	/**
	 * @param MpiData $mpiData
	 * @return boolean
	 */
	public function needTdsData(MpiData $mpiData) {
		$dataSet = $this->getDataSet($mpiData);
		return $dataSet[self::NEED_TDS_DATA];
	}

	/**
	 * @param MpiData $mpiData
	 * @return string
	 */
	public function getTdsData(MpiData $mpiData) {
		$tdsDataGenerator = $this->getTdsDataGenerator();
		$tdsData = $tdsDataGenerator->generate(
			$mpiData->getPaymentSystemBrand(),
			$mpiData->getCavv(),
			$mpiData->getXid()
		);
		return $tdsData;
	}

	/**
	 * @param MpiData $mpiData
	 * @return boolean
	 */
	public function checkEci(MpiData $mpiData) {
		$eci = $mpiData->getEci();
		$dataSet = $this->getDataSet($mpiData);
		return ($eci == $dataSet[self::ECI]);
	}

	/**
	 * @return TdsDataGenerator
	 */
	protected function getTdsDataGenerator() {
		return $this->tdsDataGenerator;
	}

	/**
	 * @param MpiData $mpiData
	 * @return array
	 */
	private function getDataSet(MpiData $mpiData) {
		$enrollmentResult = $mpiData->getEnrollmentResult();
		$threeDSecureResult = $mpiData->getThreeDSecureResult();
		$paymentSystemBrand = $mpiData->getPaymentSystemBrand();
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