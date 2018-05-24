<?php

namespace Platron\multicarta\mpi;

use Platron\multicarta\PaymentSystemBrand;
use Platron\multicarta\ThreeDSecureResult;

class ProcessPaResResponseParser extends ResponseParser {

	/**
	 * @return string
	 */
	public function getOrderId() {
		if ($this->isSuccess()) {
			return (string)$this->response
				->Response
				->XMLOut
				->Message
				->OrderID;
		}
	}

	/**
	 * @return PaymentSystemBrand
	 */
	public function getPaymentSystemBrand() {
		if ($this->isSuccess()) {
			return new PaymentSystemBrand((string)$this->response
				->Response
				->XMLOut
				->Message
				->Brand);
		}
	}

	/**
	 * @return OrderStatus
	 */
	public function getOrderStatus() {
		if ($this->isSuccess()) {
			return new OrderStatus((string)$this->response
				->Response
				->XMLOut
				->Message
				->OrderStatus);
		}
	}

	/**
	 * @return string
	 */
	public function getEci() {
		if ($this->isSuccess()) {
			return (string)$this->response
				->Response
				->XMLOut
				->Message
				->ThreeDSVars
				->AnswerVars
				->eci;
		}
	}

	/**
	 * @return ThreeDSecureResult
	 */
	public function getThreeDSecureResult() {
		if ($this->isSuccess()) {
			return new ThreeDSecureResult((string)$this->response
				->Response
				->XMLOut
				->Message
				->ThreeDSVars
				->AnswerVars
				->ThreeDSVerificaion);
		}
	}

	/**
	 * @return string
	 */
	public function getCavv() {
		if ($this->isSuccess()) {
			return (string)$this->response
				->Response
				->XMLOut
				->Message
				->ThreeDSVars
				->AnswerVars
				->CAVV;
		}
	}

	/**
	 * @return string
	 */
	public function getXid() {
		if ($this->isSuccess()) {
			return (string)$this->response
				->Response
				->XMLOut
				->Message
				->ThreeDSVars
				->AnswerVars
				->xid;
		}
	}

	/**
	 * @return string
	 */
	protected function getValidOperation() {
		return 'ProcessPARes';
	}
}