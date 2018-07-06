<?php

namespace Platron\multicarta\pos_xml;

class Client {

	/**
	 * @var resource $curl
	 */
	private $curl;

	/**
	 * @param ClientParameters $parameters
	 * @return ClientResult
	 */
	public function sendRequest(ClientParameters $parameters) {
		$this->initializeCurl();
		$this->setParameters($parameters);
		$result = $this->getResult();
		$this->closeCurl();
		
		return $result;
	}

	protected function initializeCurl() {
		$curl = curl_init();
		$this->curl = $curl;
	}

	/**
	 * @param ClientParameters $parameters
	 */
	protected function setParameters(ClientParameters $parameters) {
		$curl = $this->getCurl();
		$url = $parameters->getUrl();
		$query = $parameters->getQuery();
		$certificatePath = $parameters->getCertificatePath();
		$privateKeyPath = $parameters->getPrivateKeyPath();
		curl_setopt($curl, CURLOPT_URL, $url.'?'.$query);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSLCERT, $certificatePath);
		curl_setopt($curl, CURLOPT_SSLKEY, $privateKeyPath);
	}

	/**
	 * @return ClientResult
	 */
	protected function getResult() {
		$curl = $this->getCurl();
		$returnedData = curl_exec($curl);
		$errorCode = curl_errno($curl);
		$errorMessage = curl_error($curl);
		$result = new ClientResult(
			$returnedData,
			$errorCode,
			$errorMessage
		);
		return $result;
	}

	protected function closeCurl() {
		$curl = $this->getCurl();
		curl_close($curl);
	}

	/**
	 * @return resource
	 */
	protected function getCurl() {
		return $this->curl;
	}
}