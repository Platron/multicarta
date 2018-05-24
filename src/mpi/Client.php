<?php

namespace Platron\multicarta\mpi;

class Client {

	/**
	 * @var string
	 */
	private $certificatePath;

	/**
	 * @var string
	 */
	private $privateKeyPath;

	public function __construct(
		string $certificatePath,
		string $privateKeyPath
	) {
		$this->certificatePath = $certificatePath;
		$this->privateKeyPath = $privateKeyPath;
	}

	/**
	 * @param string $url
	 * @param string $request
	 * @return string
	 */
	public function sendRequest(string $url, string $request) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getHeaders());
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
		curl_setopt($curl, CURLOPT_SSLCERT, $this->getCertificatePath());
		curl_setopt($curl, CURLOPT_SSLKEY, $this->getPrivateKeyPath());

		$response = curl_exec($curl);
		$errorMessage = curl_error($curl);
		$errorCode = curl_errno($curl);
		curl_close($curl);
		if ($response === false) {
			throw new ClientError($errorMessage, $errorCode);
		}

		return $response;
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