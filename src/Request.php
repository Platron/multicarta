<?php

namespace Platron\multicarta;

class Request {

	/**
	 * @var string
	 */
	private $url;

	/**
	 * @var string
	 */
	private $post;

	/**
	 * @var string
	 */
	private $certificatePath;

	/**
	 * @var string
	 */
	private $privateKeyPath;

	/**
	 * @var array
	 */
	private $headers;

	/**
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param array
	 */
	public function __construct(
		string $url,
		string $post,
		string $certificatePath,
		string $privateKeyPath,
		array $headers
	) {
		$this->url = $url;
		$this->post = $post;
		$this->certificatePath = $certificatePath;
		$this->privateKeyPath = $privateKeyPath;
		$this->headers = $headers;
	}

	/**
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @return string
	 */
	public function getPost() {
		return $this->post;
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
	 * @return array
	 */
	public function getHeaders() {
		return $this->headers;
	}
}