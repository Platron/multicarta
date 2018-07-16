<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\reversal\Response;

class ReversalResponseTest extends ResponseTest {

	const CORRECT_COMMAND = 'PAYMENTREVERSAL';
	const CORRECT_VERSION = '110';
	const CORRECT_RESPCODE = '000';
	const CORRECT_TIMESTAMP = '13062018160500';
	const CORRECT_ERRORMSG = null;

	public function testSuccessResponse(){

		$command = self::CORRECT_COMMAND;
		$version = self::CORRECT_VERSION;
		$respcode = self::CORRECT_RESPCODE;
		$timestamp = self::CORRECT_TIMESTAMP;
		$errormsg = self::CORRECT_ERRORMSG;

		$xml = '<?xml version="1.0"?>
			<response>
				<header>
					<version>'.$version.'</version>
					<command>'.$command.'</command>
					<respcode>'.$respcode.'</respcode>
				</header>
				<footer>
					<timestamp>'.$timestamp.'</timestamp>
				</footer>
			</response>';

		$response = new Response($this->createSimpleXml($xml));

		$this->assertTrue($response->isValid());
		$this->assertTrue($response->isSuccess());

		$this->assertEquals($command, $response->getCommand());
		$this->assertEquals($version, $response->getVersion());
		$this->assertEquals($respcode, $response->getRespcode());
		$this->assertEquals($timestamp, $response->getTimestamp()->format('dmYHis'));
		$this->assertEquals($errormsg, $response->getErrormsg());
	}
}
