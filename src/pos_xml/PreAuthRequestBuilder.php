<?php

namespace Platron\multicarta\pos_xml;

class PreauthRequestBuilder extends AuthRequestBuilder {

	/**
	 * @return string
	 */
	protected function getCommand() {
		return 'PREAUTH';
	}
}
