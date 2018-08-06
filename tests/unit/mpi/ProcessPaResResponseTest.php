<?php

namespace Platron\multicarta\tests\unit\mpi;

use Platron\multicarta\mpi\ProcessPaResResponse;

/*
	Пример ответа из документации
	<TKKPG>
		<Response>
			<Operation>ProcessPARes</Operation>
			<Status>NN</Status>
			<XMLOut>
				<Message date="19/10/2015 12:28:56">
					<OrderID>OrderID</OrderID>
					<Brand>Brand</Brand>
					<OrderStatus>OrderStatus</OrderStatus>
					<ThreeDSVars>
						<AnswerVars>
							<eci>NN</eci>
							<ThreeDSVerificaion>Y</ThreeDSVerificaion>
							<CAVV>AAABBmRwMwAAAAAXWXAzAAAAAAA=</CAVV>
							<xid>MTQ0OTEyNTc1MTAxOTAwMDAwMDA=</xid>
						</AnswerVars>
					</ThreeDSVars>
				</Message>
			</XMLOut>
		</Response>
	</TKKPG>
*/
class ProcessPaResResponseTest extends ResponseTest {

	const CORRECT_STATUS = '00';
	const CORRECT_OPERATION = 'ProcessPARes';

	const CORRECT_ORDER_ID = 'OrderID';
	const CORRECT_BRAND = 'VISA';
	const CORRECT_ORDER_STATUS = 'APPROVED';
	const CORRECT_ECI = 'eci';
	const CORRECT_THREE_D_S_VERIFICAION = 'Y';
	const CORRECT_CAVV = 'cavv';
	const CORRECT_XID = 'xid';

	public function testSuccessResponse(){

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.self::CORRECT_OPERATION.'</Operation>
					<Status>'.self::CORRECT_STATUS.'</Status>
					<XMLOut>
						<Message date="19/10/2015 12:28:56">
							<OrderID>'.self::CORRECT_ORDER_ID.'</OrderID>
							<Brand>'.self::CORRECT_BRAND.'</Brand>
							<OrderStatus>'.self::CORRECT_ORDER_STATUS.'</OrderStatus>
							<ThreeDSVars>
								<AnswerVars>
									<eci>'.self::CORRECT_ECI.'</eci>
									<ThreeDSVerificaion>'.self::CORRECT_THREE_D_S_VERIFICAION.'</ThreeDSVerificaion>
									<CAVV>'.self::CORRECT_CAVV.'</CAVV>
									<xid>'.self::CORRECT_XID.'</xid>
								</AnswerVars>
							</ThreeDSVars>
						</Message>
					</XMLOut>
				</Response>
			</TKKPG>';

		$response = new ProcessPaResResponse($this->createSimpleXml($xml));

		$this->assertTrue($response->isValid());
		$this->assertTrue($response->isSuccess());
		$this->assertEquals(self::CORRECT_STATUS, $response->getStatus());
		$this->assertEquals(self::CORRECT_OPERATION, $response->getOperation());

		$this->assertEquals(self::CORRECT_ORDER_ID, $response->getOrderID());
		$this->assertEquals(self::CORRECT_BRAND, $response->getBrand());
		$this->assertEquals(self::CORRECT_ORDER_STATUS, $response->getOrderStatus());
		$this->assertEquals(self::CORRECT_ECI, $response->getEci());
		$this->assertEquals(self::CORRECT_THREE_D_S_VERIFICAION, $response->getThreeDSVerificaion());
		$this->assertEquals(self::CORRECT_CAVV, $response->getCAVV());
		$this->assertEquals(self::CORRECT_XID, $response->getXid());
	}
}
