<?php

namespace Platron\multicarta\pos_xml;

use SimpleXMLElement;

class Client {

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

	/**
	 * @param string $url
	 * @param array $request
	 * @param string $certificatePath
	 * @param string $privateKeyPath
	 * @return SimpleXMLElement
	 */
	public function sendRequest(
		string $url,
		array $request,
		string $certificatePath,
		string $privateKeyPath
	) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url.'?'.http_build_query($request));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSLCERT, $certificatePath);
		curl_setopt($curl, CURLOPT_SSLKEY, $privateKeyPath);

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
}