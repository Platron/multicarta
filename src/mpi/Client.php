<?php

namespace Platron\multicarta\mpi;

class Client {

	/**
	 * @param string $url
	 * @param string $post
	 * @param string $certificatePath
	 * @param string $privateKeyPath
	 * @param array $headers
	 * @return ClientResult
	 */
	public function send(
		string $url,
		string $post,
		string $certificatePath,
		string $privateKeyPath,
		array $headers
	) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
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