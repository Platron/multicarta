<?php

namespace Platron\multicarta\tests\integration;

use PHPUnit\Framework\TestCase;

use DateTime;
use Platron\multicarta\CurrencyCode;
use Platron\multicarta\mpi\Client;
use Platron\multicarta\mpi\InterfaceLanguage;

use Platron\multicarta\mpi\CreateOrderRequestBuilder;
use Platron\multicarta\mpi\CreateOrderResponseParser;

use Platron\multicarta\mpi\EnrollCheckingRequestBuilder;
use Platron\multicarta\mpi\EnrollCheckingResponseParser;

use Platron\multicarta\mpi\GetPaReqRequestBuilder;
use Platron\multicarta\mpi\GetPaReqResponseParser;

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

		$builder = new CreateOrderRequestBuilder(
			$Merchant,
			$Amount,
			$Description,
			$TDSVendorMerID,
			$TDSVendorName
		);
		$builder->setCurrency(new CurrencyCode($Currency));
		$builder->setLanguage(new InterfaceLanguage($Language));
		$request = $builder->getRequest();
		$response = $this->sendRequest($request);
		$parser = new CreateOrderResponseParser($response);
		$this->assertTrue($parser->isValid());
		$this->assertTrue($parser->isSuccess());

		$this->OrderID = $parser->getOrderID();
		$this->SessionID = $parser->getSessionID();
	}

	protected function startEnrollCheckingOperation() {
		$Merchant = $this->Merchant;
		$PAN = $this->PAN;
		$OrderID = $this->OrderID;
		$SessionID = $this->SessionID;

		$builder = new EnrollCheckingRequestBuilder(
			$Merchant,
			$PAN,
			$OrderID,
			$SessionID
		);
		$request = $builder->getRequest();
		$response = $this->sendRequest($request);
		$parser = new EnrollCheckingResponseParser($response);
		$this->assertTrue($parser->isValid());
		$this->assertTrue($parser->isSuccess());
	}

	protected function startGetPaReqOperation() {
		$Merchant = $this->Merchant;
		$PAN = $this->PAN;
		$OrderID = $this->OrderID;
		$SessionID = $this->SessionID;
		$ExpDate = $this->ExpDate;

		$builder = new GetPaReqRequestBuilder(
			$Merchant,
			$PAN,
			$OrderID,
			$SessionID,
			DateTime::createFromFormat('ym', $ExpDate)
		);
		$request = $builder->getRequest();
		$response = $this->sendRequest($request);
		$parser = new GetPaReqResponseParser($response);
		$this->assertTrue($parser->isValid());
		$this->assertTrue($parser->isSuccess());
	}

	protected function sendRequest($request) {
		$url = $this->url;
		$certificatePath = $this->certificatePath;
		$privateKeyPath = $this->privateKeyPath;
		$client = new Client();
		$response = $client->sendRequest(
			$url,
			$request,
			$certificatePath,
			$privateKeyPath
		);
		return $response;
	}
}
