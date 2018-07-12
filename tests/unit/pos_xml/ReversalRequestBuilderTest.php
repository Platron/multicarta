<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\ReversalRequestBuilder;

class ReversalRequestBuilderTest extends RequestBuilderTest {

	const CORRECT_VERSION = '110';
	const CORRECT_COMMAND = 'PAYMENTREVERSAL';

	const CORRECT_TERMID = 'termid';

	const CORRECT_ID = '123456789012';
	const CORRECT_SESSION = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';

	public function testSuccessBuild(){

		$version = self::CORRECT_VERSION;
		$command = self::CORRECT_COMMAND;

		$termid = self::CORRECT_TERMID;

		$id = self::CORRECT_ID;
		$session = self::CORRECT_SESSION;

		$builder = new ReversalRequestBuilder(
			$termid,
			$id,
			$session
		);

		$actualRequest = $builder->getRequest();

		$expectedRequest = [
			'VERSION' => $version,
			'COMMAND' => $command,
			'TERMID' => $termid,
			'ID' => $id,
			'SESSION' => $session
		];
		$this->assertArrayEquals($expectedRequest, $actualRequest);
	}
}
