<?php

namespace Platron\multicarta\tests\unit;

use Platron\multicarta\mpi\CreateOrderResponseParser;

/*
	Пример ответа из документации
	<?xml version="1.0" encoding="UTF-8"?>
	<TKKPG>
		<Response>
			<Operation>CreateOrder</Operation>
			<Status>NN</Status>
			<Order>
				<OrderID>OrderID</OrderID>
				<SessionID>SessionID</SessionID>
				<URL>PayGateURL</URL>
			</Order>
		</Response>
	</TKKPG>
*/
class CreateOrderResponseParserTest extends ResponseParserTest {

	const CORRECT_STATUS = '00';
	const CORRECT_OPERATION = 'CreateOrder';

	const CORRECT_ORDER_ID = 'OrderID';
	const CORRECT_SESSION_ID = 'SessionID';
	const CORRECT_URL = 'URL';

	public function testSuccessResponse(){

		$Status = self::CORRECT_STATUS;
		$Operation = self::CORRECT_OPERATION;

		$OrderID = self::CORRECT_ORDER_ID;
		$SessionID = self::CORRECT_SESSION_ID;
		$URL = self::CORRECT_URL;

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.$Operation.'</Operation>
					<Status>'.$Status.'</Status>
					<Order>
						<OrderID>'.$OrderID.'</OrderID>
						<SessionID>'.$SessionID.'</SessionID>
						<URL>'.$URL.'</URL>
					</Order>
				</Response>
			</TKKPG>';

		$parser = new CreateOrderResponseParser($this->createResponse($xml));

		$this->assertTrue($parser->isValid());
		$this->assertTrue($parser->isSuccess());
		$this->assertEquals($Status, $parser->getStatus());
		$this->assertEquals($Operation, $parser->getOperation());

		$this->assertEquals($OrderID, $parser->getOrderID());
		$this->assertEquals($SessionID, $parser->getSessionID());
	}

	public function testFailStatus(){

		$Status = '30';
		$Operation = self::CORRECT_OPERATION;

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.$Operation.'</Operation>
					<Status>'.$Status.'</Status>
				</Response>
			</TKKPG>';

		$parser = new CreateOrderResponseParser($this->createResponse($xml));

		$this->assertTrue($parser->isValid());
		$this->assertFalse($parser->isSuccess());
		$this->assertEquals($parser->getStatus(), $Status);
		$this->assertEquals($parser->getOperation(), $Operation);
	}

	public function testInvalidResponse(){

		$Status = self::CORRECT_STATUS;
		$Operation = 'Operation';

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.$Operation.'</Operation>
					<Status>'.$Status.'</Status>
				</Response>
			</TKKPG>';

		$parser = new CreateOrderResponseParser($this->createResponse($xml));

		$this->assertFalse($parser->isValid());
		$this->assertEquals($parser->getOperation(), $Operation);
	}
}
