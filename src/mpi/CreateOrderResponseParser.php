<?php

namespace Platron\multicarta\mpi;

class CreateOrderResponseParser extends ResponseParser {

	/**
	 * @return string
	 */
	public function getOrderId() {
		if ($this->isSuccess()) {
			return (string)$this->xmlData
			->Response
			->Order
			->OrderID;
		}
	}

	/**
	 * @return string
	 */
	public function getSessionId() {
		if ($this->isSuccess()) {
			return (string)$this->xmlData
				->Response
				->Order
				->SessionID;
		}
	}

	/**
	 * @return string
	 */
	protected function getValidOperation() {
		return 'CreateOrder';
	}
}