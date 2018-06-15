<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\PreauthResponseParser;

class PreauthResponseParserTest extends ResponseParserTest {

	const CORRECT_COMMAND = 'PREAUTH';
	const CORRECT_VERSION = '110';
	const CORRECT_RESPCODE = '000';
	const CORRECT_TIMESTAMP = '13062018160500';
	const CORRECT_ERRORMSG = null;

	const CORRECT_INVOICE = 'invoice';
	const CORRECT_APPROVAL = 'approval';
	const CORRECT_ETID = 'etid';
	const CORRECT_TRXID = 'trxid';
	const CORRECT_SESSION = 'session';

	public function testSuccessResponse(){

		$command = self::CORRECT_COMMAND;
		$version = self::CORRECT_VERSION;
		$respcode = self::CORRECT_RESPCODE;
		$timestamp = self::CORRECT_TIMESTAMP;
		$errormsg = self::CORRECT_ERRORMSG;

		$invoice = self::CORRECT_INVOICE;
		$approval = self::CORRECT_APPROVAL;
		$etid = self::CORRECT_ETID;
		$trxid = self::CORRECT_TRXID;
		$session = self::CORRECT_SESSION;

		$xml = '<?xml version="1.0"?>
			<response>
				<header>
					<version>'.$version.'</version>
					<command>'.$command.'</command>
					<respcode>'.$respcode.'</respcode>
				</header>
				<result>
					<authinfo>
						<invoice>'.$invoice. '</invoice>
						<approval>'.$approval.'</approval>
						<etid>'.$etid.'</etid>
						<trxid>'.$trxid.'</trxid>
						<session>'.$session.'</session>
					</authinfo>
				</result>
				<footer>
					<timestamp>'.$timestamp.'</timestamp>
				</footer>
			</response>';

		$parser = new PreauthResponseParser($this->createResponse($xml));

		$this->assertTrue($parser->isValid());
		$this->assertTrue($parser->isSuccess());

		$this->assertEquals($command, $parser->getCommand());
		$this->assertEquals($version, $parser->getVersion());
		$this->assertEquals($respcode, $parser->getRespcode());
		$this->assertEquals($timestamp, $parser->getTimestamp()->format('dmYHis'));
		$this->assertEquals($errormsg, $parser->getErrormsg());

		$this->assertEquals($invoice, $parser->getInvoice());
		$this->assertEquals($approval, $parser->getApproval());
		$this->assertEquals($etid, $parser->getEtid());
		$this->assertEquals($trxid, $parser->getTrxid());
		$this->assertEquals($session, $parser->getSession());
	}

	public function testFailStatus(){

		$command = self::CORRECT_COMMAND;
		$version = self::CORRECT_VERSION;
		$respcode = '006';
		$timestamp = self::CORRECT_TIMESTAMP;
		$errormsg = 'errormsg';

		$xml = '<?xml version="1.0"?>
			<response>
				<header>
					<version>'.$version.'</version>
					<command>'.$command.'</command>
					<respcode>'.$respcode.'</respcode>
				</header>
				<footer>
					<errormsg>'.$errormsg.'</errormsg>
					<timestamp>'.$timestamp.'</timestamp>
				</footer>
			</response>';

		$parser = new PreauthResponseParser($this->createResponse($xml));

		$this->assertTrue($parser->isValid());
		$this->assertFalse($parser->isSuccess());
		$this->assertEquals($respcode, $parser->getRespcode());
		$this->assertEquals($command, $parser->getCommand());
		$this->assertEquals($errormsg, $parser->getErrormsg());
	}

	public function testInvalidResponse(){

		$command = 'Command';
		$version = self::CORRECT_VERSION;
		$respcode = self::CORRECT_RESPCODE;
		$timestamp = self::CORRECT_TIMESTAMP;

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

		$parser = new PreauthResponseParser($this->createResponse($xml));

		$this->assertFalse($parser->isValid());
		$this->assertEquals($command, $parser->getCommand());
	}
}
