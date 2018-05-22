<?php

namespace classes\ps\multicarta\sdk;

use SimpleXMLElement;

class ProcessPaResResponseParser extends ResponseParser {

	/**
	 * @return string
	 */
	public function getOrderId() {
		if ($this->isSuccess()) {
			return (string)$this->xmlData
				->Response
				->XMLOut
				->Message
				->OrderID;
		}
	}

	/**
	 * @return string
	 */
	public function getBrand() {
		if ($this->isSuccess()) {
			return (string)$this->xmlData
				->Response
				->XMLOut
				->Message
				->Brand;
		}
	}

	/**
	 * @return string
	 */
	public function getOrderStatus() {
		if ($this->isSuccess()) {
			return (string)$this->xmlData
				->Response
				->XMLOut
				->Message
				->OrderStatus;
		}
	}

	/**
	 * @return string
	 */
	public function getEci() {
		if ($this->isSuccess()) {
			return (string)$this->xmlData
				->Response
				->XMLOut
				->Message
				->ThreeDSVars
				->AnswerVars
				->eci;
		}
	}

	/**
	 * @return string
	 */
	public function getThreeDSecureVerificaion() {
		if ($this->isSuccess()) {
			return (string)$this->xmlData
				->Response
				->XMLOut
				->Message
				->ThreeDSVars
				->AnswerVars
				->ThreeDSVerificaion;
		}
	}

	/**
	 * @return string
	 */
	public function getCavv() {
		if ($this->isSuccess()) {
			return (string)$this->xmlData
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
			return (string)$this->xmlData
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