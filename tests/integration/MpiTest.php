<?php

namespace Platron\multicarta\tests\integration;

use PHPUnit\Framework\TestCase;

use DateTime;
use Platron\multicarta\CurrencyCode;
use Platron\multicarta\mpi\Client;
use Platron\multicarta\mpi\InterfaceLanguage;

use Platron\multicarta\mpi\CreateOrderRequest;
use Platron\multicarta\mpi\CreateOrderResponse;

use Platron\multicarta\mpi\EnrollCheckingRequest;
use Platron\multicarta\mpi\EnrollCheckingResponse;

use Platron\multicarta\mpi\GetPaReqRequest;
use Platron\multicarta\mpi\GetPaReqResponse;

class MpiTest extends TestCase {

	protected $url;
	protected $certificatePath;
	protected $privateKeyPath;
	protected $Merchant;
	protected $TDSVendorMerID;
	protected $TDSVendorName;
	protected $PAN;

	protected $OrderID;
	protected $SessionID;

	public function __construct(){
		$this->url = Config::URL;
		$this->certificatePath = Config::CERTIFICATE_PATH;
		$this->privateKeyPath = Config::PRIVATE_KEY_PATH;
		$this->Merchant = Config::MERCHANT;
		$this->TDSVendorMerID = Config::TDS_VENDOR_MER_ID;
		$this->TDSVendorName = Config::TDS_VENDOR_NAME;
		$this->PAN = Config::PAN;
		$this->ExpDate = Config::EXP_DATE;
		parent::__construct();
	}

	public function testSuccess(){
		$this->startCreateOrderOperation();
		$this->startEnrollCheckingOperation();
		$this->startGetPaReqOperation();
	}

	protected function startCreateOrderOperation() {
		$Language = 'RU';
		$Merchant = $this->Merchant;
		$Amount = 100;
		$Currency = '643';
		$Description = 'Description';
		$TDSVendorMerID = $this->TDSVendorMerID;
		$TDSVendorName = $this->TDSVendorName;

		$request = new CreateOrderRequest(
			$Merchant,
			$Amount,
			$Description,
			new CurrencyCode($Currency),
			new InterfaceLanguage($Language),
			$TDSVendorMerID,
			$TDSVendorName
		);
		$simpleXmlResponse = $this->send($request->asSimpleXml());
		$response = new CreateOrderResponse($simpleXmlResponse);
		$this->assertTrue($response->isValid());
		$this->assertTrue($response->isSuccess());

		$this->OrderID = $response->getOrderID();
		$this->SessionID = $response->getSessionID();
	}

	protected function startEnrollCheckingOperation() {
		$Merchant = $this->Merchant;
		$PAN = $this->PAN;
		$OrderID = $this->OrderID;
		$SessionID = $this->SessionID;

		$request = new EnrollCheckingRequest(
			$Merchant,
			$PAN,
			$OrderID,
			$SessionID
		);
		$simpleXmlResponse = $this->send($request->asSimpleXml());
		$response = new EnrollCheckingResponse($simpleXmlResponse);
		$this->assertTrue($response->isValid());
		$this->assertTrue($response->isSuccess());
	}

	protected function startGetPaReqOperation() {
		$Merchant = $this->Merchant;
		$PAN = $this->PAN;
		$OrderID = $this->OrderID;
		$SessionID = $this->SessionID;
		$ExpDate = $this->ExpDate;

		$request = new GetPaReqRequest(
			$Merchant,
			$PAN,
			$OrderID,
			$SessionID,
			DateTime::createFromFormat('ym', $ExpDate)
		);
		$simpleXmlResponse = $this->send($request->asSimpleXml());
		$response = new GetPaReqResponse($simpleXmlResponse);
		$this->assertTrue($response->isValid());
		$this->assertTrue($response->isSuccess());
	}

	protected function send($simpleXmlRequest) {
		$url = $this->url;
		$certificatePath = $this->certificatePath;
		$privateKeyPath = $this->privateKeyPath;
		$headers = ['Content-type: text/xml'];
		$client = new Client();
		$result = $client->send(
			$url,
			$simpleXmlRequest->asXML(),
			$certificatePath,
			$privateKeyPath,
			$headers
		);
		$returnMessage = $result->getReturnMessage();
		$simpleXmlRequest = simplexml_load_string($returnMessage);
		return $simpleXmlRequest;
	}
}
