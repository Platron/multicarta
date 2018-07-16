<?php

namespace Platron\multicarta\pos_xml;

class Client {

	/**
	 * @param string $url
	 * @param string $certificatePath
	 * @param string $privateKeyPath
	 * @return ClientResult
	 */
	public function send(
		string $url,
		string $certificatePath,
		string $privateKeyPath
	) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSLCERT, $certificatePath);
		curl_setopt($curl, CURLOPT_SSLKEY, $privateKeyPath);
		$returnMessage = curl_exec($curl);
		$errorCode = curl_errno($curl);
		$errorMessage = curl_error($curl);
		if ($returnMessage === false) {
			$returnMessage = '';
		}
		$result = new ClientResult(
			$returnMessage,
			$errorCode,
			$errorMessage
		);
		curl_close($curl);
		
		return $result;
	}	
}