<?php

namespace Platron\multicarta\mpi;

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
	 * @param SimpleXMLElement $request
	 * @return SimpleXMLElement
	 */
	public function sendRequest(string $url, SimpleXMLElement $request) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getHeaders());
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $request->asXML());
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
	 * @return array
	 */
	protected function getHeaders() {
		return ['Content-type: text/xml'];
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