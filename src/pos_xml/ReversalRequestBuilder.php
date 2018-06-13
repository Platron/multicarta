<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\Error;

class ReversalRequestBuilder extends TerminalRequestBuilder {

	/**
	 * @param string $termid
	 * @param string $id
	 * @param string $session
	 */
	public function __construct(
		string $termid,
		string $id,
		string $session
	) {
		parent::__construct($termid);
		$this->setId($id);
		$this->setSession($session);
	}

	/**
	 * @param string $id
	 */
	protected function setId(string $id) {
		if (!preg_match('/^\d{0,12}$/', $id)) {
			throw new Error(
				"Id does not match the format
				(number with maximum length of 12 digits)"
			);
		}
		$this->request['ID'] = $id;
	}

	/**
	 * @param string $session
	 */
	protected function setSession(string $session) {
		if (strlen($session) != 40) {
			throw new Error("Invalid length (40 characters) in session");
		}
		$this->request['SESSION'] = $session;
	}

	/**
	 * @return string
	 */
	protected function getCommand() {
		return 'PAYMENTREVERSAL';
	}
}
