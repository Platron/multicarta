<?php

namespace Platron\multicarta\mpi;

use Platron\multicarta\EnrollmentResult;

class EnrollCheckingResponseParser extends ResponseParser {

	/**
	 * @return bool
	 */
	public function isValid() {
		if (!parent::isValid()) {
			return false;
		}

		return ($this->getVersion() == $this->getValidVersion());
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
		return ($this->getEnrollmentResult() == EnrollmentResult::Y);
	}

	/**
	 * @return EnrollmentResult
	 */
	public function getEnrollmentResult() {
		if ($this->isSuccess()) {
			return new EnrollmentResult((string)$this->xmlData
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
	public function getAcctId() {
		if ($this->isEnrolled()) {
			return (string)$this->xmlData
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
			return (string)$this->xmlData
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
			return (string)$this->xmlData
				->Response
				->VERes
				->ThreeDSecure
				->Message
				->Error
				->version;
		} else {
			return (string)$this->xmlData
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
			return (string)$this->xmlData
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
			return (string)$this->xmlData
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
			return (string)$this->xmlData
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
		return isset($this->xmlData
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