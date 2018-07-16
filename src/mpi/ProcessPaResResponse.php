<?php

namespace Platron\multicarta\mpi;

use Platron\multicarta\BankCardBrand;
use Platron\multicarta\ThreeDSVerificaion;

class ProcessPaResResponse extends Response {

	/**
	 * @return string
	 */
	public function getOrderID() {
		if ($this->isSuccess()) {
			return (string)$this->response
				->Response
				->XMLOut
				->Message
				->OrderID;
		}
	}

	/**
	 * @return BankCardBrand
	 */
	public function getBrand() {
		if ($this->isSuccess()) {
			return new BankCardBrand((string)$this->response
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
	 * @return ThreeDSVerificaion
	 */
	public function getThreeDSVerificaion() {
		if ($this->isSuccess()) {
			return new ThreeDSVerificaion((string)$this->response
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
	public function getCAVV() {
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