<?php

namespace Platron\multicarta;

class MpiData {

	/**
	 * @var ThreeDSEnrollment $threeDSEnrollment
	 */
	private $threeDSEnrollment;

	/**
	 * @var ThreeDSVerificaion $threeDSVerificaion
	 */
	private $threeDSVerificaion;

	/**
	 * @var ThreeDSData $threeDSData
	 */
	private $threeDSData;

	/**
	 * @param ThreeDSEnrollment $threeDSEnrollment
	 */
	public function setThreeDSEnrollment(ThreeDSEnrollment $threeDSEnrollment) {
		$this->threeDSEnrollment = $threeDSEnrollment;
	}

	/**
	 * @param ThreeDSVerificaion $threeDSVerificaion
	 */
	public function setThreeDSVerificaion(ThreeDSVerificaion $threeDSVerificaion) {
		$this->threeDSVerificaion = $threeDSVerificaion;
	}

	/**
	 * @param ThreeDSData $threeDSData
	 */
	public function setThreeDSData(ThreeDSData $threeDSData) {
		$this->threeDSData = $threeDSData;
	}

	/**
	 * @return ThreeDSEnrollment
	 */
	public function getThreeDSEnrollment() {
		return $this->threeDSEnrollment;
	}

	/**
	 * @return ThreeDSVerificaion
	 */
	public function getThreeDSVerificaion() {
		return $this->threeDSVerificaion;
	}

	/**
	 * @return ThreeDSData
	 */
	public function getThreeDSData() {
		return $this->threeDSData;
	}
}