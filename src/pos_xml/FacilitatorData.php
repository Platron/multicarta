<?php

namespace Platron\multicarta\pos_xml;

class FacilitatorData {

	/**
	 * @var string $pfsname
	 */
	private $pfsname;

	/**
	 * @var string $smid
	 */
	private $smid;

	/**
	 * @var int $smmcc
	 */
	private $smmcc;

	/**
	 * @var string $smaddress
	 */
	private $smaddress;

	/**
	 * @var string $smcountry
	 */
	private $smcountry;

	/**
	 * @var string $smcity
	 */
	private $smcity;

	/**
	 * @var string $smpostcode
	 */
	private $smpostcode;

	/**
	 * @param string $pfsname
	 * @param string $smid
	 * @param int $smmcc
	 * @param string $smaddress
	 * @param string $smcountry
	 * @param string $smcity
	 * @param string $smpostcode
	 */
	public function __construct(
		string $pfsname,
		string $smid,
		int $smmcc,
		string $smaddress,
		string $smcountry,
		string $smcity,
		string $smpostcode
	) {
		$this->setPfsname($pfsname);
		$this->setSmid($smid);
		$this->setSmmcc($smmcc);
		$this->setSmaddress($smaddress);
		$this->setSmcountry($smcountry);
		$this->setSmcity($smcity);
		$this->setSmpostcode($smpostcode);
	}

	/**
	 * @return string
	 */
	public function getPfsname() {
		return $this->pfsname;
	}

	/**
	 * @return string
	 */
	public function getSmid() {
		return $this->smid;
	}

	/**
	 * @return int
	 */
	public function getSmmcc() {
		return $this->smmcc;
	}

	/**
	 * @return string
	 */
	public function getSmaddress() {
		return $this->smaddress;
	}

	/**
	 * @return string
	 */
	public function getSmcountry() {
		return $this->smcountry;
	}

	/**
	 * @return string
	 */
	public function getSmcity() {
		return $this->smcity;
	}

	/**
	 * @return string
	 */
	public function getSmpostcode() {
		return $this->smpostcode;
	}

	/**
	 * @param string $pfsname
	 */
	protected function setPfsname(string $pfsname) {
		if (strlen($pfsname) > 18) {
			throw new Error("Excess of maximum length (18 characters) in pfsname");
		}
		$this->pfsname = $pfsname;
	}

	/**
	 * @param string $smid
	 */
	protected function setSmid(string $smid) {
		if (strlen($smid) > 15) {
			throw new Error("Excess of maximum length (15 characters) in smid");
		}
		$this->smid = $smid;
	}

	/**
	 * @param int $smmcc
	 */
	protected function setSmmcc(int $smmcc) {
		if (strlen($smmcc) != 4) {
			throw new Error("Excess of maximum length (4 digits) in smmcc");
		}
		$this->smmcc = $smmcc;
	}

	/**
	 * @param string $smaddress
	 */
	protected function setSmaddress(string $smaddress) {
		if (strlen($smaddress) > 48) {
			throw new Error("Excess of maximum length (48 characters) in smaddress");
		}
		$this->smaddress = $smaddress;
	}

	/**
	 * @param string $smcountry
	 */
	protected function setSmcountry(string $smcountry) {
		if (strlen($smcountry) != 3) {
			throw new Error("Excess of maximum length (3 characters) in smcountry");
		}
		$this->smcountry = $smcountry;
	}

	/**
	 * @param string $smcity
	 */
	protected function setSmcity(string $smcity) {
		if (strlen($smcity) > 13) {
			throw new Error("Excess of maximum length (13 characters) in smcity");
		}
		$this->smcity = $smcity;
	}

	/**
	 * @param string $smpostcode
	 */
	protected function setSmpostcode(string $smpostcode) {
		if (strlen($smpostcode) > 10) {
			throw new Error("Excess of maximum length (10 characters) in smpostcode");
		}
		$this->smpostcode = $smpostcode;
	}
}