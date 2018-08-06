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

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.self::CORRECT_OPERATION.'</Operation>
					<Status>'.self::CORRECT_STATUS.'</Status>
					<url>'.self::CORRECT_URL.'</url>
					<MD>'.self::CORRECT_MD.'</MD>
					<termURL>'.self::CORRECT_TERM_URL.'</termURL>
					<pareq>'.self::CORRECT_PAREQ.'</pareq>
				</Response>
			</TKKPG>';

		$response = new GetPaReqResponse($this->createSimpleXml($xml));

		$this->assertTrue($response->isValid());
		$this->assertTrue($response->isSuccess());
		$this->assertEquals(self::CORRECT_STATUS, $response->getStatus());
		$this->assertEquals(self::CORRECT_OPERATION, $response->getOperation());

		$this->assertEquals(self::CORRECT_URL, $response->getUrl());
		$this->assertEquals(self::CORRECT_PAREQ, $response->getPareq());
	}
}
