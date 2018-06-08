<?php

namespace Platron\multicarta\tests\unit\mpi;

use Platron\multicarta\mpi\GetPaReqResponseParser;

/*
	Пример ответа из документации
	<?xml version="1.0" encoding="UTF-8"?>
	<TKKPG>
		<Response>
			<Operation>GetPAReqForm</Operation>
			<Status>NN</Status>
			<url>URLACS</url>
			<MD></MD>
			<termURL></termURL>
			<pareq>PaReq</pareq>
		</Response>
	</TKKPG>
*/
class GetPaReqResponseParserTest extends ResponseParserTest {

	const CORRECT_STATUS = '00';
	const CORRECT_OPERATION = 'GetPAReqForm';

	const CORRECT_URL = 'url';
	const CORRECT_MD = 'MD';
	const CORRECT_TERM_URL = 'termURL';
	const CORRECT_PAREQ = 'pareq';

	public function testSuccessResponse(){

		$Status = self::CORRECT_STATUS;
		$Operation = self::CORRECT_OPERATION;

		$url = self::CORRECT_URL;
		$MD = self::CORRECT_MD;
		$termURL = self::CORRECT_TERM_URL;
		$pareq = self::CORRECT_PAREQ;

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.$Operation.'</Operation>
					<Status>'.$Status.'</Status>
					<url>'.$url.'</url>
					<MD>'.$MD.'</MD>
					<termURL>'.$termURL.'</termURL>
					<pareq>'.$pareq.'</pareq>
				</Response>
			</TKKPG>';

		$parser = new GetPaReqResponseParser($this->createResponse($xml));

		$this->assertTrue($parser->isValid());
		$this->assertTrue($parser->isSuccess());
		$this->assertEquals($Status, $parser->getStatus());
		$this->assertEquals($Operation, $parser->getOperation());

		$this->assertEquals($url, $parser->getUrl());
		$this->assertEquals($pareq, $parser->getPareq());
	}

	public function testFailStatus() {

		$Status = '30';
		$Operation = self::CORRECT_OPERATION;

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.$Operation.'</Operation>
					<Status>'.$Status.'</Status>
				</Response>
			</TKKPG>';

		$parser = new GetPaReqResponseParser($this->createResponse($xml));

		$this->assertTrue($parser->isValid());
		$this->assertFalse($parser->isSuccess());
		$this->assertEquals($parser->getStatus(), $Status);
		$this->assertEquals($parser->getOperation(), $Operation);
	}

	public function testInvalidResponse() {
		$Status = self::CORRECT_STATUS;
		$Operation = 'Operation';

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.$Operation.'</Operation>
					<Status>'.$Status.'</Status>
				</Response>
			</TKKPG>';

		$parser = new GetPaReqResponseParser($this->createResponse($xml));

		$this->assertFalse($parser->isValid());
		$this->assertEquals($parser->getOperation(), $Operation);
	}
}
