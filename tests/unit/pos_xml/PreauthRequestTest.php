<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\preauth\Request;

use Platron\multicarta\CurrencyCode;
use DateTime;

class PreauthRequestTest extends RequestTest {

	const CORRECT_VERSION = '110';
	const CORRECT_COMMAND = 'PREAUTH';

	const CORRECT_TERMID = 'termid';

	const CORRECT_AMOUNT = '100';
	const CORRECT_INVOICE = '123456';
	const CORRECT_CONDITION = 1;
	const CORRECT_PAN = '1234567890123456789';
	const CORRECT_EXPDATE = '1901';
	const CORRECT_CVV2 = 123;

	const CORRECT_CURRENCY = '643';
	const CORRECT_TDSDATA = 'TDSDATA';

	public function testSuccessRequest(){

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

		$request = new Request(
			$termid,
			$amount,
			new CurrencyCode($currency),
			$invoice,
			$condition,
			$pan,
			DateTime::createFromFormat('ym', $expdate),
			$cvv2
		);
		$request->setTdsdata($tdsdata);

		$expectedArrayRequest = [
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
		$this->assertArrayEquals(
			$expectedArrayRequest,
			$request->asArray()
		);
	}
}
