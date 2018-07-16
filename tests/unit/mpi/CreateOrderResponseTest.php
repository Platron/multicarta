<?php

namespace Platron\multicarta\tests\unit\mpi;

use Platron\multicarta\mpi\CreateOrderResponse;

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
class CreateOrderResponseTest extends ResponseTest {

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

		$response = new CreateOrderResponse($this->createSimpleXml($xml));

		$this->assertTrue($response->isValid());
		$this->assertTrue($response->isSuccess());
		$this->assertEquals($Status, $response->getStatus());
		$this->assertEquals($Operation, $response->getOperation());

		$this->assertEquals($OrderID, $response->getOrderID());
		$this->assertEquals($SessionID, $response->getSessionID());
	}
}
