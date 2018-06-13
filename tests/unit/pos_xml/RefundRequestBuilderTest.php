<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\RefundRequestBuilder;

use Platron\multicarta\CurrencyCode;

class RefundRequestBuilderTest extends RequestBuilderTest {

	const CORRECT_VERSION = '110';
	const CORRECT_COMMAND = 'REFUND';

	const CORRECT_TERMID = 'termid';

	const CORRECT_ID = '123456789012';
	const CORRECT_SESSION = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
	const CORRECT_AMOUNT = '100';
	const CORRECT_CURRENCY = '643';
	const CORRECT_SLN = 'sln';

	public function testSuccessBuild(){

		$version = self::CORRECT_VERSION;
		$command = self::CORRECT_COMMAND;

		$termid = self::CORRECT_TERMID;

		$id = self::CORRECT_ID;
		$session = self::CORRECT_SESSION;
		$amount = self::CORRECT_AMOUNT;
		$currency = self::CORRECT_CURRENCY;
		$sln = self::CORRECT_SLN;

		$builder = new RefundRequestBuilder(
			$termid,
			$id,
			$session,
			$amount
		);
		$builder->setCurrency(new CurrencyCode($currency));
		$builder->setSln($sln);

		$actualRequest = $builder->getRequest();

		$expectedRequest = [
			'VERSION' => $version,
			'COMMAND' => $command,
			'TERMID' => $termid,
			'ID' => $id,
			'SESSION' => $session,
			'CURRENCY' => $currency,
			'AMOUNT' => $amount,
			'SLN' => $sln
		];
		$this->assertArrayEquals($expectedRequest, $actualRequest);
	}

	public function testFailId(){

		$version = self::CORRECT_VERSION;
		$command = self::CORRECT_COMMAND;

		$termid = self::CORRECT_TERMID;

		$id = '1234567890123';
		$session = self::CORRECT_SESSION;
		$amount = self::CORRECT_AMOUNT;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new RefundRequestBuilder(
			$termid,
			$id,
			$session,
			$amount
		);
	}

	public function testFailSession(){

		$version = self::CORRECT_VERSION;
		$command = self::CORRECT_COMMAND;

		$termid = self::CORRECT_TERMID;

		$id = self::CORRECT_ID;
		$session = str_repeat('a', 39);
		$amount = self::CORRECT_AMOUNT;

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new RefundRequestBuilder(
			$termid,
			$id,
			$session,
			$amount
		);
	}

	public function testFailSln(){

		$version = self::CORRECT_VERSION;
		$command = self::CORRECT_COMMAND;

		$termid = self::CORRECT_TERMID;

		$id = self::CORRECT_ID;
		$session = self::CORRECT_SESSION;
		$amount = self::CORRECT_AMOUNT;
		$sln = str_repeat('a', 284);

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new RefundRequestBuilder(
			$termid,
			$id,
			$session,
			$amount
		);
		$builder->setSln($sln);
	}

	public function testFailAmount(){

		$version = self::CORRECT_VERSION;
		$command = self::CORRECT_COMMAND;

		$termid = self::CORRECT_TERMID;

		$id = self::CORRECT_ID;
		$session = self::CORRECT_SESSION;
		$amount = 'asd';

		$this->setExpectedException('Platron\multicarta\Error');

		$builder = new RefundRequestBuilder(
			$termid,
			$id,
			$session,
			$amount
		);
	}
}
