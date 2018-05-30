<?php

namespace Platron\multicarta\pos_xml;

use Platron\multicarta\Error;

class ReversalRequestBuilder extends TerminalRequestBuilder {

	/**
	 * @param string $terminalId
	 */
	public function __construct(
		string $terminalId,
		int $trXId,
		string $session
	) {
		parent::__construct($terminalId);
		$this->setTrXId($trXId);
		$this->setSession($session);
	}

	/**
	 * @param int $id
	 */
	protected function setTrXId(int $trXId) {
		if (strlen($trXId) > 12) {
			throw new Error("Excess of maximum length (12 digits) in TrXId");
		}
		$this->request['ID'] = (string)$trXId;
	}

	/**
	 * @param string $session
	 */
	protected function setSession(string $session) {
		if (strlen($session) != 40) {
			throw new Error("Invalid length (40 characters) in session");
		}
		$this->request['SESSION'] = (string)$session;
	}

	/**
	 * @return string
	 */
	protected function getCommand() {
		return 'PAYMENTREVERSAL';
	}
}
