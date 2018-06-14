<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\CompleteRequestBuilder;

use Platron\multicarta\CurrencyCode;

class CompleteRequestBuilderTest extends RequestBuilderTest {

	const CORRECT_VERSION = '110';
	const CORRECT_COMMAND = 'COMPLETE';

	const CORRECT_TERMID = 'termid';
	const CORRECT_ID = 'trxid';
	const CORRECT_AMOUNT = '100';
	const CORRECT_CONDITION = 1;
	const CORRECT_INVOICE = '123456';
	const CORRECT_CURRENCY = '643';
	const CORRECT_AUTHCODE = 'authcode';
	const CORRECT_INVOICEORIG = 'invoiceorig';

	public function testSuccessBuild(){

		$version = self::CORRECT_VERSION;
		$command = self::CORRECT_COMMAND;

		$termid = self::CORRECT_TERMID;
		$id = self::CORRECT_ID;
		$amount = self::CORRECT_AMOUNT;
		$condition = self::CORRECT_CONDITION;
		$invoice = self::CORRECT_INVOICE;
		$currency = self::CORRECT_CURRENCY;
		$authcode = self::CORRECT_AUTHCODE;
		$invoiceorig = self::CORRECT_INVOICEORIG;

		$builder = new CompleteRequestBuilder(
			$termid,
			$id,
			$amount,
			$condition,
			$invoice,
			$authcode,
			$invoiceorig
		);
		$builder->setCurrency(new CurrencyCode($currency));

		$actualRequest = $builder->getRequest();

		$expectedRequest = [
			'VERSION' => $version,
			'COMMAND' => $command,
			'TERMID' => $termid,
			'ID' => $id,
			'AMOUNT' => $amount,
			'CONDITION' => $condition,
			'INVOICE' => $invoice,
			'CURRENCY' => $currency,
			'AUTHCODE' => $authcode,
			'INVOICEORIG' => $invoiceorig
		];
		$this->assertArrayEquals($expectedRequest, $actualRequest);
	}

	public function testFailId() {
		$termid = self::CORRECT_TERMID;
		$id = str_repeat('a', 13);
		$amount = self::CORRECT_AMOUNT;
		$condition = self::CORRECT_CONDITION;
		$invoice = self::CORRECT_INVOICE;
		$currency = self::CORRECT_CURRENCY;
		$authcode = self::CORRECT_AUTHCODE;
		$invoiceorig = self::CORRECT_INVOICEORIG;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new CompleteRequestBuilder(
			$termid,
			$id,
			$amount,
			$condition,
			$invoice,
			$authcode,
			$invoiceorig
		);
	}

	public function testFailAuthcode() {
		$termid = self::CORRECT_TERMID;
		$id = self::CORRECT_ID;
		$amount = self::CORRECT_AMOUNT;
		$condition = self::CORRECT_CONDITION;
		$invoice = self::CORRECT_INVOICE;
		$currency = self::CORRECT_CURRENCY;
		$authcode = str_repeat('a', 9);
		$invoiceorig = self::CORRECT_INVOICEORIG;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new CompleteRequestBuilder(
			$termid,
			$id,
			$amount,
			$condition,
			$invoice,
			$authcode,
			$invoiceorig
		);
	}

	public function testFailInvoiceorig() {
		$termid = self::CORRECT_TERMID;
		$id = self::CORRECT_ID;
		$amount = self::CORRECT_AMOUNT;
		$condition = self::CORRECT_CONDITION;
		$invoice = self::CORRECT_INVOICE;
		$currency = self::CORRECT_CURRENCY;
		$authcode = self::CORRECT_AUTHCODE;
		$invoiceorig = str_repeat('a', 17);

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new CompleteRequestBuilder(
			$termid,
			$id,
			$amount,
			$condition,
			$invoice,
			$authcode,
			$invoiceorig
		);
	}

	public function testFailCondition(){

		$termid = self::CORRECT_TERMID;
		$id = self::CORRECT_ID;
		$amount = self::CORRECT_AMOUNT;
		$condition = 123;
		$invoice = self::CORRECT_INVOICE;
		$currency = self::CORRECT_CURRENCY;
		$authcode = self::CORRECT_AUTHCODE;
		$invoiceorig = self::CORRECT_INVOICEORIG;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new CompleteRequestBuilder(
			$termid,
			$id,
			$amount,
			$condition,
			$invoice,
			$authcode,
			$invoiceorig
		);
	}

	public function testFailInvoice(){

		$termid = self::CORRECT_TERMID;
		$id = self::CORRECT_ID;
		$amount = self::CORRECT_AMOUNT;
		$condition = self::CORRECT_CONDITION;
		$invoice = str_repeat('a', 17);
		$currency = self::CORRECT_CURRENCY;
		$authcode = self::CORRECT_AUTHCODE;
		$invoiceorig = self::CORRECT_INVOICEORIG;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new CompleteRequestBuilder(
			$termid,
			$id,
			$amount,
			$condition,
			$invoice,
			$authcode,
			$invoiceorig
		);
	}

	public function testFailAmount(){

		$termid = self::CORRECT_TERMID;
		$id = self::CORRECT_ID;
		$amount = 'asd';
		$condition = self::CORRECT_CONDITION;
		$invoice = self::CORRECT_INVOICE;
		$currency = self::CORRECT_CURRENCY;
		$authcode = self::CORRECT_AUTHCODE;
		$invoiceorig = self::CORRECT_INVOICEORIG;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new CompleteRequestBuilder(
			$termid,
			$id,
			$amount,
			$condition,
			$invoice,
			$authcode,
			$invoiceorig
		);
	}
}
