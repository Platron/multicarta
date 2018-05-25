<?php

namespace Platron\multicarta\pos_xml;

class TestRequestBuilder extends RequestBuilder {

	/**
	 * @return string
	 */
	protected function getCommand() {
		return 'TEST';
	}
}
