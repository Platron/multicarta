<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\reversal\Request;

class ReversalRequestTest extends RequestTest {

	const CORRECT_VERSION = '110';
	const CORRECT_COMMAND = 'PAYMENTREVERSAL';

	const CORRECT_TERMID = 'termid';

	const CORRECT_ID = '123456789012';
	const CORRECT_SESSION = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';

	public function testSuccessRequest(){

		$version = self::CORRECT_VERSION;
		$command = self::CORRECT_COMMAND;

		$termid = self::CORRECT_TERMID;

		$id = self::CORRECT_ID;
		$session = self::CORRECT_SESSION;

		$request = new Request(
			$termid,
			$id,
			$session
		);

		$expectedArrayRequest = [
			'VERSION' => $version,
			'COMMAND' => $command,
			'TERMID' => $termid,
			'ID' => $id,
			'SESSION' => $session
		];
		$this->assertArrayEquals(
			$expectedArrayRequest,
			$request->asArray()
		);
	}
}
