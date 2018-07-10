<?php

namespace Platron\multicarta\pos_xml;

class ClientParameters {

	/**
	 * @var string $urlWithHttpGetQuery
	 */
	private $urlWithHttpGetQuery;

	/**
	 * @var string $certificatePath
	 */
	private $certificatePath;

	/**
	 * @var string $privateKeyPath
	 */
	private $privateKeyPath;

	/**
	 * @param string $urlWithHttpGetQuery
	 * @param string $certificatePath
	 * @param string $privateKeyPath
	 */
	public function __construct(
		string $urlWithHttpGetQuery,
		string $certificatePath,
		string $privateKeyPath
	) {
		$this->urlWithHttpGetQuery = $urlWithHttpGetQuery;
		$this->certificatePath = $certificatePath;
		$this->privateKeyPath = $privateKeyPath;
	}

	/**
	 * @return string
	 */
	public function getUrlWithHttpGetQuery() {
		return $this->urlWithHttpGetQuery;
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