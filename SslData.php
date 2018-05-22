<?php

namespace classes\ps\multicarta\sdk;

class SslData {

	/**
	 * @param string $certificatePath
	 */
	private $certificatePath;

	/**
	 * @param string $privateKeyPath
	 */
	private $privateKeyPath;

	/**
	 * @param string $certificatePath
	 * @param string $privateKeyPath
	 */
	public function __construct(
		string $certificatePath,
		string $privateKeyPath
	) {
		$this->certificatePath = $certificatePath;
		$this->privateKeyPath = $privateKeyPath;
	}

	/**
	 * @return string
	 */
	public function getCertificatePath() {
		return $this->certificatePath;
	}

	/**
	 * @return string
	 */
	public function getPrivateKeyPath() {
		return $this->privateKeyPath;
	}
}