<?php

namespace Platron\multicarta\pos_xml;

class AdditionalRecurringData {

	/**
	 * @var Mita $mita
	 */
	private $mita;

	/**
	 * @var string $etid
	 */
	private $etid;

	/**
	 * @var string $origrrn
	 */
	private $origrrn;

	/**
	 * @param Mita $mita
	 * @param string $etid
	 * @param string $origrrn
	 */
	public function __construct(
		Mita $mita,
		string $etid,
		string $origrrn
	) {
		$this->setMita($mita);
		$this->setEtid($etid);
		$this->setOrigrrn($origrrn);
	}

	/**
	 * @return Mita
	 */
	public function getMita() {
		return $this->mita;
	}

	/**
	 * @return string
	 */
	public function getEtid() {
		return $this->etid;
	}

	/**
	 * @return string
	 */
	public function getOrigrrn() {
		return $this->origrrn;
	}

	/**
	 * @param Mita $mita
	 */
	protected function setMita(Mita $mita) {
		$this->mita = $mita;
	}

	/**
	 * @param string $etid
	 */
	protected function setEtid(string $etid) {
		if (strlen($etid) > 20) {
			throw new Error("Excess of maximum length (20 characters) in etid");
		}
		$this->etid = $etid;
	}

	/**
	 * @param string $origrrn
	 */
	protected function setOrigrrn(string $origrrn) {
		if (strlen($origrrn) > 12) {
			throw new Error("Excess of maximum length (12 characters) in origrrn");
		}
		$this->origrrn = $origrrn;
	}
}