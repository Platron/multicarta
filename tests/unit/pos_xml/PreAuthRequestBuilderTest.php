<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\PreauthRequestBuilder;

use Platron\multicarta\CurrencyCode;
use DateTime;

class PreauthRequestBuilderTest extends RequestBuilderTest {

	const CORRECT_VERSION = '110';
	const CORRECT_COMMAND = 'PREAUTH';

	const CORRECT_TERMID = 'termid';

	const CORRECT_PAN = '1234567890123456789';
	const CORRECT_EXPDATE = '1901';
	const CORRECT_AMOUNT = '100';
	const CORRECT_CVV2 = 123;
	const CORRECT_CONDITION = 1;
	const CORRECT_TDSDATA = 'TDSDATA';
	const CORRECT_INVOICE = '123456';
	const CORRECT_CURRENCY = '643';

	public function testSuccessBuild(){

		$version = self::CORRECT_VERSION;
		$command = self::CORRECT_COMMAND;

		$termid = self::CORRECT_TERMID;

		$pan = self::CORRECT_PAN;
		$expdate = self::CORRECT_EXPDATE;
		$amount = self::CORRECT_AMOUNT;
		$cvv2 = self::CORRECT_CVV2;
		$condition = self::CORRECT_CONDITION;
		$tdsdata = self::CORRECT_TDSDATA;
		$invoice = self::CORRECT_INVOICE;
		$currency = self::CORRECT_CURRENCY;

		$builder = new PreauthRequestBuilder(
			$termid,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$amount,
			$cvv2,
			$condition,
			$tdsdata,
			$invoice
		);
		$builder->setCurrency(new CurrencyCode($currency));

		$actualRequest = $builder->getRequest();

		$expectedRequest = [
			'VERSION' => $version,
			'COMMAND' => $command,
			'TERMID' => $termid,
			'PAN' => $pan,
			'EXPDATE' => $expdate,
			'AMOUNT' => $amount,
			'CVV2' => $cvv2,
			'CONDITION' => $condition,
			'TDSDATA' => $tdsdata,
			'INVOICE' => $invoice,
			'CURRENCY' => $currency
		];
		$this->assertArrayEquals($expectedRequest, $actualRequest);
	}

	public function testFailPan(){

		$termid = self::CORRECT_TERMID;
		$pan = '12345678901234567890';
		$expdate = self::CORRECT_EXPDATE;
		$amount = self::CORRECT_AMOUNT;
		$cvv2 = self::CORRECT_CVV2;
		$condition = self::CORRECT_CONDITION;
		$tdsdata = self::CORRECT_TDSDATA;
		$invoice = self::CORRECT_INVOICE;
		$currency = self::CORRECT_CURRENCY;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new PreauthRequestBuilder(
			$termid,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$amount,
			$cvv2,
			$condition,
			$tdsdata,
			$invoice
		);
	}

	public function testFailCvv(){

		$termid = self::CORRECT_TERMID;
		$pan = self::CORRECT_PAN;
		$expdate = self::CORRECT_EXPDATE;
		$amount = self::CORRECT_AMOUNT;
		$cvv2 = 12345;
		$condition = self::CORRECT_CONDITION;
		$tdsdata = self::CORRECT_TDSDATA;
		$invoice = self::CORRECT_INVOICE;
		$currency = self::CORRECT_CURRENCY;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new PreauthRequestBuilder(
			$termid,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$amount,
			$cvv2,
			$condition,
			$tdsdata,
			$invoice
		);
	}

	public function testFailCondition(){

		$termid = self::CORRECT_TERMID;
		$pan = self::CORRECT_PAN;
		$expdate = self::CORRECT_EXPDATE;
		$amount = self::CORRECT_AMOUNT;
		$cvv2 = self::CORRECT_CVV2;
		$condition = 123;
		$tdsdata = self::CORRECT_TDSDATA;
		$invoice = self::CORRECT_INVOICE;
		$currency = self::CORRECT_CURRENCY;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new PreauthRequestBuilder(
			$termid,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$amount,
			$cvv2,
			$condition,
			$tdsdata,
			$invoice
		);
	}

	public function testFailTdsdata(){

		$termid = self::CORRECT_TERMID;
		$pan = self::CORRECT_PAN;
		$expdate = self::CORRECT_EXPDATE;
		$amount = self::CORRECT_AMOUNT;
		$cvv2 = self::CORRECT_CVV2;
		$condition = self::CORRECT_CONDITION;
		$tdsdata = str_repeat('a', 81);
		$invoice = self::CORRECT_INVOICE;
		$currency = self::CORRECT_CURRENCY;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new PreauthRequestBuilder(
			$termid,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$amount,
			$cvv2,
			$condition,
			$tdsdata,
			$invoice
		);
	}

	public function testFailInvoice(){

		$termid = self::CORRECT_TERMID;
		$pan = self::CORRECT_PAN;
		$expdate = self::CORRECT_EXPDATE;
		$amount = self::CORRECT_AMOUNT;
		$cvv2 = self::CORRECT_CVV2;
		$condition = self::CORRECT_CONDITION;
		$tdsdata = self::CORRECT_TDSDATA;
		$invoice = str_repeat('a', 17);
		$currency = self::CORRECT_CURRENCY;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new PreauthRequestBuilder(
			$termid,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$amount,
			$cvv2,
			$condition,
			$tdsdata,
			$invoice
		);
	}

	public function testFailAmount(){

		$termid = self::CORRECT_TERMID;
		$pan = self::CORRECT_PAN;
		$expdate = self::CORRECT_EXPDATE;
		$amount = 'asd';
		$cvv2 = self::CORRECT_CVV2;
		$condition = self::CORRECT_CONDITION;
		$tdsdata = self::CORRECT_TDSDATA;
		$invoice = self::CORRECT_INVOICE;
		$currency = self::CORRECT_CURRENCY;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new PreauthRequestBuilder(
			$termid,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$amount,
			$cvv2,
			$condition,
			$tdsdata,
			$invoice
		);
	}
}
