<?php

namespace Platron\multicarta;

class PaymentMpiData {

	/**
	 * @var PaymentSystemBrand $paymentSystemBrand
	 */
	private $paymentSystemBrand;

	/**
	 * @var EnrollmentResult $enrollmentResult
	 */
	private $enrollmentResult;

	/**
	 * @var ThreeDSecureResult $threeDSecureResult
	 */
	private $threeDSecureResult;

	/**
	 * @var string $cavv
	 */
	private $cavv;

	/**
	 * @var string $xid
	 */
	private $xid;

	/**
	 * @var string $eci
	 */
	private $eci;

	/**
	 * @param PaymentSystemBrand $paymentSystemBrand
	 */
	public function setPaymentSystemBrand(PaymentSystemBrand $paymentSystemBrand) {
		$this->paymentSystemBrand = $paymentSystemBrand;
	}

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
	 * @param string $cavv
	 */
	public function setCavv(string $cavv) {
		$this->cavv = $cavv;
	}

	/**
	 * @param string $xid
	 */
	public function setXid(string $xid) {
		$this->xid = $xid;
	}

	/**
	 * @param string $eci
	 */
	public function setEci(string $eci) {
		$this->eci = $eci;
	}

	/**
	 * @return PaymentSystemBrand
	 */
	public function getPaymentSystemBrand() {
		return $this->paymentSystemBrand;
	}

	/**
	 * @return EnrollmentResult
	 */
	public function getEnrollmentResult() {
		return $this->enrollmentResult;
	}

	/**
	 * @return ThreeDSecureResult
	 */
	public function getThreeDSecureResult() {
		return $this->threeDSecureResult;
	}

	/**
	 * @return string
	 */
	public function getCavv() {
		return $this->cavv;
	}

	/**
	 * @return string
	 */
	public function getXid() {
		return $this->xid;
	}

	/**
	 * @return string
	 */
	public function getEci() {
		return $this->eci;
	}
}