<?php

namespace Platron\multicarta\tests\unit\mpi;

use Platron\multicarta\mpi\GetPaReqResponse;

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
class GetPaReqResponseTest extends ResponseTest {

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

		$response = new GetPaReqResponse($this->createSimpleXml($xml));

		$this->assertTrue($response->isValid());
		$this->assertTrue($response->isSuccess());
		$this->assertEquals($Status, $response->getStatus());
		$this->assertEquals($Operation, $response->getOperation());

		$this->assertEquals($url, $response->getUrl());
		$this->assertEquals($pareq, $response->getPareq());
	}
}
