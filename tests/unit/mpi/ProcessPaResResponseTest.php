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

		$Status = self::CORRECT_STATUS;
		$Operation = self::CORRECT_OPERATION;

		$OrderID = self::CORRECT_ORDER_ID;
		$Brand = self::CORRECT_BRAND;
		$OrderStatus = self::CORRECT_ORDER_STATUS;
		$eci = self::CORRECT_ECI;
		$ThreeDSVerificaion = self::CORRECT_THREE_D_S_VERIFICAION;
		$CAVV = self::CORRECT_CAVV;
		$xid = self::CORRECT_XID;

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.$Operation.'</Operation>
					<Status>'.$Status.'</Status>
					<XMLOut>
						<Message date="19/10/2015 12:28:56">
							<OrderID>'.$OrderID.'</OrderID>
							<Brand>'.$Brand.'</Brand>
							<OrderStatus>'.$OrderStatus.'</OrderStatus>
							<ThreeDSVars>
								<AnswerVars>
									<eci>'.$eci.'</eci>
									<ThreeDSVerificaion>'.$ThreeDSVerificaion.'</ThreeDSVerificaion>
									<CAVV>'.$CAVV.'</CAVV>
									<xid>'.$xid.'</xid>
								</AnswerVars>
							</ThreeDSVars>
						</Message>
					</XMLOut>
				</Response>
			</TKKPG>';

		$response = new ProcessPaResResponse($this->createSimpleXml($xml));

		$this->assertTrue($response->isValid());
		$this->assertTrue($response->isSuccess());
		$this->assertEquals($Status, $response->getStatus());
		$this->assertEquals($Operation, $response->getOperation());

		$this->assertEquals($OrderID, $response->getOrderID());
		$this->assertEquals($Brand, $response->getBrand());
		$this->assertEquals($OrderStatus, $response->getOrderStatus());
		$this->assertEquals($eci, $response->getEci());
		$this->assertEquals($ThreeDSVerificaion, $response->getThreeDSVerificaion());
		$this->assertEquals($CAVV, $response->getCAVV());
		$this->assertEquals($xid, $response->getXid());
	}
}
