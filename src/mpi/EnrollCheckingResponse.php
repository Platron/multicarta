<?php

namespace Platron\multicarta\mpi;

use Platron\multicarta\ThreeDSEnrollment;

class EnrollCheckingResponse extends Response {

	/**
	 * @return bool
	 */
	public function isValid() {
		if (!parent::isValid()) {
			return false;
		}
		if ($this->getVersion()) {
			return ($this->getVersion() == $this->getValidVersion());
		}
		return true;
	}

	/**
	 * @return bool
	 */
	public function isSuccess() {
		return (!$this->hasError() && parent::isSuccess());
	}

	/**
	 * @return bool
	 */
	public function isEnrolled() {
		return ($this->getEnrolled() == ThreeDSEnrollment::Y);
	}

	/**
	 * @return ThreeDSEnrollment
	 */
	public function getEnrolled() {
		if ($this->isSuccess()) {
			return new ThreeDSEnrollment((string)$this->response
				->Response
				->VERes
				->ThreeDSecure
				->Message
				->VERes
				->CH
				->enrolled);
		}
	}

	/**
	 * @return string
	 */
	public function getAcctID() {
		if ($this->isEnrolled()) {
			return (string)$this->response
				->Response
				->VERes
				->ThreeDSecure
				->Message
				->VERes
				->CH
				->acctID;
		}
	}

	/**
	 * @return string
	 */
	public function getUrl() {
		if ($this->isEnrolled()) {
			return (string)$this->response
				->Response
				->VERes
				->ThreeDSecure
				->Message
				->VERes
				->url;
		}
	}

	/**
	 * @return string
	 */
	public function getVersion() {
		if ($this->hasError()) {
			return (string)$this->response
				->Response
				->VERes
				->ThreeDSecure
				->Message
				->Error
				->version;
		} else if ($this->isSuccess()) {
			return (string)$this->response
				->Response
				->VERes
				->ThreeDSecure
				->Message
				->VERes
				->version;
		}
	}

	/**
	 * @return string
	 */
	public function getErrorCode() {
		if ($this->hasError()) {
			return (string)$this->response
				->Response
				->VERes
				->ThreeDSecure
				->Message
				->Error
				->errorCode;
		}
	}

	/**
	 * @return string
	 */
	public function getErrorMessage() {
		if ($this->hasError()) {
			return (string)$this->response
				->Response
				->VERes
				->ThreeDSecure
				->Message
				->Error
				->errorMessage;
		}
	}

	/**
	 * @return string
	 */
	public function getErrorDetail() {
		if ($this->hasError()) {
			return (string)$this->response
				->Response
				->VERes
				->ThreeDSecure
				->Message
				->Error
				->errorDetail;
		}
	}

	/**
	 * @return boolean
	 */
	public function hasError() {
		return isset($this->response
			->Response
			->VERes
			->ThreeDSecure
			->Message
			->Error
		);
	}

	/**
	 * @return string
	 */
	protected function getValidVersion() {
		return '1.0.2';
	}

	/**
	 * @return string
	 */
	protected function getValidOperation() {
		return 'Check3DSEnrolled';
	}
}