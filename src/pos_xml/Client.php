<?php

namespace Platron\multicarta\pos_xml;

class Client {

	/**
	 * @param ClientParameters $clientParameters
	 * @return ClientResult
	 */
	public function sendRequest(ClientParameters $clientParameters) {
		$urlWithGetRequest = $clientParameters->getUrlWithGetRequest();
		$certificatePath = $clientParameters->getCertificatePath();
		$privateKeyPath = $clientParameters->getPrivateKeyPath();

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $urlWithGetRequest);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSLCERT, $certificatePath);
		curl_setopt($curl, CURLOPT_SSLKEY, $privateKeyPath);

		$returnedData = curl_exec($curl);
		$errorCode = curl_errno($curl);
		$errorMessage = curl_error($curl);
		$result = new ClientResult(
			$returnedData,
			$errorCode,
			$errorMessage
		);

		curl_close($curl);
		
		return $result;
	}
}