<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\refund\Request;

use Platron\multicarta\CurrencyCode;

class RefundRequestTest extends RequestTest {

	const CORRECT_VERSION = '110';
	const CORRECT_COMMAND = 'REFUND';

	const CORRECT_TERMID = 'termid';

	const CORRECT_ID = '123456789012';
	const CORRECT_SESSION = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
	const CORRECT_AMOUNT = '100';
	const CORRECT_CURRENCY = '643';
	const CORRECT_SLN = 'sln';

	public function testSuccessRequest(){

		$version = self::CORRECT_VERSION;
		$command = self::CORRECT_COMMAND;

		$termid = self::CORRECT_TERMID;

		$id = self::CORRECT_ID;
		$session = self::CORRECT_SESSION;
		$amount = self::CORRECT_AMOUNT;
		$currency = self::CORRECT_CURRENCY;
		$sln = self::CORRECT_SLN;

		$request = new Request(
			$termid,
			$id,
			$session,
			$amount,
			new CurrencyCode($currency)
		);
		$request->setSln($sln);

		$expectedArrayRequest = [
			'VERSION' => $version,
			'COMMAND' => $command,
			'TERMID' => $termid,
			'ID' => $id,
			'SESSION' => $session,
			'CURRENCY' => $currency,
			'AMOUNT' => $amount,
			'SLN' => $sln
		];
		$this->assertArrayEquals(
			$expectedArrayRequest,
			$request->asArray()
		);
	}
}
