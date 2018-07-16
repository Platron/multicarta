<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\complete\Request;

use Platron\multicarta\CurrencyCode;

class CompleteRequestTest extends RequestTest {

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

	public function testSuccessRequest(){

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

		$request = new Request(
			$termid,
			$amount,
			new CurrencyCode($currency),
			$invoice,
			$condition,
			$id,
			$authcode,
			$invoiceorig
		);

		$expectedArrayRequest = [
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
		$this->assertArrayEquals(
			$expectedArrayRequest,
			$request->asArray()
		);
	}
}
