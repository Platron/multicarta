<?php

namespace Platron\multicarta\pos_xml;

class PreAuthRequestBuilder extends AuthRequestBuilder {

	/**
	 * @return string
	 */
	protected function getCommand() {
		return 'PREAUTH';
	}
}
