<?php

namespace Platron\multicarta;

class ThreeDSData {

	/**
	 * @var string $cavv
	 */
	private $cavv;

	/**
	 * @var string $xid
	 */
	private $xid;

	/**
	 * @var string $eci
	 */
	private $eci;

	/**
	 * @param string $cavv
	 * @param string $xid
	 * @param string $eci
	 */
	public function __construct(
		string $cavv,
		string $xid,
		string $eci
	) {
		$this->setCavv($cavv);
		$this->setXid($xid);
		$this->setEci($eci);
	}

	/**
	 * @param string $cavv
	 */
	protected function setCavv(string $cavv) {
		$this->cavv = $cavv;
	}

	/**
	 * @param string $xid
	 */
	protected function setXid(string $xid) {
		$this->xid = $xid;
	}

	/**
	 * @param string $eci
	 */
	protected function setEci(string $eci) {
		$this->eci = $eci;
	}

	/**
	 * @return string
	 */
	public function getCavv() {
		return $this->cavv;
	}

	/**
	 * @return string
	 */
	public function getXid() {
		return $this->xid;
	}

	/**
	 * @return string
	 */
	public function getEci() {
		return $this->eci;
	}
}