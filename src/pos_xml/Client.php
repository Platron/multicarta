<?php

namespace Platron\multicarta\pos_xml;

use SimpleXMLElement;

class Client {

	/**
	 * @var string
	 */
	private $certificatePath;

	/**
	 * @var string
	 */
	private $privateKeyPath;

	/**
	 * @var string
	 */
	private $resultMessage;

	/**
	 * @var string
	 */
	private $errorCode;

	/**
	 * @var string
	 */
	private $errorMessage;

	public function __construct(
		string $certificatePath,
		string $privateKeyPath
	) {
		$this->certificatePath = $certificatePath;
		$this->privateKeyPath = $privateKeyPath;
	}

	/**
	 * @param string $url
	 * @param array $request
	 * @return SimpleXMLElement
	 */
	public function sendRequest(string $url, array $request) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url.'?'.http_build_query($request));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSLCERT, $this->getCertificatePath());
		curl_setopt($curl, CURLOPT_SSLKEY, $this->getPrivateKeyPath());

		$this->resultMessage = curl_exec($curl);
		$this->errorCode = curl_errno($curl);
		$this->errorMessage = curl_error($curl);
		curl_close($curl);
		if ($this->resultMessage !== false) {
			$response = simplexml_load_string($this->resultMessage);
			if ($response !== false) {
				return $response;
			}
		}
	}

	/**
	 * @return string
	 */
	public function getResultMessage() {
		return $this->resultMessage;
	}

	/**
	 * @return string
	 */
	public function getErrorCode() {
		return $this->errorCode;
	}

	/**
	 * @return string
	 */
	public function getErrorMessage() {
		return $this->errorMessage;
	}

	/**
	 * @return string
	 */
	protected function getCertificatePath() {
		return $this->certificatePath;
	}

	/**
	 * @return string
	 */
	protected function getPrivateKeyPath() {
		return $this->privateKeyPath;
	}
}