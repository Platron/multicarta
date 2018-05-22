<?php

namespace classes\ps\multicarta\sdk;

class Client {

	/**
	 * @param Request $request
	 * @return Response
	 */
	public function sendRequest(Request $request) {
		$url = $request->getUrl();
		$post = $request->getPost();
		$certificatePath = $request->getCertificatePath();
		$privateKeyPath = $request->getPrivateKeyPath();
		$headers = $request->getHeaders();

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

		$result = curl_exec($curl);
		$errorNumber = curl_errno($curl);
		$errorDescription = curl_error($curl);
		curl_close($curl);

		$response = new Response(
			$result,
			$errorNumber,
			$errorDescription
		);

		return $response;
	}
}