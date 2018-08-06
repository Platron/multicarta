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

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.self::CORRECT_OPERATION.'</Operation>
					<Status>'.self::CORRECT_STATUS.'</Status>
					<Order>
						<OrderID>'.self::CORRECT_ORDER_ID.'</OrderID>
						<SessionID>'.self::CORRECT_SESSION_ID.'</SessionID>
						<URL>'.self::CORRECT_URL.'</URL>
					</Order>
				</Response>
			</TKKPG>';

		$response = new CreateOrderResponse($this->createSimpleXml($xml));

		$this->assertTrue($response->isValid());
		$this->assertTrue($response->isSuccess());
		$this->assertEquals(self::CORRECT_STATUS, $response->getStatus());
		$this->assertEquals(self::CORRECT_OPERATION, $response->getOperation());

		$this->assertEquals(self::CORRECT_ORDER_ID, $response->getOrderID());
		$this->assertEquals(self::CORRECT_SESSION_ID, $response->getSessionID());
	}
}
