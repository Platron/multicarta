<?php

namespace Platron\multicarta;

class MpiHelper {

	const ECI = 0;
	const NEED_TDS_DATA = 1;
	const CONDITION = 2;

	/**
	 * @param BankCardBrand $bankCardBrand
	 * @param MpiData $mpiData
	 * @return string
	 */
	public function getCondition(
		BankCardBrand $bankCardBrand,
		MpiData $mpiData
	) {
		$dataSet = $this->getDataSet(
			$bankCardBrand,
			$mpiData
		);
		return $dataSet[self::CONDITION];
	}

	/**
	 * @param BankCardBrand $bankCardBrand
	 * @param MpiData $mpiData
	 * @return boolean
	 */
	public function needTdsData(
		BankCardBrand $bankCardBrand,
		MpiData $mpiData
	) {
		$dataSet = $this->getDataSet(
			$bankCardBrand,
			$mpiData
		);
		return $dataSet[self::NEED_TDS_DATA];
	}

	/**
	 * @param BankCardBrand $bankCardBrand
	 * @param MpiData $mpiData
	 * @return array
	 */
	private function getDataSet(
		BankCardBrand $bankCardBrand,
		MpiData $mpiData
	) {
		$threeDSEnrollment = $mpiData->getThreeDSEnrollment();
		$threeDSVerificaion = $mpiData->getThreeDSVerificaion();
		$matchTable = $this->getMatchTable();
		if (!isset($matchTable[(string)$threeDSEnrollment]
			[(string)$threeDSVerificaion]
			[(string)$bankCardBrand]
		)) {
			throw new Error("Wrong parameter combination");
		}
		$dataSet = $matchTable[(string)$threeDSEnrollment]
			[(string)$threeDSVerificaion]
			[(string)$bankCardBrand];
		return $dataSet;
	}

	/**
	 * @return array
	 */
	private function getMatchTable() {
		return [
			'' => [
				'' => [
					BankCardBrand::VISA => [
						self::ECI => '7',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
					BankCardBrand::MASTERCARD => [
						self::ECI => '0',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
					BankCardBrand::MIR => [
						self::ECI => '3',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
				],
			],
			ThreeDSEnrollment::U => [
				'' => [
					BankCardBrand::VISA => [
						self::ECI => '6',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '2',
					],
					BankCardBrand::MASTERCARD => [
						self::ECI => '0',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
					BankCardBrand::MIR => [
						self::ECI => '3',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
				]
			],
			ThreeDSEnrollment::N => [
				'' => [
					BankCardBrand::VISA => [
						self::ECI => '6',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '2',
					],
					BankCardBrand::MASTERCARD => [
						self::ECI => '0',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
					BankCardBrand::MIR => [
						self::ECI => '3',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
				]
			],
			ThreeDSEnrollment::Y => [
				ThreeDSVerificaion::Y => [
					BankCardBrand::VISA => [
						self::ECI => '5',
						self::NEED_TDS_DATA => true,
						self::CONDITION => '5',
					],
					BankCardBrand::MASTERCARD => [
						self::ECI => '2',
						self::NEED_TDS_DATA => true,
						self::CONDITION => '5',
					],
					BankCardBrand::MIR => [
						self::ECI => '2',
						self::NEED_TDS_DATA => true,
						self::CONDITION => '5',
					],
				],
				ThreeDSVerificaion::A => [
					BankCardBrand::VISA => [
						self::ECI => '6',
						self::NEED_TDS_DATA => true,
						self::CONDITION => '2',
					],
					BankCardBrand::MASTERCARD => [
						self::ECI => '1',
						self::NEED_TDS_DATA => true,
						self::CONDITION => '2',
					],
					BankCardBrand::MIR => [
						self::ECI => '1',
						self::NEED_TDS_DATA => true,
						self::CONDITION => '2',
					],
				],
				ThreeDSVerificaion::U => [
					BankCardBrand::VISA => [
						self::ECI => '6',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '2',
					],
					BankCardBrand::MASTERCARD => [
						self::ECI => '0',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
					BankCardBrand::MIR => [
						self::ECI => '3',
						self::NEED_TDS_DATA => false,
						self::CONDITION => '4',
					],
				]
			]
		];
	}
}