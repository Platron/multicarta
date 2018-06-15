<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\CompleteRequestBuilder;

use Platron\multicarta\CurrencyCode;

class CompleteRequestBuilderTest extends RequestBuilderTest {

	const CORRECT_VERSION = '110';
	const CORRECT_COMMAND = 'COMPLETE';

	const CORRECT_TERMID = 'termid';

	const CORRECT_AMOUNT = '100';
	const CORRECT_INVOICE = '123456';
	const CORRECT_CONDITION = 1;
	const CORRECT_ID = 'trxid';
	const CORRECT_AUTHCODE = 'authcode';
	const CORRECT_INVOICEORIG = 'invoiceorig';

	const CORRECT_CURRENCY = '643';

	public function testSuccessBuild(){

		$version = self::CORRECT_VERSION;
		$command = self::CORRECT_COMMAND;

		$termid = self::CORRECT_TERMID;
		$amount = self::CORRECT_AMOUNT;
		$invoice = self::CORRECT_INVOICE;
		$condition = self::CORRECT_CONDITION;
		$id = self::CORRECT_ID;
		$authcode = self::CORRECT_AUTHCODE;
		$invoiceorig = self::CORRECT_INVOICEORIG;

		$currency = self::CORRECT_CURRENCY;

		$builder = new CompleteRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$id,
			$authcode,
			$invoiceorig
		);
		$builder->setCurrency(new CurrencyCode($currency));

		$actualRequest = $builder->getRequest();

		$expectedRequest = [
			'VERSION' => $version,
			'COMMAND' => $command,
			'TERMID' => $termid,
			'AMOUNT' => $amount,
			'INVOICE' => $invoice,
			'CONDITION' => $condition,
			'ID' => $id,
			'AUTHCODE' => $authcode,
			'INVOICEORIG' => $invoiceorig,
			'CURRENCY' => $currency
		];
		$this->assertArrayEquals($expectedRequest, $actualRequest);
	}

	public function testFailTermid(){

		$termid = str_repeat('a', 17);

		$amount = self::CORRECT_AMOUNT;
		$invoice = self::CORRECT_INVOICE;
		$condition = self::CORRECT_CONDITION;
		$id = self::CORRECT_ID;
		$authcode = self::CORRECT_AUTHCODE;
		$invoiceorig = self::CORRECT_INVOICEORIG;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new CompleteRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$id,
			$authcode,
			$invoiceorig
		);
	}

	public function testFailAmount(){

		$termid = self::CORRECT_TERMID;

		$amount = 'asd';
		$invoice = self::CORRECT_INVOICE;
		$condition = self::CORRECT_CONDITION;
		$id = self::CORRECT_ID;
		$authcode = self::CORRECT_AUTHCODE;
		$invoiceorig = self::CORRECT_INVOICEORIG;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new CompleteRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$id,
			$authcode,
			$invoiceorig
		);
	}

	public function testFailInvoice(){

		$termid = self::CORRECT_TERMID;

		$amount = self::CORRECT_AMOUNT;
		$invoice = str_repeat('a', 17);
		$condition = self::CORRECT_CONDITION;
		$id = self::CORRECT_ID;
		$authcode = self::CORRECT_AUTHCODE;
		$invoiceorig = self::CORRECT_INVOICEORIG;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new CompleteRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$id,
			$authcode,
			$invoiceorig
		);
	}

	public function testFailCondition(){

		$termid = self::CORRECT_TERMID;

		$amount = self::CORRECT_AMOUNT;
		$invoice = self::CORRECT_INVOICE;
		$condition = 123;
		$id = self::CORRECT_ID;
		$authcode = self::CORRECT_AUTHCODE;
		$invoiceorig = self::CORRECT_INVOICEORIG;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new CompleteRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$id,
			$authcode,
			$invoiceorig
		);
	}

	public function testFailId() {
		$termid = self::CORRECT_TERMID;

		$amount = self::CORRECT_AMOUNT;
		$invoice = self::CORRECT_INVOICE;
		$condition = self::CORRECT_CONDITION;
		$id = str_repeat('a', 13);
		$authcode = self::CORRECT_AUTHCODE;
		$invoiceorig = self::CORRECT_INVOICEORIG;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new CompleteRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$id,
			$authcode,
			$invoiceorig
		);
	}

	public function testFailAuthcode() {

		$termid = self::CORRECT_TERMID;

		$amount = self::CORRECT_AMOUNT;
		$invoice = self::CORRECT_INVOICE;
		$condition = self::CORRECT_CONDITION;
		$id = self::CORRECT_ID;
		$authcode = str_repeat('a', 9);
		$invoiceorig = self::CORRECT_INVOICEORIG;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new CompleteRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$id,
			$authcode,
			$invoiceorig
		);
	}

	public function testFailInvoiceorig() {

		$termid = self::CORRECT_TERMID;

		$amount = self::CORRECT_AMOUNT;
		$invoice = self::CORRECT_INVOICE;
		$condition = self::CORRECT_CONDITION;
		$id = self::CORRECT_ID;
		$authcode = self::CORRECT_AUTHCODE;
		$invoiceorig = str_repeat('a', 17);

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new CompleteRequestBuilder(
			$termid,
			$amount,
			$invoice,
			$condition,
			$id,
			$authcode,
			$invoiceorig
		);
	}
}
