<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\PaymentRequestBuilder;

use Platron\multicarta\CurrencyCode;
use DateTime;

class PaymentRequestBuilderTest extends RequestBuilderTest {

	const CORRECT_VERSION = '110';
	const CORRECT_COMMAND = 'PAYMENT';

	const CORRECT_TERMID = 'termid';

	const CORRECT_AMOUNT = '100';
	const CORRECT_INVOICE = '123456';
	const CORRECT_CONDITION = 1;
	const CORRECT_PAN = '1234567890123456789';
	const CORRECT_EXPDATE = '1901';
	const CORRECT_CVV2 = 123;

	const CORRECT_CURRENCY = '643';
	const CORRECT_TDSDATA = 'TDSDATA';

	public function testSuccessBuild(){

		$version = self::CORRECT_VERSION;
		$command = self::CORRECT_COMMAND;

		$termid = self::CORRECT_TERMID;

		$amount = self::CORRECT_AMOUNT;
		$invoice = self::CORRECT_INVOICE;
		$condition = self::CORRECT_CONDITION;
		$pan = self::CORRECT_PAN;
		$expdate = self::CORRECT_EXPDATE;
		$cvv2 = self::CORRECT_CVV2;

		$currency = self::CORRECT_CURRENCY;
		$tdsdata = self::CORRECT_TDSDATA;

		$builder = new PaymentRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$cvv2
		);
		$builder->setCurrency(new CurrencyCode($currency));
		$builder->setTdsdata($tdsdata);

		$actualRequest = $builder->getRequest();

		$expectedRequest = [
			'VERSION' => $version,
			'COMMAND' => $command,
			'TERMID' => $termid,
			'AMOUNT' => $amount,
			'INVOICE' => $invoice,
			'CONDITION' => $condition,
			'PAN' => $pan,
			'EXPDATE' => $expdate,
			'CVV2' => $cvv2,
			'CURRENCY' => $currency,
			'TDSDATA' => $tdsdata
		];
		$this->assertArrayEquals($expectedRequest, $actualRequest);
	}

	public function testFailTermid(){

		$termid = str_repeat('a', 17);

		$amount = self::CORRECT_AMOUNT;
		$invoice = self::CORRECT_INVOICE;
		$condition = self::CORRECT_CONDITION;
		$pan = self::CORRECT_PAN;
		$expdate = self::CORRECT_EXPDATE;
		$cvv2 = self::CORRECT_CVV2;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new PaymentRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$cvv2
		);
	}

	public function testFailAmount(){

		$termid = self::CORRECT_TERMID;

		$amount = 'asd';
		$invoice = self::CORRECT_INVOICE;
		$condition = self::CORRECT_CONDITION;
		$pan = self::CORRECT_PAN;
		$expdate = self::CORRECT_EXPDATE;
		$cvv2 = self::CORRECT_CVV2;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new PaymentRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$cvv2
		);
	}

	public function testFailInvoice(){

		$termid = self::CORRECT_TERMID;

		$amount = self::CORRECT_AMOUNT;
		$invoice = str_repeat('a', 17);
		$condition = self::CORRECT_CONDITION;
		$pan = self::CORRECT_PAN;
		$expdate = self::CORRECT_EXPDATE;
		$cvv2 = self::CORRECT_CVV2;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new PaymentRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$cvv2
		);
	}

	public function testFailCondition(){

		$termid = self::CORRECT_TERMID;

		$amount = self::CORRECT_AMOUNT;
		$invoice = self::CORRECT_INVOICE;
		$condition = 123;
		$pan = self::CORRECT_PAN;
		$expdate = self::CORRECT_EXPDATE;
		$cvv2 = self::CORRECT_CVV2;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new PaymentRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$cvv2
		);
	}

	public function testFailPan(){

		$termid = self::CORRECT_TERMID;

		$amount = self::CORRECT_AMOUNT;
		$invoice = self::CORRECT_INVOICE;
		$condition = self::CORRECT_CONDITION;
		$pan = '12345678901234567890';
		$expdate = self::CORRECT_EXPDATE;
		$cvv2 = self::CORRECT_CVV2;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new PaymentRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$cvv2
		);
	}

	public function testFailCvv(){

		$termid = self::CORRECT_TERMID;

		$amount = self::CORRECT_AMOUNT;
		$invoice = self::CORRECT_INVOICE;
		$condition = self::CORRECT_CONDITION;
		$pan = self::CORRECT_PAN;
		$expdate = self::CORRECT_EXPDATE;
		$cvv2 = 12345;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new PaymentRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$cvv2
		);
	}

	public function testFailTdsdata(){

		$termid = self::CORRECT_TERMID;

		$amount = self::CORRECT_AMOUNT;
		$tdsdata = str_repeat('a', 81);
		$condition = self::CORRECT_CONDITION;
		$pan = self::CORRECT_PAN;
		$expdate = self::CORRECT_EXPDATE;
		$cvv2 = self::CORRECT_CVV2;
		$invoice = self::CORRECT_INVOICE;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new PaymentRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$cvv2
		);
		$builder->setTdsdata($tdsdata);
	}
}
