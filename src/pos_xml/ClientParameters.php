<?php

namespace Platron\multicarta\pos_xml;

class ClientParameters {

	/**
	 * @var string $url
	 */
	private $url;

	/**
	 * @var array $request
	 */
	private $request;

	/**
	 * @var string $certificatePath
	 */
	private $certificatePath;

	/**
	 * @var string $privateKeyPath
	 */
	private $privateKeyPath;

	/**
	 * @param string $url
	 * @param array $request
	 * @param string $certificatePath
	 * @param string $privateKeyPath
	 */
	public function __construct(
		string $url,
		array $request,
		string $certificatePath,
		string $privateKeyPath
	) {
		$this->url = $url;
		$this->request = $request;
		$this->certificatePath = $certificatePath;
		$this->privateKeyPath = $privateKeyPath;
	}

	/**
	 * @return string
	 */
	public function getQuery() {
		$request = $this->getRequest();
		return http_build_query($request);
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

	/**
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @return array
	 */
	public function getRequest() {
		return $this->request;
	}
}