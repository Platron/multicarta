<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\refund\Response;

class RefundResponseTest extends ResponseTest {

	const CORRECT_COMMAND = 'REFUND';
	const CORRECT_VERSION = '110';
	const CORRECT_RESPCODE = '000';
	const CORRECT_TIMESTAMP = '13062018160500';
	const CORRECT_ERRORMSG = null;

	const CORRECT_RRN = 'rrn';
	const CORRECT_TRXID = 'trxid';

	public function testSuccessResponse(){

		$command = self::CORRECT_COMMAND;
		$version = self::CORRECT_VERSION;
		$respcode = self::CORRECT_RESPCODE;
		$timestamp = self::CORRECT_TIMESTAMP;
		$errormsg = self::CORRECT_ERRORMSG;

		$rrn = self::CORRECT_RRN;
		$trxid = self::CORRECT_TRXID;

		$xml = '<?xml version="1.0"?>
			<response>
				<header>
					<version>'.$version.'</version>
					<command>'.$command.'</command>
					<respcode>'.$respcode.'</respcode>
				</header>
				<result>
					<authinfo>
						<rrn>'.$rrn.'</rrn>
						<trxid>'.$trxid.'</trxid>
					</authinfo>
				</result>
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

		$this->assertEquals($rrn, $response->getRrn());
		$this->assertEquals($trxid, $response->getTrxid());
	}
}
