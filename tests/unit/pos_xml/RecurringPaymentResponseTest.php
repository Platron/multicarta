<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use Platron\multicarta\pos_xml\recurring_payment\Response;

class RecurringPaymentResponseTest extends ResponseTest {

	const CORRECT_COMMAND = 'PAYMENT';
	const CORRECT_VERSION = '110';
	const CORRECT_RESPCODE = '000';
	const CORRECT_TIMESTAMP = '13062018160500';
	const CORRECT_ERRORMSG = null;

	const CORRECT_INVOICE = 'invoice';
	const CORRECT_APPROVAL = 'approval';
	const CORRECT_RRN = 'rrn';
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
		$rrn = self::CORRECT_RRN;
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
						<rrn>'.$rrn.'</rrn>
						<etid>'.$etid.'</etid>
						<trxid>'.$trxid.'</trxid>
						<session>'.$session.'</session>
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

		$this->assertEquals($invoice, $response->getInvoice());
		$this->assertEquals($approval, $response->getApproval());
		$this->assertEquals($rrn, $response->getRrn());
		$this->assertEquals($etid, $response->getEtid());
		$this->assertEquals($trxid, $response->getTrxid());
		$this->assertEquals($session, $response->getSession());
	}
}
