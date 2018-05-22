<?php

namespace classes\ps\multicarta\sdk;

class SettingData {

	/**
	 * @var string $merchantId
	 */
	private $merchantId;

	/**
	 * @var SslData $sslData
	 */
	private $sslData;

	/**
	 * @param string $merchantId
	 * @param SslData $sslData
	 */
	public function __construct(
		string $merchantId,
		SslData $sslData
	) {
		$this->merchantId = $merchantId;
		$this->sslData = $sslData;
	}

	/**
	 * @return string
	 */
	public function getMerchantId() {
		return $this->merchantId;
	}

	/**
	 * @return string
	 */
	public function getCertificatePath() {
		return $this->sslData->getCertificatePath();
	}

	/**
	 * @return string
	 */
	public function getPrivateKeyPath() {
		return $this->sslData->getPrivateKeyPath();
	}
}