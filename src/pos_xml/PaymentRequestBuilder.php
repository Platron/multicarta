<?php

namespace Platron\multicarta\pos_xml;

class PaymentRequestBuilder extends AuthRequestBuilder {

	/**
	 * @return string
	 */
	protected function getCommand() {
		return 'PAYMENT';
	}
}
